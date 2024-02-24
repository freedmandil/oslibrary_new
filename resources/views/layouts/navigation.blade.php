<nav x-data="{ open: false }" class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <!-- Logo and Title -->
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <img src="{{ asset('svg/library_logo.svg') }}" alt="Library Logo" class="d-inline-block align-top" width="30" height="30">
            @yield('title')
        </a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Search -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('search') }}">Search</a>
                </li>

                <!-- Login Dropdown -->
                <li class="nav-item dropdown">
                    @php if (Auth::check()) { @endphp
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @php } else { @endphp
                        <!-- Register -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Login
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end m-0 p-0 border-0 col-md-10 " aria-labelledby="navbarDropdown">
                        <li>
                            <div class="card ">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="login_email" class="form-label cm-input-label">Email</label>
                                            <input type="email" class="form-control" id="login_email" name="email" autocomplete="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="login_password" class="form-label cm-input-label">Password</label>
                                            <input type="password" class="form-control" id="login_password" name="password" autocomplete="password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                        <div class="text-sm mt-2 text-center">
                                            <a href="{{ route('register') }}" class="text-primary">Not registered? Sign up</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                    @php } @endphp

                </li>

            </ul>
        </div>
    </div>
</nav>
