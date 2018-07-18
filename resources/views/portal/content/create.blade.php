@extends('layouts.portal')

@section('title') Create Text Resource @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ url('portal/content') }}">Content</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Create New Text Resource</h1>
        <hr>
        <form method="post" id="create-text-resource-table">
            {{ csrf_field() }}
            <label>Identifier (*, must be unique)</label>
            <input type="text" name="identifier" class="form-control" placeholder="Identifier" />
            <br>
            <label>English Content (*)</label>
            <textarea class="form-control" form="create-text-resource-table" name="content_en" style="height: 100px;"></textarea>
            <br>
            <label>French Content (*, if not sure, make it same as English)</label>
            <textarea class="form-control" form="create-text-resource-table" name="content_fr" style="height: 100px;"></textarea>
            <br>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection