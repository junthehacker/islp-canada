@extends('layouts/portal')

@section('title') Mentor Applications @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Mentor Applications</li>
                    </ol>
                </nav>
                <h1>Mentor Applications</h1>
                <h2>Pending Review</h2>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($pending_mentor_app_count === 0)
                    <h2>( ͒•ㅈ• ͒) Wow, such empty.</h2>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Application Date</th>
                            <th scope="col" style="width: 200px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($mentors as $mentor)
                                @if($mentor->mentor->accepted === 0)
                                    <tr>
                                        <td>{{ $mentor->id }}</td>
                                        <td>{{ $mentor->mentor->name }}</td>
                                        <td>{{ $mentor->email }}</td>
                                        <td>{{ date('Y/m/d', strtotime($mentor->created_at)) }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('/portal/mentorapplications/detail/' . $mentor->id) }}"><i class="fa fa-external-link" aria-hidden="true"></i> View Detail</a>
                                                    <form method="post" action="{{ url('/portal/mentors/approve') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $mentor->id }}" />
                                                        <button class="dropdown-item"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
                                                    </form>
                                                    <form method="post" action="{{ url('/portal/mentors/decline') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $mentor->id }}" />
                                                        <button class="dropdown-item"><i class="fa fa-times" aria-hidden="true"></i> Decline</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <h2>Approved</h2>
                @if($accepted_mentor_app_count === 0)
                    <h2>( ͒•ㅈ• ͒) Wow, such empty.</h2>
                @else
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Application Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mentors as $mentor)
                            @if($mentor->mentor->accepted === 1)
                                <tr>
                                    <td>{{ $mentor->id }}</td>
                                    <td>{{ $mentor->mentor->name }}</td>
                                    <td>{{ $mentor->email }}</td>
                                    <td>{{ date('Y/m/d', strtotime($mentor->created_at)) }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection