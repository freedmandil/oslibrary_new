<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="navbar bg-base-100 px-4">
        <!-- Logo and Title -->
        <div class="navbar-start">
            <a href="{{ route('dashboard') }}" class="btn btn-ghost normal-case text-xl">
                <img src="{{ asset('svg/library_logo.svg') }}" alt="Library Logo" class="w-10 h-10 mr-2">
                @yield('title')
            </a>
        </div>

        <!-- Right-side Links -->
        <div class="navbar-end items-center">
            <!-- Search -->
            <a href="{{ route('search') }}" class="btn btn-ghost">Search</a>

            <!-- Login Dropdown -->
            <div class="dropdown dropdown-end dropdown-hover">
                <label tabindex="0" class="btn btn-ghost">Login</label>
                <!-- Adjust dropdown positioning -->
                <div tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52" style="right:0;">
                    <div class="card card-compact w-96 bg-base-100 shadow-xl" style="background-color: rgba(255, 255, 255, 1);">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Email</span>
                                    </label>
                                    <input type="email" placeholder="email@example.com" class="input input-bordered" name="email" required>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Password</span>
                                    </label>
                                    <input type="password" placeholder="********" class="input input-bordered" name="password" required>
                                </div>
                                <div class="form-control mt-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                <div class="text-sm mt-4 text-center">
                                    <a href="{{ route('register') }}" class="link link-primary">Not registered? Sign up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</nav>
