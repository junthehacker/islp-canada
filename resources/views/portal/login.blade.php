@extends('layouts/portal')

@section('title') Login @endsection

@section('content')

    <div class="container login-form">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="fa fa-sign-in" aria-hidden="true"></i> ISLP Portal Login</h1>
                <p>ISLP Unified Authentication Service</p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="post">
                    {{ csrf_field() }}
                    <input type="text" name="email" placeholder="User ID" class="form-control"/><br>
                    <input type="password" name="password" placeholder="Password" class="form-control"/><br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</button>
                </form>
            </div>
        </div>
    </div>

@endsection