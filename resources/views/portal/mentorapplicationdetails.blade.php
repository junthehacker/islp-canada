@extends('layouts/portal')

@section('title') Application Detail @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/portal/mentorapplications') }}">Mentor Applications</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $mentor->id }}</li>
                    </ol>
                </nav>
                @if($mentor && $mentor->role === 3 && $mentor->mentor->accepted === 0)
                    <h1>Application # {{ $mentor->id }}</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Application Date</h4>
                            <p>{{ date('Y/m/d', strtotime($mentor->created_at)) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Full Name</h4>
                            <p>{{ $mentor->mentor->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Email Address</h4>
                            <p>{{ $mentor->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Major Area</h4>
                            <p>{{ $mentor->mentor->major_area }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>School</h4>
                            <p>{{ $mentor->mentor->school }}</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Reason</h4>
                            <p>{{ $mentor->mentor->reason }}</p>
                        </div>
                        <div class="col-md-12">
                            <form method="post" action="{{ url('/portal/mentors/approve') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $mentor->id }}" />
                                <button class="btn btn-primary">Approve</button>
                            </form>
                            <p style="font-size: 12px;">By approving the application, the mentor will have immediate access to the discussion forum.</p>
                            <form method="post" action="{{ url('/portal/mentors/decline') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $mentor->id }}" />
                                <button class="btn btn-primary">Decline</button>
                            </form>
                            <p style="font-size: 12px;">Decline the application will remove the user account.</p>
                        </div>
                    </div>
                @else
                    <h2>Oops, the application you are trying to view does not exist</h2>
                @endif
            </div>
        </div>
    </div>
@endsection