<x-guest-layout>
    @include('partials.alert');
    <div class="container">
        <div class="row justify-content-center bg-light">
            <div class="col-md-8">
                <form method="POST" action="{{ route('login') }}" class="bg-white rounded-5 p-5 m-5">
                    @csrf
                    <h2>{{ __('Login') }}</h2>

                    <!-- Email Address -->
                    <div class="row mt-4 pt-4">
                        <div class="col mb-3">
                            <x-input-label for="email" :value="__('Email')" class="cm-input-label" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row">
                        <div class="col mb-3">
                            <x-input-label for="password" :value="__('Password')" class="cm-input-label" />
                            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="row">
                        <div class="col mb-3 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
