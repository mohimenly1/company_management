<?php

namespace App\Http\Controllers;

use App\companies;
use App\projects;
use App\Teams;
use App\User;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    // Display a listing of the projects
    public function index()
    {
        $projects = projects::with('company', 'phases', 'details', 'files')->get();
        return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project
    public function create()
    {
        $companies = companies::all(); // Fetch all companies to populate the dropdown
        return view('projects.create', compact('companies'));
    }

    // Store a newly created project in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'budget' => 'required|numeric',
            'status' => 'nullable|string',
            'Value_Status' => 'required|integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $validatedData['created_by'] = auth()->id();

        $project = projects::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }
}