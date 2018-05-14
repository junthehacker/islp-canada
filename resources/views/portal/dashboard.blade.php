@extends('layouts/portal')

@section('title') Dashboard @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
            </div>
            <div class="col-md-6">
                <h2><i class="fa fa-users" aria-hidden="true"></i> Users</h2>
                <button class="btn btn-primary">Manage Users</button>
            </div>
            <div class="col-md-6">
                <h2><i class="fa fa-file-text" aria-hidden="true"></i> Submissions</h2>
                <button class="btn btn-primary">Manage Submissions</button>
            </div>
        </div>
    </div>

@endsection