@extends('layouts/portal')

@section('title') Judging System @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">All Assignments</li>
                    </ol>
                </nav>
                <h1>Assigned</h1>
                <br>
                @if($competition && $competition->status === 'begin_judging')
                    <table class="table" data-toggle="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Competition</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(request()->user->judging_results as $result)
                            @if($result->poster->competition_id === $competition->id)
                                <tr>
                                    <td>{{ $result->id }}</td>
                                    <td>{{ $competition->name }}</td>
                                    <td>{{ $result->poster->getGroupName() }}</td>
                                    <td>
                                        @if($result->result)
                                            <span class="badge badge-success">Scored</span>
                                            <span class="badge badge-success">{{ $result->result['final_percentage'] * 100 }} %</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('portal/judge/judge/' . $result->id) }}">
                                            <button class="btn btn-primary" @if($result->result) disabled @endif>Judge
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Judging not enabled.</p>
                @endif
            </div>
        </div>
    </div>
@endsection