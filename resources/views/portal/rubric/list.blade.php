@extends('layouts/portal')

@section('title') Rubric for {{ $competition->name }} @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>The following error(s) must be resolved before continuing.</b>
                        <hr>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/portal/rubric') }}">Rubric</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $competition->name }}</li>
                    </ol>
                </nav>
                <h1>Rubric for {{ $competition->name }}</h1>
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
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown" @if($competition->status === 'archived') disabled @endif>
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ url('/portal/rubric/'. $rule->competition_id . '/rules/edit/' . $rule->id) }}">
                                                    <button class="dropdown-item"><i class="fa fa-pencil"
                                                                                     aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>
                                                <form method="post" action="{{ url('/portal/rubric/' . $rule->competition_id . '/rules/delete') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $rule->id }}"/>
                                                    <button class="dropdown-item"><i class="fa fa-trash"
                                                                                     aria-hidden="true"></i> Delete
                                                    </button>
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
                <hr>
                @if($competition->status === 'archived')
                    <div class="alert alert-warning">This is an archived competition, you may not modify the rubric.</div>
                @else
                    <a href="{{ url('/portal/rubric/' . $competition->id . '/rules/create') }}">
                        <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create New Rule
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection