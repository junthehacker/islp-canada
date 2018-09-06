@extends('layouts.portal')

@section('title') Remove Judge - Judging @endsection

@section('content')
    @include('portal.partials.nav')

    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{url('/portal/judging')}}">Judging</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Delete Judge</li>
            </ol>
        </nav>
        <h1>Remove Judge</h1>
        <h3>Are you sure you want to remove the following judge from specified submission?</h3>

        <p>
            Removing the judge will also remove any score that has already been submitted by this judge to the poster.
        </p>

        <p>
            <b>Email:</b> {{ $judging_result->user->email }}<br>
            <b>Poster:</b> {{ $judging_result->poster->title }}
        </p>

        <form method="post" class="d-inline">
            {{ csrf_field() }}
            <button class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i> Confirm Removal</button>
        </form>
        <a href="{{ url('/portal/judging') }}">
            <button class="btn btn-link">Cancel</button>
        </a>
    </div>
@endsection