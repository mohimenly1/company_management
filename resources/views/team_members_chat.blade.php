<!-- resources/views/team_members_chat.blade.php -->
@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Team Members Chat</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')

<!-- Display team members and message option -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Team: {{ $team->name }}</h4>
                <h5>Project: {{ $team->project->project_name }}</h5>
                <h6>Leader: {{ $team->leader->name }}</h6>
                <h6>Company: {{ $team->company->name }}</h6>

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>Member Name</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->user->name }}</td>
                                <td>
                                    <a href="{{ route('teamMembers.message', ['receiverId' => $member->user->id]) }}" class="btn btn-sm btn-primary">
                                        Send Message
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
@endsection
