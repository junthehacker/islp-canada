@extends('layouts/portal')

@section('title') Create Rubric Rule @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>The following error(s) must be resolved before continuing.</b>
                        <hr>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/portal/rubric') }}">Rubric</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/portal/rubric/' . $competition->id) }}">{{ $competition->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Rule</li>
                    </ol>
                </nav>
                <h1>Create Rubric Rule</h1>
                <br>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <label><b>Rule Name</b></label>
                            <p style="font-size: 12px;">Name for this rule.</p>
                            <input type="text" class="form-control" name="name" /><br>
                            <label><b>Maximum Score</b></label>
                            <p style="font-size: 12px;">Maximum score possible for the rule.</p>
                            <input type="number" class="form-control" value="100" name="score" /><br>
                            <label><b>Weight</b></label>
                            <p style="font-size: 12px;">Weight for this rule.</p>
                            <input type="number" class="form-control" value="10" name="weight" /><br>
                        </div>
                        <div class="col-md-6">
                            <label><b>Rule Description</b></label>
                            <p style="font-size: 12px;">A description for the rule, you can write instructions for judges here.</p>
                            <textarea class="form-control" name="description"></textarea><br>
                            <label><b>Group</b></label>
                            <p style="font-size: 12px;">Give this rule a group, for example Content.</p>
                            <input type="text" class="form-control" value="Ungrouped" name="group" /><br>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Create</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection