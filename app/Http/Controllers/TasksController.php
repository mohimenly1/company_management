<?php

namespace App\Http\Controllers;

use App\projects;
use App\Tasks;
use App\Teams;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    // Display the form to create a new task
    public function create()
    {
        // Fetch all teams led by the authenticated leader
        $teams = Teams::where('leader_id', auth()->user()->id)->get();
        $projects = projects::all(); // Fetch all projects
        // $resources = resources::all(); // Fetch all resources (if applicable)

        return view('tasks.create', compact('projects', 'teams'));
    }


    public function getTeamMembers($teamId)
    {
        // Fetch team members for the selected team, including the user data
        $team = Teams::findOrFail($teamId);
        $members = $team->members()->with('user:id,name')->get(['id', 'user_id']); // Fetch the user's name
    
        // Map the members to include user name
        $members = $members->map(function($member) {
            return [
                'id' => $member->id,
                'user_id' => $member->user_id,
                'user_name' => $member->user->name, // Include the user name
            ];
        });
    
        return response()->json($members);
    }
    



    // Store the newly created task
    public function store(Request $request)
    {
      
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'team_member_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'Value_Status' => 'required|integer',
        ]);
    

        Tasks::create($request->all());

       
        return redirect()->route('tasks.index')->with('success', 'Task assigned successfully.');
    }
    // Store the newly created task
    public function storeSpecificMember(Request $request)
    {
      
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'team_member_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'Value_Status' => 'required|integer',
        ]);

        Tasks::create($request->all());

       
        return redirect()->route('tasks.showMembers')->with('success', 'Task assigned successfussssslly.');
    }

    // Display the list of teams led by the authenticated leader
    public function index()
    {
        $teams = Teams::where('leader_id', auth()->user()->id)->get();

        return view('teams.index', compact('teams'));
    }

    // Show the members of a specific team
    public function showTeamMembers(Teams $team)
    {
        // Ensure the authenticated leader is the leader of this team
        if ($team->leader_id !== auth()->user()->id) {
            return redirect()->route('teams.index')->with('error', 'Unauthorized access.');
        }
    
        // Load members with their related tasks
        $members = $team->members()->with('user', 'tasks')->get();
    
        return view('teams.showMembers', compact('team', 'members'));
    }
    
    

    // Assign a task to a team member
    public function assignTask(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'team_member_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'Value_Status' => 'required|integer',
        ]);

        $team = Teams::find($request->team_id);

        // Ensure the authenticated leader is the leader of this team
        if ($team->leader_id !== auth()->user()->id) {
            return redirect()->route('teams.index')->with('error', 'Unauthorized access.');
        }

        Tasks::create([
            'project_id' => $team->project_id,
            'team_member_id' => $request->team_member_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'Value_Status' => $request->Value_Status,
        ]);

        return redirect()->route('teams.showMembers', $team->id)->with('success', 'Task assigned succdwqdwqdessfully.');
    }


    public function getUserTasks(Request $request)
    {
        $userId = 6;  // Replace this with the correct user ID
    
        if ($userId) {
            Log::info("Authenticated user ID: " . $userId);
        } else {
            Log::info("User ID not found. Possible token issue.");
            Log::info("Token provided: " . $request->bearerToken());
        }
    
        // Fetch tasks for the user with related comments and the user who made the comment
        $tasks = Tasks::with('comments.user')
                      ->where('team_member_id', $userId)
                      ->get();
    
        return response()->json($tasks);
    }
    
    
    
    
}
