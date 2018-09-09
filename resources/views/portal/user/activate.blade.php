@extends('layouts.portal')

@section('title') Confirm Activation @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ url('portal/users') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Activation</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Confirm User Activation</h1>
        <hr>
        <p>
            <b>{{ $user->email }}</b>
        </p>
        <p>By activating this user, they will be able to login and perform regular actions again.</p>
        <form method="post">
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i> Activate</button>
            <a href="{{ url('portal/users') }}">
                <button class="btn btn-link" type="button"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </a>
        </form>
    </div>

@endsection