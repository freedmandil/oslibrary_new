@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">
        <!-- Dashboard Title -->
        <div class="row mb-4">

        </div>

        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Seforim
                            </a>
                        </li>
                        <!-- Add more links for other entities like Authors, Publishers -->
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="grid_container">
                <!-- Books Subtitle -->
                <div class="row mb-3">
                    <div class="col">
                        <h2>Seforim</h2>
                    </div>
                </div>
                <div class="form-group">
                    <label for="shelf_number">Shelf Number:</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control shelf_number_input" id="shelf_number_text" name="shelf_number_text" placeholder="Enter Shelf Number">
                        </div>
                        <div class="col">
                            <select class="form-control shelf_number_input ui search selection dropdown" id="shelf_number_dropdown" name="shelf_number">
                                <option value="">Select Shelf Number</option>
                                @foreach($shelfnumbers as $id => $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Books Table -->
                <script>const userLanguage = '{{ $user->sys_language->lan_code }}',
                              userAccessLevel = '{{ $user->access_level }}';
                </script>

                <div id="Grid_Container" class="container-fluid m-0 p-0 vh-100 w-100">
                    @if(old('shelf_number'))
                        <h2>Shelf Number: {{ old('shelf_number') }}</h2>
                    @endif

                    <div id="Books_Grid" class="ag-theme-alpine w-100 h-100"></div>
                </div>

            </main>
        </div>
    </div>


    <script>
        $('.dropdown').dropdown({
            fullTextSearch: 'exact',
            selectOnBlur: false,
            forceSelection: false,
            showOnFocus: false,
            sortSelect: true
        });
        document.addEventListener('DOMContentLoaded', function() {
            var booksGridView = new Library.BooksGridView();
        });
    </script>

@endsection
