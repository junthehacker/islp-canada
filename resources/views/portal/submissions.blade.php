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
            <div class="alert alert-primary">
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
                @if (request()->user->role === 1)
                    @if($current_competition && $current_competition->status === 'accept_submissions')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPosterModal"><i
                                    class="fa fa-plus"
                                    aria-hidden="true"></i>
                            Submit New Poster to {{ $current_competition->name }}
                        </button>
                    @else
                        <p>There is no competition that accepts new submissions.</p>
                    @endif
                @endif
            </div>
            @if (request()->user->role === 1)
                <div class="col-md-12">
                    <hr>
                    <h3>My Submissions ({{count(request()->user->posters)}})</h3>
                    @foreach($competitions as $competition)
                        <hr>
                        <h4>{{ $competition->name }} <span
                                    class="badge badge-secondary">{{ $competition->status }}</span></h4>
                        <div class="row">
                            @foreach(request()->user->posters as $poster)
                                @if($poster->competition_id === $competition->id)
                                    <div class="col-lg-3 col-md-6" style="overflow-y: hidden;">
                                        <h5>{{$poster->title}}</h5>
                                        <form>
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger"
                                                    @if($competition->status !== 'accept_submissions') disabled @endif>
                                                Delete
                                            </button>
                                        </form>
                                        <p>
                                            Student: {{$poster->student_name}}<br>
                                            Submitted on: {{ date('Y/m/d', strtotime($poster->created_at)) }}
                                        </p>
                                        <a href="#" onclick="openBase64NewTab('{{$poster->image_base64}}')"><img
                                                    src="{{$poster->image_base64}}"
                                                    style="max-height: 200px; max-width: 100%;"/></a>
                                        <hr>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
            @if (request()->user->role === 0)
                <div class="col-md-12">
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
                                        <option @if(request()->input('competition') == $competition->id) selected @endif value="{{ $competition->id }}">{{ $competition->name }}</option>
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