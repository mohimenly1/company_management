<?php

namespace App\Http\Controllers;

use App\companies;
use App\projects;
use App\Teams;
use App\User;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Fetch projects, users (leaders), and companies for dropdowns
        $projects = projects::all();
        $leaders = User::all();
        $companies = companies::all();

        return view('teams', compact('projects', 'leaders', 'companies'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'leader_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        // Create a new team
        Teams::create($request->all());

        return redirect()->route('teams.index')->with('Add', 'Team added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function show(Teams $teams)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams)
    {
        //
    }
}
