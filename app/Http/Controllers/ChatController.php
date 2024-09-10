<?php

namespace App\Http\Controllers;

use App\Message;
use App\GroupChat;
use App\Teams;
use App\TeamMemmber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ChatController extends Controller
{
    // Fetch all team members for a specific user
    public function getTeamMembers($userId)
    {
        // Get the team IDs that the logged-in user is a member of
        $teamIds = TeamMemmber::where('user_id', $userId)->pluck('team_id');
    
        // Get the members of those teams, excluding the logged-in user
        $teamMembers = TeamMemmber::whereIn('team_id', $teamIds)
            ->where('user_id', '!=', $userId) // Exclude the logged-in user
            ->with(['user', 'team.leader']) // Load the users, teams, and team leaders
            ->get();
    
        return response()->json($teamMembers);
    }
    
    
    

    // Send a private message between users
    public function sendPrivateMessage(Request $request)
    {
        Log::info('Request Data:', $request->all());  // Log the incoming request
    
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);
    
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
    
        return response()->json(['message' => 'Private message sent successfully', 'data' => $message], 201);
    }
    
    

    // Send a group message to the whole team
    public function sendGroupMessage(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:teams,id',
            'message' => 'required|string',
        ]);

        // Save message in group chat
        GroupChat::create([
            'user_id' => $request->sender_id,
            'team_id' => $request->team_id,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Group message sent successfully'], 201);
    }

    // Fetch all messages between two users (private chat)
    public function getPrivateMessages($userId, $otherUserId)
    {
        $messages = Message::where(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $userId)->where('receiver_id', $otherUserId);
        })->orWhere(function ($query) use ($userId, $otherUserId) {
            $query->where('sender_id', $otherUserId)->where('receiver_id', $userId);
        })->get();

        return response()->json($messages);
    }

    // Fetch all group messages for a specific team
    public function getGroupMessages($teamId)
    {
        $groupMessages = GroupChat::where('team_id', $teamId)->get();

        return response()->json($groupMessages);
    }


    public function teamMembersChat()
    {
        // Get the logged-in user
        $authUser = Auth::user();

        // Check if the user is a team leader
        $team = Teams::with(['members.user', 'leader', 'company', 'project'])
            ->where('leader_id', $authUser->id)
            ->first();

        if (!$team) {
            return redirect()->back()->with('error', 'You are not a team leader.');
        }

        // Pass the team and its members to the view
        return view('team_members_chat', [
            'team' => $team,
            'members' => $team->members, // List of team members
        ]);
    }

    public function showSendMessageForm($receiverId)
    {
        // Get the authenticated leader
        $authUser = Auth::user();
    
        // Find the receiver (team member)
        $receiver = User::findOrFail($receiverId);
    
        // Fetch messages between the leader (auth user) and the team member
        $messages = Message::where(function ($query) use ($authUser, $receiverId) {
            $query->where('sender_id', $authUser->id)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($authUser, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $authUser->id);
        })->orderBy('created_at', 'asc')->get();
    
        // Return the view with the receiver and the messages
        return view('send_message', compact('receiver', 'messages'));
    }
    
    

    public function sendMessage(Request $request, $receiverId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
    
        // Create the message
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
        ]);
    
        // Redirect back to the chat with the receiver to see the updated messages
        return redirect()->route('teamMembers.message', ['receiverId' => $receiverId])->with('success', 'Message sent successfully!');
    }
    
}
