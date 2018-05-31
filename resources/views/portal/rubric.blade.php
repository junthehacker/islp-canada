@extends('layouts/portal')

@section('title') Rubric @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Rubric</li>
                    </ol>
                </nav>
                <h1>Manage Rubric</h1>
                <a href="{{ url('/portal/rubric/rules/create') }}"><button class="btn btn-primary">Create New Rule</button></a>
            </div>
        </div>
    </div>
@endsection