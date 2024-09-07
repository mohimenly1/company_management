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
                <h4 class="content-title mb-0 my-auto">Add New Team</h4>
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
                <form action="{{ route('teams.store') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col">
                            <label for="teamName" class="control-label">Team Name</label>
                            <input type="text" class="form-control" id="teamName" name="name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="projectSelect" class="control-label">Select Project</label>
                            <select name="project_id" id="projectSelect" class="form-control select2" required>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="leaderSelect" class="control-label">Select Leader</label>
                            <select name="leader_id" id="leaderSelect" class="form-control select2" required>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="companySelect" class="control-label">Select Company</label>
                            <select name="company_id" id="companySelect" class="form-control select2" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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
            $('.select2').select2();
        });
    </script>
@endsection
