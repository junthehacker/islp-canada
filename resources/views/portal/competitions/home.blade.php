@extends('layouts.portal')

@section('title') Competitions @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Competitions</li>
            </ol>
        </nav>
        <h1>Competitions</h1>
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
                <div class="row">
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">
                                <h3 class="card-title">Active Competition</h3>
                                @if($current_competition)
                                    <h4>{{ $current_competition->name }}</h4>
                                @endif
                                @include('portal.competitions.partials.statusdescription')
                                @include('portal.competitions.partials.statusprogress')
                            </div>
                            <div class="card-footer">
                                @include('portal.competitions.partials.activecompetitionfooter')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">
                                <h3 class="card-title">Create Competition</h3>
                                @if($current_competition->status !== 'over')
                                    <p>
                                        <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Before creating a new competition, please make sure current active competition's status is over.</b><br>
                                        You can force create a new competition, which will result in current active competition being archived.
                                    </p>
                                @else
                                    <p>You can safely create a new competition now, once a new competition is created, current competition will be archived.</p>
                                @endif
                                <form method="post" action="{{ url('/portal/competitions/create') }}">
                                    {{ csrf_field() }}
                                    <input type="text" name="name" class="form-control" placeholder="Competition Name"/>
                                    <br>
                                    <button class="btn btn-primary">Confirm Creation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Archived Competitions</h3>
                <table class="table table-light" data-toggle="table">
                    <thead>
                    <tr>
                        <th data-sortable="true">ID</th>
                        <th data-sortable="true">Name</th>
                        <th data-sortable="true">Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competitions as $competition)
                        @if($competition->status === 'archived')
                            <tr>
                                <td>{{ $competition->id }}</td>
                                <td>{{ $competition->name }}</td>
                                <td>{{ $competition->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#">
                                                <button class="dropdown-item"><i class="fa fa-trash"
                                                                                 aria-hidden="true"></i>
                                                    Delete
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection