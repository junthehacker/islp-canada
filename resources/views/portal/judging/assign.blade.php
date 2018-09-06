@extends('layouts.portal')

@section('title') Assign Judge - Judging @endsection

@section('content')
    @include('portal.partials.nav')
    <div class="container-fluid main-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{url('/portal/judging')}}">Judging</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Assign Judge</li>
            </ol>
        </nav>
        <h1>Manual Assign Judge</h1>
        <h3>Manually assign judge to a submission</h3>
        @include('portal.partials.commonsuccess')
        <div class="row">
            <div class="col-md-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <h3 class="card-title">Choose a Judge</h3>
                        @if(count($judges) === 0)
                            <p>No more judges to assign.</p>
                        @else
                            <form method="post">
                                {{ csrf_field() }}
                                <select class="form-control" name="user_id">
                                    @foreach($judges as $judge)
                                        <option value="{{ $judge->id }}">{{ $judge->email }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <button class="btn btn-primary">Confirm &amp; Add</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <table class="table table-light">
            <thead>
                <tr>
                    <th>Poster Title</th>
                    <th>School</th>
                    <th>Group</th>
                    <th>Assigned Judges</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($poster->judging_results as $key => $result)
                <tr>
                    @if($key === 0)
                        <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->title }}</td>
                        <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->user->teacher->school }}</td>
                        <td rowspan="{{ count($poster->judging_results) }}">{{ $poster->getGroupName() }}</td>
                    @endif
                    <td>
                        {{ $result->user->email }}<br>
                    </td>
                    <td class="@if($result->result) scored-td @else pending-td @endif">
                        @if($result->result)
                            {{ $result->result['final_percentage'] * 100 }}%
                        @else
                            Pending
                        @endif
                        <br>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection