@extends('layouts.master')
@section('css')
   <!--- Internal Select2 css-->
   <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2>Create Task</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tasks.assignTask') }}" method="POST">
        @csrf

        <!-- Project selection dropdown -->
        <div class="form-group">
            <label for="project_id">Select Project</label>
            <select name="project_id" id="project_id" class="form-control" required>
                <option value="">Select a project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Team selection dropdown -->
        <div class="form-group">
            <label for="team_id">Select Team</label>
            <select name="team_id" id="team_id" class="form-control" required>
                <option value="">Select a team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Team member selection dropdown -->
        <div class="form-group">
            <label for="team_member_id">Select Team Member</label>
            <select name="team_member_id" id="team_member_id" class="form-control" required>
                <option value="">Select a team member</option>
                <!-- Options will be dynamically populated here -->
            </select>
        </div>

        <!-- Resource selection dropdown (if applicable) -->


        <!-- Task Title -->
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <!-- Task Description -->
        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <!-- Task Status -->
        <div class="form-group">
            <label for="status">Task Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

        <!-- Value Status -->
        <div class="form-group">
            <label for="Value_Status">Value Status</label>
            <input type="number" name="Value_Status" id="Value_Status" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Assign Task</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#team_id').change(function () {
            var teamId = $(this).val();
            if (teamId) {
                $.ajax({
                    url: '/get-team-members/' + teamId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#team_member_id').empty(); // Clear the previous options
                        $('#team_member_id').append('<option value="">Select a team member</option>');
                        $.each(data, function (key, value) {
                            $('#team_member_id').append('<option value="' + value.id + '">' + value.user_name + '</option>');
                        });
                    }
                });
            } else {
                $('#team_member_id').empty();
                $('#team_member_id').append('<option value="">Select a team member</option>');
            }
        });
    });
</script>

@endsection
