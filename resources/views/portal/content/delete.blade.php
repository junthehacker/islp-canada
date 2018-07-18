@extends('layouts.portal')

@section('title') Confirm Deletion @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ url('portal/content') }}">Content</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Confirm Deletion of <code>{{ $string_resource->identifier }}</code></h1>
        <hr>
        <p>You cannot undo this action.</p>
        <form method="post">
            {{ csrf_field() }}
            <button class="btn btn-primary" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
            <a href="{{ url('portal/content') }}">
                <button class="btn btn-light" type="button"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
            </a>
        </form>
    </div>

@endsection