@extends('layouts/portal')

@section('title') Rubric @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Rubric</li>
                    </ol>
                </nav>
                <h1>Manage Rubric</h1>
                <h3>Which Competition?</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competitions as $competition)
                        <tr>
                            <td>{{ $competition->name }}</td>
                            <td>{{ $competition->status }}</td>
                            <td><a href="{{ url('portal/rubric/' . $competition->id) }}">
                                    <button class="btn btn-primary">Select</button>
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection