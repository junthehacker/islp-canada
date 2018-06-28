@extends('layouts/forum')

@section('content')
    <h1>New Post</h1>
    @include('partials.commonstatus')
    <form method="post" id="new-post-form">
        {{ csrf_field() }}
        <input type="hidden" name="forum_post_id" value="" />
        <label>Post Title</label>
        <input type="text" class="form-control" name="title" />
        <label>Post Content</label>
        <p class="text-muted">MarkDown is supported, maximum 5000 characters.</p>
        <textarea class="form-control" style="height: 200px;" name="content" form="new-post-form"></textarea>
        <label>Channel to Post</label>
        <select class="form-control" name="forum_channel_id">
            @forelse($channels as $channel)
                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
            @empty
                <option>No channel available</option>
            @endforelse
        </select>
        <label>Posting as {{ explode('@', request()->user->email)[0] }}#{{ request()->user->id }}</label>
        <br />
        <button class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Post</button>
    </form>
@endsection