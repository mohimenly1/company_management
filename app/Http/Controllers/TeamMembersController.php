<?php

namespace App\Http\Controllers;

use App\Teams;
use App\TeamMemmber; // Ensure correct naming
use App\User;
use Illuminate\Http\Request;

class TeamMembersController extends Controller
{
    /**
     * Display the team members interface.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all teams with their members count and members
        $teams = Teams::withCount('members')->with('members.user')->get();
        
        // Fetch all users for the member dropdown
        $users = User::all();

        return view('team_members', compact('teams', 'users'));
    }

    /**
     * Store newly created team members in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ], [
            'user_ids.required' => 'Please select at least one member.',
            'user_ids.*.exists' => 'Selected member does not exist.',
        ]);

        $team_id = $request->team_id;
        $user_ids = $request->user_ids;

        // Prevent duplicate members
        foreach ($user_ids as $user_id) {
            // Check if the member is already in the team
            $exists = TeamMemmber::where('team_id', $team_id)
                                 ->where('user_id', $user_id)
                                 ->exists();
            if (!$exists) {
                TeamMemmber::create([
                    'team_id' => $team_id,
                    'user_id' => $user_id,
                ]);
            }
        }

        return redirect()->route('team_members.index')->with('Add', 'Team members added successfully!');
    }
}
