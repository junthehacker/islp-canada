@extends('layouts/portal')

@section('title') Submissions @endsection

@section('content')
    @include('portal/partials/nav')
    @include('portal/partials/addpostermodal')
    <div class="container-fluid main-container">
        @if (session('create_poster_error'))
            <div class="alert alert-danger">
                {{ session('create_poster_error') }}
            </div>
        @endif
        @if (session('create_poster_success'))
            <div class="alert alert-success">
                {{ session('create_poster_success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Submissions</li>
                    </ol>
                </nav>
                <h1>Submissions</h1>
                @if (request()->user->isTeacher())
                    @if($current_competition && $current_competition->acceptSubmissions())
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPosterModal"><i
                                    class="fa fa-plus"
                                    aria-hidden="true"></i>
                            Submit New Poster to {{ $current_competition->name }}
                        </button>
                        <br><br>
                    @else
                        <p>There is no competition that currently accepts new submissions.</p>
                    @endif
                @endif
            </div>
            @if (request()->user->isTeacher())
                <div class="col-md-12">
                    <h2>My Submissions ({{count(request()->user->posters)}})</h2>
                    <hr>
                    @foreach($competitions as $competition)
                        <h3>{{ $competition->name }} &nbsp;<span
                                    class="text-muted ex-small-text">{{ $competition->getStatusName() }}</span></h3>
                        @if(!$competition->acceptSubmissions())
                            <div class="alert alert-dark">Submissions for this competition has been disabled. You cannot perform actions on submissions.</div>
                        @endif
                        <div class="row">
                            @foreach(request()->user->posters as $poster)
                                @if($poster->competition_id === $competition->id)
                                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-header">
                                                <b>{{ $poster->getGroupName() }}</b>
                                            </div>
                                            <div class="card-body">
                                                <h4>{{$poster->title}}</h4>
                                                <p>
                                                    <b>Student</b>: {{$poster->student_name}}<br>
                                                    <b>Submitted on</b>: {{ date('Y/m/d', strtotime($poster->created_at)) }}
                                                </p>
                                                <a href="#" onclick="openBase64NewTab('{{$poster->image_base64}}')"><img
                                                            src="{{$poster->image_base64}}"
                                                            style="max-height: 200px; max-width: 100%;"/></a>
                                            </div>
                                            <div class="card-footer">
                                                <form>
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-primary"
                                                            @if($competition->status !== 'accept_submissions') disabled @endif>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <br><br>
                    @endforeach
                </div>
            @endif
            @if (request()->user->role === 0)
                <div class="col-md-12">
                    <a href="{{url('portal/submissions/export?competition=' . ($competition ? $competition->id : ""))}}">
                        <button class="btn btn-primary"><i class="fa fa-table" aria-hidden="true"></i>
                            Export to CSV
                        </button>
                    </a>
                    <hr>
                    @if($competition)
                        <h3>Submissions to {{ $competition->name }} ({{count($posters)}})</h3>
                    @else
                        <h3>All Submissions ({{count($posters)}})</h3>
                    @endif
                    <hr>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <select name="competition" class="form-control">
                                    <option value="">All</option>
                                    @foreach($competitions as $competition)
                                        <option @if(request()->input('competition') == $competition->id) selected
                                                @endif value="{{ $competition->id }}">{{ $competition->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary"><i class="fa fa-filter" aria-hidden="true"></i> Filter
                                </button>
                            </div>

                        </div>
                    </form>
                    <hr>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">School</th>
                            <th scope="col">Student</th>
                            <th scope="col">Competition</th>
                            <th scope="col">Submitted At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posters as $poster)
                            <tr>
                                <th scope="row">{{$poster->id}}</th>
                                <td>{{$poster->title}}</td>
                                <td>{{$poster->user->teacher->school}}</td>
                                <td>{{$poster->student_name}}</td>
                                <td>{{$poster->competition->name}}</td>
                                <td>{{ date('Y/m/d', strtotime($poster->created_at)) }}</td>
                                <td>
                                    <a href="{{url('portal/submissions/' . $poster->id . '/image')}}" target="_blank">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-external-link" aria-hidden="true"></i>
                                            View Poster
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script>
        function openBase64NewTab(data) {
            let image = new Image();
            image.src = data;

            let w = window.open("");
            w.document.write(image.outerHTML);
        }
    </script>

@endsection