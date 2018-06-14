<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge',
    3 => 'Mentor'
]
?>

@extends('layouts/portal')

@section('title') Dashboard @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h1>Dashboard</h1>
                <h3>Your are logged in as {{ $roleNames[request()->user->role] }}</h3>
            </div>
            @if(request()->user->role === 0)
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-users" aria-hidden="true"></i> Users</h2>
                    <div class="large-dashboard-num">{{ count($users)  }}</div>
                    <a href="{{ url('/portal/users') }}">
                        <button class="btn btn-primary">Manage Users</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-file-text" aria-hidden="true"></i> Submissions</h2>
                    <p>All submissions, including archived competitions.</p>
                    <div class="large-dashboard-num">{{ count($posters) }}</div>
                    <a href="{{ url('/portal/submissions') }}">
                        <button class="btn btn-primary">Manage Submissions</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-pencil" aria-hidden="true"></i> Pending Mentors</h2>
                    <div class="large-dashboard-num">{{ $pending_mentor_app_count }}</div>
                    <a href="{{ url('/portal/mentorapplications') }}">
                        <button class="btn btn-primary">Review</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-balance-scale" aria-hidden="true"></i> Judging</h2>
                    <p>Judging is currently disabled.</p>
                    <a href="{{ url('/portal/rubric') }}">
                        <button class="btn btn-primary">Manage Rubric</button>
                    </a>
                </div>
            @endif
            @if(request()->user->role === 1)
                <div class="col-md-6">
                    <hr>
                    <h2><i class="fa fa-file-text" aria-hidden="true"></i> My Submissions</h2>
                    <div class="large-dashboard-num">{{ count(request()->user->posters) }}</div>
                    <a href="{{ url('/portal/submissions') }}">
                        <button class="btn btn-primary">Manage Submissions</button>
                    </a>
                </div>
            @endif
            @if(request()->user->role === 2)
                <div class="col-md-6">
                    <hr>
                    @if($competition)
                        <h2><i class="fa fa-file-text" aria-hidden="true"></i> Assigned</h2>
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            By using this portal, you agree to follow <a href="#">Judge Code of Conduct</a>.
                        </div>
                        <div class="large-dashboard-num">{{ count(request()->user->judging_results) }}</div>
                        @if($competition->status === 'begin_judging')
                            <a href="{{ url('portal/judge') }}">
                                <button class="btn btn-primary">Go to judging system</button>
                            </a>
                        @else
                            <div class="alert alert-light">Judging is currently disabled.</div>
                        @endif
                    @else
                        <p>No competition is active.</p>
                    @endif
                </div>

                <div class="col-md-6">
                    <hr>
                    @if($competition)
                        <h2><i class="fa fa-file-text" aria-hidden="true"></i> Competition</h2>

                        <p style="font-size: 20px;">You are judging {{ $competition->name }}</p>
                    @else
                        <p>No competition is active.</p>
                    @endif
                </div>
            @endif
            @if(request()->user->role === 3)
                <div class="col-md-12">
                    @include('portal/partials/mentorappstatus')
                </div>
            @endif
        </div>
    </div>

@endsection