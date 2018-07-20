@extends('layouts/portal')

@section('title') Competitions @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Judging</li>
            </ol>
        </nav>
        <h1>Manage Judging</h1>
        @if($competition)
            <div class="row">
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-users" aria-hidden="true"></i> Judges</h2>
                    <div class="large-dashboard-num">{{ count($judges)  }}</div>
                    <a href="{{ url('/portal/users') }}">
                        <button class="btn btn-primary">Manage Users</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-file-text" aria-hidden="true"></i> Submissions</h2>
                    <div class="large-dashboard-num">{{ count($competition->posters)  }}</div>
                    <a href="{{ url('/portal/submissions') }}">
                        <button class="btn btn-primary">Manage Submissions</button>
                    </a>
                </div>
                <div class="col-md-4">
                    <hr>
                    <h2><i class="fa fa-briefcase" aria-hidden="true"></i> Judge Workload</h2>
                    @if(count($judges) > 0)
                        <div class="large-dashboard-num">{{ round(count($competition->posters) / count($judges), 2)  }}</div>
                    @else
                        <p>No judges</p>
                    @endif
                    <a href="{{ url('/portal/users') }}">
                        <button class="btn btn-primary">Manage Users</button>
                    </a>
                </div>
            </div>
            <hr>
            <h2>Automatic Assignment</h2>
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
                <div class="alert alert-danger">
                    Please set competition status to [Submission Closed] before assigning judges.
                </div>
            @endif
            <hr>
            <h2>Assignments</h2>
            <div class="alert alert-light">This information should never be shared with judges while judging is not
                finished.
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Poster</th>
                    <th>School</th>
                    <th>Assigned Judges</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competition->posters as $poster)
                    <tr>
                        <td>{{ $poster->title }}</td>
                        <td>{{ $poster->user->teacher->school }}</td>
                        <td>
                            @foreach($poster->judging_results as $result)
                                {{ $result->user->email }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach($poster->judging_results as $result)
                                @if($result->result)
                                    <span class="badge badge-success">Scored</span>
                                    <span class="badge badge-success">{{ $result->result['final_percentage'] * 100 }}
                                        %</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                                <br>
                            @endforeach
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-toggle="dropdown">
                                    Actions
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item">
                                        <i class="fa fa-external-link" aria-hidden="true"></i> View Detail
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">There is no active competition.</div>
        @endif
    </div>

@endsection