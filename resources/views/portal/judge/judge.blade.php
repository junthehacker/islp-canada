@extends('layouts/portal')

@section('title') Judging System @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container" id="app">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/portal/judge/list') }}">All Assignments</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Judge</li>
                    </ol>
                </nav>
                @if($competition && $competition->status === 'begin_judging' && $result && !$result->result)
                    <h1>Score Sheet # {{ $result->id }}</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Judge</h4>
                            <form method="post" id="score-form">
                                {{ csrf_field() }}
                                @foreach($rule_groups as $rule_group)
                                    <hr>
                                    <h5>{{ $rule_group }}</h5>
                                    @foreach($rules as $rule)
                                        @if($rule->group === $rule_group)
                                            <b>{{ $rule->name }} Out of {{ $rule->score }}</b>
                                            , <b>Weight of {{ $rule->weight }}</b>
                                            <p>{{ $rule->description }}</p>
                                            <input type="number" name="score-{{ $rule->id }}" class="form-control"
                                                   value="0"/>
                                        @endif
                                    @endforeach
                                @endforeach
                                <hr>
                                <h5>Additional Notes</h5>
                                <textarea class="form-control" form="score-form" name="notes"></textarea>
                                <hr>
                                <div class="alert alert-light">After submission, you will not be able to modify the
                                    score.
                                </div>
                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h4>Poster</h4>
                            <img src="{{ $result->poster->image_base64 }}" style="max-width: 100%;"/>
                        </div>
                    </div>
                @else
                    <p>Invalid</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function calculateScoreTotal(){

        }
    </script>
@endsection