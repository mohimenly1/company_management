@extends('layouts.master')
@section('css')
   <!--- Internal Select2 css-->
   <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <h2>Your Teams</h2>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul class="list-group">
        @foreach($teams as $team)
            <li class="list-group-item">
                <strong>{{ $team->name }}</strong>
                <a href="{{ route('teams.showMembers', $team->id) }}" class="btn btn-primary float-right">Show Members</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
