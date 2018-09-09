<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge',
    3 => 'Mentor'
]
?>

@extends('layouts.portal')

@section('title') Users @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @include('portal.partials.commonsuccess')
                <h1>Users</h1>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"
                                                                                                   aria-hidden="true"></i>
                    Create User
                </button>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control">
                            <option>All</option>
                            <option>Admin</option>
                            <option>Teacher</option>
                            <option>Judge</option>
                            <option>Mentor</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                    </div>
                </div>
                <hr>
                <table class="table table-light" data-toggle="table">
                    <thead>
                    <tr>
                        <th data-sortable="true" scope="col">#</th>
                        <th data-sortable="true" scope="col">User ID</th>
                        <th data-sortable="true" scope="col">Role</th>
                        <th data-sortable="true" scope="col">Activated</th>
                        <th data-sortable="true" scope="col">Created At</th>
                        <th data-sortable="true" scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td scope="row" class="@if(!$user->active) op-5 @endif">{{$user->id}}</td>
                            <td class="@if(!$user->active) op-5 @endif">{{$user->email}}</td>
                            <td class="@if(!$user->active) op-5 @endif">{{$roleNames[$user->role]}}</td>
                            <td class="@if(!$user->active) op-5 @endif">
                                @if($user->active)
                                    Activated
                                @else
                                    Deactivated
                                @endif
                            </td>
                            <td class="@if(!$user->active) op-5 @endif">{{date('M jS, Y G:i e', strtotime($user->created_at))}}</td>
                            <td class="@if(!$user->active) op-5 @endif">{{date('M jS, Y G:i e', strtotime($user->updated_at))}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                        Actions
                                    </button>
                                    @if($user->active)
                                    <div class="dropdown-menu">
                                        <a href="{{ url('portal/users/delete/' . $user->id) }}">
                                            <button class="dropdown-item">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                Deactivate
                                            </button>
                                        </a>
                                    </div>
                                    @else
                                        <div class="dropdown-menu">
                                            <a href="{{ url('portal/users/activate/' . $user->id) }}">
                                                <button class="dropdown-item">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                    Activate
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @include('portal/partials/addusermodal')

@endsection