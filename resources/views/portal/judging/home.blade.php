@extends('layouts.portal')

@section('title') Judging @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Judging</li>
            </ol>
        </nav>
        <h1>Manage Judging</h1>
        @if($competition)
        <h3>Judging dashboard for {{ $competition->name }}</h3>
        @include('portal.partials.commonsuccess')
        <hr>
            <h3>Automatic Assignment</h3>
            @if($competition->status === 'submission_closed')
                <label>How many judges should look over one poster?</label>
                <form action="{{url('portal/judging/autoassign')}}" method="post">
                    {{ csrf_field() }}
                    <input type="number" name="count" class="form-control" value="3"/>
                    <br>
                    <div class="alert alert-light">By automatically assigning, you will lose all previously scored
                        results.
                    </div>
                    <button class="btn btn-primary">Assign Judges</button>
                </form>
            @else
                <div class="alert alert-warning">
                    Please set competition status to <b>Submission Closed</b> before assigning judges.
                </div>
            @endif
            <hr>
            <h3>Assignments and Results</h3>
            <div class="alert alert-light">This information should never be shared with judges while judging is not
                finished.
            </div>
            <table class="table table-light">
                <thead>
                <tr>
                    <th>Poster Title</th>
                    <th>School</th>
                    <th>Group</th>
                    <th>Assigned Judges</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Poster Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competition->posters as $poster)
                    @foreach($poster->judging_results as $key => $result)
                        <tr>
                            @if($key === 0)
                            <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->title }}</td>
                            <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->user->teacher->school }}</td>
                            <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->getGroupName() }}</td>
                            @endif
                            <td>
                                {{ $result->user->email }}<br>
                            </td>
                            <td class="@if($result->result) scored-td @else pending-td @endif">
                                    @if($result->result)
                                        {{ $result->result['final_percentage'] * 100 }}%
                                    @else
                                        Pending
                                    @endif
                                    <br>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ url('portal/judging/delete/' . $result->id) }}">
                                            <button class="dropdown-item">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Remove Judge
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            @if($key === 0)
                                <td rowspan="{{ count($poster->judging_results) }}">
                                    <a href="{{ url('/portal/judging/assign/' . $poster->id) }}">
                                        <button class="btn btn-primary">Manual Assign Judges</button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">There is no active competition.</div>
        @endif
    </div>

@endsection