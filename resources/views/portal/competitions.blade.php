@extends('layouts/portal')

@section('title') Competitions @endsection

@section('content')
    @include('portal/partials/nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Competitions</li>
            </ol>
        </nav>
        <h1>Manage Competitions</h1>
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
                <h3>Create Competition</h3>
                <div class="alert alert-warning">Create a new competition will result in previous competition being
                    archived.
                </div>
                <form method="post" action="{{ url('/portal/competitions/create') }}">
                    {{ csrf_field() }}
                    <label>Competition Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Competition Name"/>
                    <br>
                    <button class="btn btn-primary">Create</button>
                </form>
                <hr>
                <h3>Active Competition</h3>
                <h4>{{ $current_competition->name }}</h4>
                <b>Current Status: {{ $current_competition->status }}</b>
                <a href="https://gist.github.com/junthehacker/9e3ffcdc8d764639a5a4e8b3726e0106">Meaning of each
                    status</a>
                <p>Don't worry, you can always roll back to the previous status.</p>
                <form action="{{ url('portal/competitions/status/update/' . $current_competition->id) }}" method="post">
                    {{ csrf_field() }}
                    <select name="status" class="form-control">
                        <option value="new" @if($current_competition->status === 'new') selected @endif>New</option>
                        <option value="accept_submissions" @if($current_competition->status === 'accept_submissions') selected @endif>Accept Submissions</option>
                        <option value="submission_closed" @if($current_competition->status === 'submission_closed') selected @endif>Submission Closed</option>
                        <option value="begin_judging" @if($current_competition->status === 'begin_judging') selected @endif>Begin Judging</option>
                        <option value="judging_finished" @if($current_competition->status === 'judging_finished') selected @endif>Judging Finished</option>
                        <option value="result_announced" @if($current_competition->status === 'result_announced') selected @endif>Result Announced</option>
                        <option value="over" @if($current_competition->status === 'over') selected @endif>Over</option>
                    </select>
                    <br>
                    <button class="btn btn-primary">Save</button>
                </form>
                <hr>
                <h3>Archived Competitions</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($competitions as $competition)
                        @if($competition->status === 'archived')
                            <tr>
                                <th scope="row">{{ $competition->name }}</th>
                                <td>{{ $competition->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="#">
                                                <button class="dropdown-item"><i class="fa fa-pencil"
                                                                                 aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button class="dropdown-item"><i class="fa fa-trash"
                                                                                 aria-hidden="true"></i>
                                                    Delete
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button class="dropdown-item"><i class="fa fa-pencil"
                                                                                 aria-hidden="true"></i> Modify Status
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button class="dropdown-item"><i class="fa fa-archive"
                                                                                 aria-hidden="true"></i> Archive
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