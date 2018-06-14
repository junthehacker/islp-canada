@extends('layouts.error')

@section('code') 401 @endsection

@section('message')
    <p>Oops, seems like you are not authorized to view this page. Maybe try to login? <a href="{{ url('portal/login') }}">{{ url('portal/login') }}</a>.</p>
@endsection