<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link href="{{ mix('/css/all.css') }}" rel="stylesheet">
        <link href="{{ mix('/css/bootstrap.css') }}" rel="stylesheet">
    @if (Session::get('user_language') == 'he')
            <link href="{{ mix('/css/bootstrap.rtl.css') }}" rel="stylesheet">
        @endif
        <link href="{{ url('colors.css') }}" rel="stylesheet">

        <!-- Fonts -->

        <!-- Scripts -->
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="{{ mix('/js/core.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>

        <script src="{{ mix('/js/models.js') }}"></script>
        <script src="{{ mix('/js/views.js') }}"></script>

        <script src="{{ mix('/js/utils.js') }}"></script>
        <script src="{{ mix('/js/semantic.js') }}"></script>


    </head>
    <body>

    @include('partials.toast')
    <div class="spinner-overlay hide flex-column align-items-center">
        <div class="spinner-border text-primary" role="status"></div>
        <div class="spinner_msg">Loading...</div>
    </div>
        <div>
            @include('layouts.navigation')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm">
                    <div class="container py-3">
                        {{ $header }}
                    </div>
                </header>
            @endif

<main>
    <div id="alert-container"></div>
    <div id="modal-container"></div>

    <div class="w-100" id="view_container"></div>
    <div class="w-100" id="edit_container"></div>
    <div class="w-100" id="delete_container"></div>
    <div class="bg-light">
            @yield('content')
        </div>
</main>

<footer>
    <!-- Footer Content -->
</footer>
        </div>


</body>
<script>
</script>
</html>
