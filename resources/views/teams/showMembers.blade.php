@extends('layouts.master')
@section('css')
   <!--- Internal Select2 css-->
   <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h2>{{ $team->name }} Members</h2>

    <ul class="list-group">
        @foreach($members as $member)
            <li class="list-group-item">
                <strong>{{ $member->user->name }}</strong>
                <ul class="list-group mt-2">
                    @foreach($member->tasks as $task)
                        <li class="list-group-item">
                            <strong>Task:</strong> {{ $task->title }}
                            <p><strong>Description:</strong> {{ $task->description }}</p>
                            <p><strong>Status:</strong> {{ $task->status }}</p>
                        </li>
                    @endforeach
                </ul>
                
                <!-- Task assignment form -->
                <form action="{{ route('tasks.assignTask') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $team->project_id }}">
                    <input type="hidden" name="team_member_id" value="{{ $member->id }}">
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="Value_Status" value="0">
                    <input type="text" name="title" placeholder="Task Title" class="form-control mb-2" required>
                    <textarea name="description" placeholder="Task Description" class="form-control mb-2"></textarea>
                    <button type="submit" class="btn btn-success">Assign Task</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
