@extends('layouts/portal')

@section('title') Judging System @endsection

@section('content')
    @include('portal/partials/nav')

    <div class="container-fluid main-container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Warning</li>
                    </ol>
                </nav>
                <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Before Proceeding</h1>
                <p>By using the judging system, you agree to our Judge Code of Conduct.</p>
                <p>1. You should never actively tyring to discover the student identity behind posters.</p>
                <p>2. You should never disclose the score to anyone.</p>
                <p>3. If we believe you have breached the Judge Code of Conduct, we have the right to invalidate your judgement, and remove your account from our system.</p>
                <p>4. Be fair, and get amazed!</p>
                <a href="{{ url('portal/judge/list') }}"><button class="btn btn-warning"><i class="fa fa-check" aria-hidden="true"></i> I Agree, Proceed</button></a>
            </div>
        </div>
    </div>
@endsection