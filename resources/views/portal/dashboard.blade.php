@extends('layouts/portal')

@section('title') Dashboard @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h1>Dashboard</h1>
                <h3>Your are logged in as {{ request()->user->getRoleName() }}.</h3>
            </div>
            @if(request()->user->role === 0)
                <div class="col-md-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Current Competition - {{ $competition ? $competition->name : "No competition active." }} ({{$competition->getStatusName()}})</h3>
                            <h4>Task Checklist</h4>
                            @include('portal.partials.competitionchecklist')
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/portal/competitions') }}">
                                <button class="btn btn-primary">Manage Competitions</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Users</h3>
                            Number of active users currently within the system.
                            <div class="large-dashboard-num">{{ count($users)  }}</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/portal/users') }}">
                                <button class="btn btn-primary">Manage Users</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Submissions</h3>
                            All submissions in the system, including all competitions.
                            <div class="large-dashboard-num">{{ count($posters) }}</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/portal/submissions') }}">
                                <button class="btn btn-primary">Manage Submissions</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Pending Mentors</h3>
                            Number of pending mentor applications.
                            <div class="large-dashboard-num">{{ $pending_mentor_app_count }}</div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/portal/mentorapplications') }}">
                                <button class="btn btn-primary">Review</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Judging</h3>
                            @if($competition->status !== 'begin_judging')
                                <p>Judging is currently disabled. Enable judging by changing the competition status to Begin Judging.</p>
                            @else
                                <p>Judging is currently enabled. Judges can now login to their accounts.</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/portal/rubric') }}">
                                <button class="btn btn-primary">Manage Rubric</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if(request()->user->role === 1)
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Current Competition - {{ $competition ? $competition->name : "No competition active." }}</h3>
                            @if($competition->status === 'accept_submissions')
                                <p>
                                    <b>This competition is currently accepting submissions</b>, submit a new poster in Submissions tab.<br><br>
                                    Please make sure you read the <a href="https://islp.ssc.ca/#rules">competition rules</a> before making any submissions.
                                </p>
                            @else
                                <p>
                                    This competition is not currently accepting submissions.
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('portal/submissions') }}">
                                <button class="btn btn-primary" @if($competition->status !== 'accept_submissions') disabled @endif>Submit New Entry</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">Forum</h3>
                            <p>
                                As a teacher, you have access to our forum, if you have any questions, please post on the forum, and we will try our best to answer.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('forum') }}">
                                <button class="btn btn-primary">Visit Forum</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <h3 class="card-title">FAQs</h3>
                            <p>
                               Have a question? Chances are, you will find the answer below.
                            </p>
                            @include('portal.partials.teacherfaqs')
                        </div>
                    </div>
                </div>
            @endif
            @if(request()->user->role === 2)
                <div class="col-md-6">
                    <hr>
                    @if($competition)
                        <h2><i class="fa fa-file-text" aria-hidden="true"></i> Assigned</h2>
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            By using this portal, you agree to follow <a href="#">Judge Code of Conduct</a>.
                        </div>
                        <div class="large-dashboard-num">{{ count(request()->user->judging_results) }}</div>
                        @if($competition->status === 'begin_judging')
                            <a href="{{ url('portal/judge') }}">
                                <button class="btn btn-primary">Go to judging system</button>
                            </a>
                        @else
                            <div class="alert alert-light">Judging is currently disabled.</div>
                        @endif
                    @else
                        <p>No competition is active.</p>
                    @endif
                </div>

                <div class="col-md-6">
                    <hr>
                    @if($competition)
                        <h2><i class="fa fa-file-text" aria-hidden="true"></i> Competition</h2>

                        <p style="font-size: 20px;">You are judging {{ $competition->name }}</p>
                    @else
                        <p>No competition is active.</p>
                    @endif
                </div>
            @endif
            @if(request()->user->role === 3)
                <div class="col-md-12">
                    @include('portal/partials/mentorappstatus')
                </div>
            @endif
        </div>
    </div>

@endsection