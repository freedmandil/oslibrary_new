@extends('layouts.app')

@section('title', env('APP_NAME', 'OS Library Error'))

@section('content')
        {{ $slot }}
@endsection
