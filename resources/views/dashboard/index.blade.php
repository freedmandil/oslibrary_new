@extends('layouts.app')

@section('title', env('APP_NAME', 'OS Library Error'))

@section('content')
    <h1>Dashboard</h1>
@php
    echo print_r($user,true);
@endphp
@endsection
