<?php
$roleNames = [
    0 => 'Admin',
    1 => 'Teacher',
    2 => 'Judge'
]
?>

@extends('layouts/portal')

@section('title') Users @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <h1>Users</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->email}}</td>
                            <td>{{$roleNames[$user->role]}}</td>
                            <td>
                                <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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