@extends('layouts/forum')

@section('content')
    <h1>All Posts</h1>
    <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Create New Post</button>
    <h3>General Discussion</h3>
    <div class="post-overview-card">
        <div class="row">
            <div class="col-md-6">
                Who can join the competition? I am confused.
                <div class="icon-labels">
                    <span class="pinned"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Pinned</span>
                </div>
            </div>
            <div class="col-md-3 meta">
                @me16
            </div>
            <div class="col-md-3 meta">
                7 Reply(s), Yesterday
            </div>
        </div>
    </div>
    <h3>Competition Rules</h3>
    <h3>Logistics</h3>
    <h3>Random</h3>
@endsection