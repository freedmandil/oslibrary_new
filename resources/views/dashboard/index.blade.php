@extends('layouts.app')

@section('title', env('APP_NAME', 'OS Library Error'))

@section('content')
    <h1>Dashboard</h1>
    @php
    var_export($user,true);
    @endphp
@endsection
