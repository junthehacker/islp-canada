@extends('layouts.portal')

@section('title') Confirm Deactivation @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ url('portal/users') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deactivation</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Confirm User Deactivation</h1>
        <hr>
        <p>
            <b>{{ $user->email }}</b>
        </p>
        <p>By deactivating this user, they will no longer be able to login.</p>
        <form method="post">
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Deactivate</button>
            <a href="{{ url('portal/users') }}">
                <button class="btn btn-link" type="button"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </a>
        </form>
    </div>

@endsection