@extends('layouts/forum')

@section('content')
    <h1>All Posts</h1>
    <a href="{{ url('forum/new') }}">
        <button class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Create New Post</button>
    </a>
    @foreach($channels as $channel)
        <h3>{{ $channel->name }}</h3>
        @foreach($channel->forum_posts as $post)
            @if(!$post->forum_post_id)
                <div class="post-overview-card">
                    <a href="{{ url('forum/posts/' . $post->id) }}">
                        <div class="row">
                            <div class="col-md-6">
                                {{ $post->title }}
                            </div>
                            <div class="col-md-3 meta">
                                {{ explode('@', $post->user->email)[0] }}#{{ $post->user->id }}
                            </div>
                            <div class="col-md-3 meta">
                                {{ count($post->forum_posts) }} Reply(s), {{ $post->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    @endforeach
    <br><br>
@endsection