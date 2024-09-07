@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Manage Team Members</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@if (session()->has('Add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('Add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('team_members.store') }}" method="post" autocomplete="off">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="teamSelect" class="control-label">Select Team</label>
                            <select name="team_id" id="teamSelect" class="form-control select2" required>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('team_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="userSelect" class="control-label">Select Members</label>
                            <select name="user_ids[]" id="userSelect" class="form-control select2" multiple="multiple" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Add Members</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Display Teams and Members Count -->
<div class="row mt-4">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Project</th>
                            <th>Leader</th>
                            <th>Company</th>
                            <th>Members Count</th>
                            <th>Members</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->project->project_name }}</td>
                                <td>{{ $team->leader->name }}</td>
                                <td>{{ $team->company->name }}</td>
                                <td>{{ $team->members_count }}</td>
                                <td>
                                    @foreach($team->members as $member)
                                        <span class="badge badge-secondary">{{ $member->user->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

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
