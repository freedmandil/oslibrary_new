@extends('layouts.app')

@section('title', env('APP_NAME', 'OS Library Error'))

@section('content')
        <div class="container-fluid">
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
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Shelf Number</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id }}</th>
                                <td>{{ $book->title->name }}</td> <!-- Assuming you have title relationship -->
                                <td>{{ $book->author->name }}</td> <!-- Assuming you have author relationship -->
                                <td>{{ $book->publisher->name }}</td> <!-- Assuming publisher relationship -->
                                <td>{{ $book->shelf_number }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </main>
            </div>
        </div>
    @endsection

