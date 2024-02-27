<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center bg-light">
            <div class="col-md-8">
            <form id="register_form" method="POST" action="{{ route('register') }}" class="bg-white rounded-5 p-5 m-5">
                @csrf
                <h2>@php echo $page_title @endphp</h2>

                <div class="row mt-4 pt-4">
                            <!-- First Name -->
                            <div class="col mb-3">
                                <x-input-label for="first_name" :value="__('First Name')" class="cm-input-label" />
                                <x-text-input id="first_name" class="form-control" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <!-- Last Name -->
                            <div class="col mb-3">
                                <x-input-label for="last_name" :value="__('Last Name')" class="cm-input-label" />
                                <x-text-input id="last_name" class="form-control" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                            <!-- Alternative Name -->
                            <div class="col mb-3">
                                <x-input-label for="alt_name" :value="__('Alternative Name')" class="cm-input-label" />
                                <x-text-input id="alt_name" class="form-control" type="text" name="alt_name" :value="old('alt_name')" autocomplete="alt_name" />
                                <x-input-error :messages="$errors->get('alt_name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div class="col mb-3">
                                <x-input-label for="email" :value="__('Email')" class="cm-input-label" />
                                <x-text-input id="email" class="form-control" type="text" name="email" :value="old('email')" required autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                            <!-- Password -->
                            <div class="col mb-3">
                                <x-input-label for="password" :value="__('Password')" class="cm-input-label" />
                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new_password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Phone Number 1 -->
                            <div class="col mb-3">
                                <x-input-label for="phone1" :value="__('Phone Number 1')" class="cm-input-label" />
                                <x-text-input id="phone1" class="form-control" type="text" name="phone1" :value="old('phone1')" required autocomplete="phone1" />
                                <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                            <!-- Email 2 -->
                            <div class="col mb-3">
                                <x-input-label for="email2" :value="__('Secondary Email')"  class="cm-input-label" />
                                <x-text-input id="email2" class="form-control" type="email" name="email2" :value="old('email2')" autocomplete="email2" />
                                <x-input-error :messages="$errors->get('email2')" class="mt-2" />
                            </div>

                            <!-- Phone Number 2 -->
                            <div class="col mb-3">
                                <x-input-label for="phone2" :value="__('Phone Number 2')" class="cm-input-label" />
                                <x-text-input id="phone2" class="form-control" type="text" name="phone2" :value="old('phone2')" autocomplete="phone2" />
                                <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                            <!-- Address 1 -->
                            <div class="col mb-3">
                                <x-input-label for="address1" :value="__('Address 1')" class="cm-input-label" />
                                <x-text-input id="address1" class="form-control" type="text" name="address1" :value="old('address1')" autocomplete="address1" />
                                <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                            </div>

                            <!-- Address 2 -->
                            <div class="col mb-3">
                                <x-input-label for="address2" :value="__('Address 2')" class="cm-input-label" />
                                <x-text-input id="address2" class="form-control" type="text" name="address2" :value="old('address2')" autocomplete="address2" />
                                <x-input-error :messages="$errors->get('address2')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                            <!-- Address 3 -->
                            <div class="col mb-3">
                                <x-input-label for="address3" :value="__('Address 3')" class="cm-input-label" />
                                <x-text-input id="address3" class="form-control" type="text" name="address3" :value="old('address3')" autocomplete="address3" />
                                <x-input-error :messages="$errors->get('address3')" class="mt-2" />
                            </div>

                            <!-- City -->
                            <div class="col mb-3">
                                <x-input-label for="city" :value="__('City')" class="cm-input-label" />
                                <x-text-input id="city" class="form-control" type="text" name="city" :value="old('city')" autocomplete="city" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                    </div>
                    <div class="row">
                        <!-- Country -->
                        <div class="col mb-3">
                            <!-- Country -->
                                <x-input-label for="country_id" :value="__('Country')" class="cm-input-label" />
                                <select id="country_id" name="country_id" class="form-control select" required>
                                    <option value="">Select Country</option>
                                    {{-- Assuming you have a countries variable passed to your view --}}
                                    @foreach (['Israel', 'United States of America', 'Canada', 'United Kingdom', 'Australia', 'South Africa', 'France', 'Brazil', 'Chile'] as $preferredCountry)
                                        @php
                                            $country = $countries->where('name_en', $preferredCountry)->first();
                                        @endphp
                                        @if ($country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name_en }}</option>
                                        @endif
                                    @endforeach
                                    <option disabled>───────────</option> <!-- This line acts as a separator -->
                                    @foreach ($countries as $country)
                                        @if (!in_array($country->name_en, ['Israel', 'United States', 'Canada', 'United Kingdom', 'Australia', 'South Africa', 'France', 'Brazil', 'Chile']))
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name_en }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>

                            <!-- State -->
                            <div class="col mb-3">
                                <x-input-label for="state_id" :value="__('State/Province')" class="cm-input-label"  />
                                <select id="state_id" name="state_id" class="form-control select">
                                    <option value="">Select State/Province</option>
                                    {{-- The following options will be populated dynamically using JavaScript --}}
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" data-country="{{ $state->country_id }}">{{ $state->name_en }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
                            </div>
                        </div>
                            <script>
                                // Get references to the country select element and state select element
                                const countrySelect = document.getElementById('country_id');
                                const stateSelect = document.getElementById('state_id');
                                // Hide all states initially
                                stateSelect.querySelectorAll('option').forEach(option => {
                                    option.style.display = 'none';
                                });

                                // Add event listener to country select element to dynamically update states when the country selection changes
                                countrySelect.addEventListener('change', function () {
                                    const selectedCountryId = this.value;
                                    // Show states for the selected country and hide others
                                    stateSelect.querySelectorAll('option').forEach(option => {
                                        if (option.dataset.country === selectedCountryId || option.value === '') {
                                            option.style.display = 'block';
                                        } else {
                                            option.style.display = 'none';
                                        }
                                    });
                                    // Reset the state select to the default option
                                    stateSelect.value = '';
                                });
                            </script>

                        <div class="row">
                            <!-- ZIP/Post Code -->
                            <div class="col mb-3">
                                <x-input-label for="zip_post_code" :value="__('ZIP/Post Code')" class="cm-input-label" />
                                <x-text-input id="zip_post_code" class="form-control" type="text" name="zip_post_code" :value="old('zip_post_code')" autocomplete="zip_post_code" />
                                <x-input-error :messages="$errors->get('zip_post_code')" class="mt-2" />
                            </div>
                        <!-- User Type -->
                            <div class="col mb-3">
                                <x-input-label for="cat_id" :value="__('Category')" class="cm-input-label" />
                                <select id="cat_id" name="cat_id" class="form-select" required>
                                    <option value="">Select User Type</option>
                                    @foreach ($categories as $category)
                                        @if ($loop->iteration <= 3)
                                            <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                                {{ ucwords(str_replace('_', ' ', $category->category_name)) }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('cat_id')" class="mt-2" />
                            </div>
                    </div>
                <div class="row">
                    <!-- ZIP/Post Code -->
                    <div class="col mb-3">
                        &nbsp;
                    </div>
                    <!-- User Type -->
                    <div class="col mb-3">
                        <x-input-label for="language_id" :value="__('Language')" class="cm-input-label" />
                        <select id="language_id" name="language_id" class="form-select" required>
                            <option value="">Select User Type</option>
                            @foreach ($languages as $language)
                                @if ($loop->iteration <= 3)
                                    <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                        {{ $language->name_lan }} ({{ $language->name_en }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('cat_id')" class="mt-2" />
                    </div>
                </div>
                <div class="row pt-3s mt-3">
                    <!-- Submit Button -->
                        <div class="col-span-2 mb-3">
                            <button type="submit" class="btn btn-primary w-100 rounded-5">
                                {{ __('Register') }}
                            </button>
                    </div>
                </div>
        </form>

            </div>
        </div>
    </div>
    <script src="{{ mix('/js/forms.js') }}"></script>
</x-guest-layout>
