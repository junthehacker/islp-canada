@extends('layouts/portal')

@section('title') Create Rubric Rule @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/portal/rubric') }}">Rubric</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Rule</li>
                    </ol>
                </nav>
                <h1>Create Rubric Rule</h1>
            </div>
        </div>
    </div>
@endsection