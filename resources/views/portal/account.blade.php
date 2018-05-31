<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge',
    3 => 'Mentor'
]
?>

@extends('layouts/portal')

@section('title') Account @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <h1>ISLP Account</h1>
        <div class="row">
            <div class="col-md-6">
                <h3>Account Information</h3>
                <form>
                    <div class="form-group">
                        <label>User ID</label>
                        <input class="form-control" value="{{ request()->user->email }}" disabled/>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <input class="form-control" value="{{ $roleNames[request()->user->role] }}" disabled/>
                    </div>
                </form>
                <form method="post" action="{{ url('/portal/logout') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
                </form>
            </div>
            @if(request()->user->role === 1)
                <div class="col-md-6">
                    <h3>Teacher Account Information</h3>
                    <form>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" value="{{ request()->user->teacher->name }}" disabled/>
                        </div>
                        <div class="form-group">
                            <label>School</label>
                            <input class="form-control" value="{{ request()->user->teacher->school }}" disabled/>
                        </div>
                        <div class="form-group">
                            <label>Teaching Subject</label>
                            <input class="form-control" value="{{ request()->user->teacher->teaching_subject }}" disabled/>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>

@endsection