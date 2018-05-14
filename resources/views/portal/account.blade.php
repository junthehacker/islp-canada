<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge'
]
?>

@extends('layouts/portal')

@section('title') Account @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-6">
                <h1>ISLP Account</h1>
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
                <form method="post" action="/portal/logout">
                    {{ csrf_field() }}
                    <button class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>

@endsection