<x-guest-layout>
    <div class="container justify-center">
        <form method="POST" action="{{ route('register') }}" class="w-full bg-white rounded px-4 pt-6 pb-8 mb-4"> <!-- Form container with 50% width -->
            @csrf

            <div class="grid grid-cols-2 gap-6 "> <!-- Grid layout for form fields -->
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Alternative Name -->
                <div>
                    <x-input-label for="alt_name" :value="__('Alternative Name')" />
                    <x-text-input id="alt_name" class="block mt-1 w-full" type="text" name="alt_name" :value="old('alt_name')" autocomplete="alt_name" />
                    <x-input-error :messages="$errors->get('alt_name')" class="mt-2" />
                </div>

        <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Phone Number 1 -->
                <div>
                    <x-input-label for="phone1" :value="__('Phone Number 1')" />
                    <x-text-input id="phone1" class="block mt-1 w-full" type="text" name="phone1" :value="old('phone1')" autocomplete="phone1" />
                    <x-input-error :messages="$errors->get('phone1')" class="mt-2" />
                </div>

                <!-- Email 2 -->
                <div>
                    <x-input-label for="email2" :value="__('Secondary Email')" />
                    <x-text-input id="email2" class="block mt-1 w/full" type="email" name="email2" :value="old('email2')" autocomplete="email2" />
                    <x-input-error :messages="$errors->get('email2')" class="mt-2" />
                </div>

                <!-- Phone Number 2 -->
                <div>
                    <x-input-label for="phone2" :value="__('Phone Number 2')" />
                    <x-text-input id="phone2" class="block mt-1 w/full" type="text" name="phone2" :value="old('phone2')" autocomplete="phone2" />
                    <x-input-error :messages="$errors->get('phone2')" class="mt-2" />
                </div>

                <!-- Address 1 -->
                <div>
                    <x-input-label for="address1" :value="__('Address 1')" />
                    <x-text-input id="address1" class="block mt-1 w/full" type="text" name="address1" :value="old('address1')" autocomplete="address1" />
                    <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                </div>

                <!-- Address 2 -->
                <div>
                    <x-input-label for="address2" :value="__('Address 2')" />
                    <x-text-input id="address2" class="block mt-1 w/full" type="text" name="address2" :value="old('address2')" autocomplete="address2" />
                    <x-input-error :messages="$errors->get('address2')" class="mt-2" />
                </div>

                <!-- Address 3 -->
                <div>
                    <x-input-label for="address3" :value="__('Address 3')" />
                    <x-text-input id="address3" class="block mt-1 w/full" type="text" name="address3" :value="old('address3')" autocomplete="address3" />
                    <x-input-error :messages="$errors->get('address3')" class="mt-2" />
                </div>

                <!-- City -->
                <div>
                    <x-input-label for="city" :value="__('City')" />
                    <x-text-input id="city" class="block mt-1 w/full" type="text" name="city" :value="old('city')" autocomplete="city" />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <!-- Country -->
                <div class="form-control">
                    <x-input-label for="country_id" :value="__('Country')" />
                    <select id="country_id" name="country_id" class="block mt-1 w-full select " required>
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

                <!-- ZIP/Post Code -->
                <div>
                    <x-input-label for="zip_post_code" :value="__('ZIP/Post Code')" />
                    <x-text-input id="zip_post_code" class="block mt-1 w/full" type="text" name="zip_post_code" :value="old('zip_post_code')" autocomplete="zip_post_code" />
                    <x-input-error :messages="$errors->get('zip_post_code')" class="mt-2" />
                </div>

                <!-- State -->
                <div>
                    <x-input-label for="state" :value="__('State')" />
                    <select id="state" name="state" class="block mt-1 w-full select">
                        <option value="">Select State</option>
                        {{-- The following options will be populated dynamically using JavaScript --}}
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" data-country="{{ $state->country_id }}">{{ $state->name_en }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>

                <script>
                    // Get references to the country select element and state select element
                    const countrySelect = document.getElementById('country_id');
                    const stateSelect = document.getElementById('state');
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

                <!-- User Type -->
                <div class="form-control">
                    <x-input-label for="cat_id" :value="__('Category')" />
                    <select id="cat_id" name="cat_id" class="block mt-1 w-full select" required>
                        <option value="">Select User Type</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('cat_id')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="col-span-1 md:col-span-2 lg:col-span-2">
                    <button type="submit" class="btn btn-primary w-full mt-4">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
         </form>
    </div>
</x-guest-layout>

