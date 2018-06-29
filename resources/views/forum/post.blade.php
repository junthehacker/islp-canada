@extends('layouts/forum')

@section('content')
    <a href="{{ url("forum") }}">Back to Home</a>
    <hr>
    <h1>{{ $post->title }}</h1>
    <p class="post-meta">{{ explode('@', $post->user->email)[0] }}#{{ $post->user->id }}
        , {{ $post->updated_at->diffForHumans() }}, {{ $post->forum_channel->name }}</p>
    <div class="post-head-content">
        {!! Michelf\Markdown::defaultTransform($post->content) !!}
    </div>

    @foreach($post->forum_posts as $sub_post)
    <hr>

    <div class="reply-container">
        <p class="post-meta">{{ explode('@', $sub_post->user->email)[0] }}#{{ $sub_post->user->id }}
            , {{ $sub_post->updated_at->diffForHumans() }}</p>
        <p>
            {!! Michelf\Markdown::defaultTransform($sub_post->content) !!}
        </p>
    </div>
    @endforeach


    @if(request()->user)
        <hr>
        <h4>Reply</h4>
        <form method="post" action="{{ url('forum/new') }}" id="reply-post-form">
            {{ csrf_field() }}
            <input type="hidden" name="title" value="Reply {{ $post->id }}" />
            <input type="hidden" name="forum_post_id" value="{{ $post->id }}" />
            <input type="hidden" name="forum_channel_id" value="{{ $post->forum_channel->id }}" />
            <p class="text-muted">MarkDown is supported, maximum 5000 characters.</p>
            <textarea class="form-control" style="height: 100px;" name="content" form="reply-post-form"></textarea>
            <label>Posting as {{ explode('@', request()->user->email)[0] }}#{{ request()->user->id }}</label>
            <br/>
            <button class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Reply</button>
        </form>
    @endif

    <br><br><br><br>
@endsection