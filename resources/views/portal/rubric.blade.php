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
                <a href="{{ url('/portal/rubric/rules/create') }}"><button class="btn btn-primary">Create New Rule</button></a>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Max Score</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rule_groups as $rule_group)
                            <tr>
                                <td colspan="5"><b>{{ $rule_group }}</b></td>
                            </tr>
                            @foreach($rules as $rule)

                                @if($rule->group === $rule_group)
                                    <tr>
                                        <td>{{ $rule->name }}</td>
                                        <td>{{ $rule->description }}</td>
                                        <td>{{ $rule->score }}</td>
                                        <td>{{ $rule->weight }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ url('/portal/rubric/rules/edit/' . $rule->id) }}">
                                                        <button class="dropdown-item"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                    </a>
                                                    <form method="post" action="{{ url('/portal/rubric/rules/delete') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $rule->id }}" />
                                                        <button class="dropdown-item"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <h4>Total Score Possible: {{ $total_weight }}</h4>
            </div>
        </div>
    </div>
@endsection