@extends('layouts/portal')

@section('title') Login @endsection

@section('content')

    <div class="container login-form">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fa fa-sign-in" aria-hidden="true"></i> ISLP Canadian National Statistics Poster Competiton Portal Login</h1>
                <p>Unified Authentication Service</p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="post">
                    {{ csrf_field() }}
                    <input type="text" name="email" placeholder="User ID" class="form-control"/><br>
                    <input type="password" name="password" placeholder="Password" class="form-control"/><br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i> Login
                    </button>
                    <a href="{{url('/')}}">
                        <button type="button" class="btn btn-light">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Home
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>

@endsection