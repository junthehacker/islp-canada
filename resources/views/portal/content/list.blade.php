@extends('layouts.portal')

@section('title') Website Content @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Content</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Manage Content</h1>
        <a href="{{url('portal/content/create')}}">
            <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Create New Text Resource
            </button>
        </a>
        <hr>
        <h3>All Text Resources</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Identifier</th>
                <th scope="col">English Content</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($string_resources as $string_resource)
                <tr>
                    <td>{{ $string_resource->identifier }}</td>
                    <td>{{ substr($string_resource->content_en, 0, 255) }}</td>
                    <td>{{ date('M jS, Y G:i e', strtotime($string_resource->created_at)) }}</td>
                    <td>{{ date('M jS, Y G:i e', strtotime($string_resource->updated_at)) }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle"
                                    data-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </button>
                                <a href="{{ url('portal/content/delete/' . $string_resource->id) }}">
                                    <button class="dropdown-item">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                    </button>
                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection