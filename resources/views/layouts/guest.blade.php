@extends('layouts.app')

@section('title', env('APP_NAME', 'OS Library Error'))

@section('content')
    <div class="mt-6 px-4 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
@endsection
