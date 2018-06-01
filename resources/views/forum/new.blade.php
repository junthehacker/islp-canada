@extends('layouts/forum')

@section('content')
    <h1>New Post</h1>
    <form>
        <label>Post Title</label>
        <input type="text" class="form-control" />
        <label>Post Content</label>
        <p class="text-muted">MarkDown is supported, maximum 5000 characters.</p>
        <textarea class="form-control" style="height: 200px;"></textarea>
        <label>Channel to Post</label>
        <select class="form-control">
            <option>General</option>
        </select>
    </form>
    <button class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Post</button>
@endsection