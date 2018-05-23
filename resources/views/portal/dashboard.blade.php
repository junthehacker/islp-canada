<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge'
]
?>

@extends('layouts/portal')

@section('title') Dashboard @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <h3>Your are logged in as {{ $roleNames[request()->user->role] }}</h3>
            </div>
            @if(request()->user->role === 0)
                <div class="col-md-6">
                    <hr>
                    <h2><i class="fa fa-users" aria-hidden="true"></i> Users</h2>
                    <div class="large-dashboard-num">{{ count($users)  }}</div>
                    <a href="{{ url('/portal/users') }}"><button class="btn btn-primary">Manage Users</button></a>
                </div>
                <div class="col-md-6">
                    <hr>
                    <h2><i class="fa fa-file-text" aria-hidden="true"></i> Submissions</h2>
                    <div class="large-dashboard-num">{{ count($posters) }}</div>
                    <a href="{{ url('/portal/submissions') }}"><button class="btn btn-primary">Manage Submissions</button></a>
                </div>
            @endif
            @if(request()->user->role === 1)
                <div class="col-md-6">
                    <hr>
                    <h2><i class="fa fa-file-text" aria-hidden="true"></i> My Submissions</h2>
                    <div class="large-dashboard-num">{{ count(request()->user->posters) }}</div>
                    <a href="{{ url('/portal/submissions') }}"><button class="btn btn-primary">Manage Submissions</button></a>
                </div>
            @endif
        </div>
    </div>

@endsection