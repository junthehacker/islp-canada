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
                <h1>Submissions</h1>
                @if (request()->user->role === 1)
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addPosterModal"><i class="fa fa-plus"
                                                                                                         aria-hidden="true"></i>
                        Submit New Poster
                    </button>
                @endif
            </div>
            @if (request()->user->role === 1)
                <div class="col-md-12">
                    <hr>
                    <h3>My Submissions ({{count(request()->user->posters)}})</h3>
                    <div class="row">
                        @foreach(request()->user->posters as $poster)
                            <div class="col-lg-3 col-md-6" style="overflow-y: hidden;">
                                <h4>{{$poster->title}}</h4>
                                <form>
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger">Delete</button>
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
                        @endforeach
                    </div>
                </div>
            @endif
            @if (request()->user->role === 0)
                <div class="col-md-12">
                    <hr>
                    <h3>All Submissions ({{count($posters)}})</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">School</th>
                            <th scope="col">Student</th>
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
                            <td>{{ date('Y/m/d', strtotime($poster->created_at)) }}</td>
                            <td>
                                <button class="btn btn-primary" onclick="openBase64NewTab('{{$poster->image_base64}}')">View Submission</button>
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