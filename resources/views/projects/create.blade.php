@extends('layouts.master')

@section('css')
   <!--- Internal Select2 css-->
   <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1>Create New Project</h1>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="company_id">Company</label>
                <select name="company_id" class="form-control" required>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="budget">Budget</label>
                <input type="number" name="budget" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control">
            </div>

            <div class="form-group">
                <label for="Value_Status">Value Status</label>
                <input type="number" name="Value_Status" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
@endsection
