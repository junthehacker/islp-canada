@extends('layouts/portal')

@section('title') Submission @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <img src="{{ $base64 }}" class="img-fluid" />
    </div>
@endsection