@extends('layouts.portal')

@section('title') Forum @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Forum</li>
            </ol>
        </nav>
        @include('portal.partials.commonstatus')
        <h1>Manage Forum</h1>
        <h3>Channels</h3>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($channels as $channel)
                <tr>
                    <td>{{ $channel->id }}</td>
                    <td>{{ $channel->name }}</td>
                    <td>{{ $channel->status }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                @if($channel->status === 'open')
                                <form method="post"
                                      action="{{ url('/portal/forum/channels/disable') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $channel->id }}"/>
                                    <button class="dropdown-item">Disable</button>
                                </form>
                                @else
                                <form method="post"
                                      action="{{ url('/portal/forum/channels/enable') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $channel->id }}"/>
                                    <button class="dropdown-item">Enable</button>
                                </form>
                                @endif
                                <form method="post"
                                             action="{{ url('/portal/forum/channels/delete') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $channel->id }}"/>
                                    <button class="dropdown-item"><i class="fa fa-trash"
                                                                     aria-hidden="true"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h4>Create New Channel</h4>
        <form action="{{ url('portal/forum/channels') }}" method="post">
            <label>Channel Name</label>
            {{ csrf_field() }}
            <input type="text" class="form-control" name="name"/><br/>
            <button class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection