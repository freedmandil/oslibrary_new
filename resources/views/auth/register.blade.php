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
                        <div class="col mb-3">
                            <!-- Country -->
                                <x-input-label for="country_id" :value="__('Country')" class="cm-input-label cm-required-field" required />
                                <select id="country_id" name="country_id" class="dropdown ui search selection w-100 country_id" required>
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name_en }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                            </div>

                            <!-- State -->
                            <div class="col mb-3">
                                <x-input-label for="state_id" :value="__('State/Province')" class="cm-input-label"  />
                                <div id="state_container" >
                                </div>
                                <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
                            </div>
                        </div>

                        <div class="row">
                            <!-- ZIP/Post Code -->
                            <div class="col mb-3">
                                <x-input-label for="zip_post_code" :value="__('ZIP/Post Code')" class="cm-input-label" />
                                <x-text-input id="zip_post_code" class="form-control" type="text" name="zip_post_code" :value="old('zip_post_code')" autocomplete="zip_post_code" />
                                <x-input-error :messages="$errors->get('zip_post_code')" class="mt-2" />
                            </div>
                        <!-- User Type -->
                            <div class="col mb-3">
                                <x-input-label for="cat_id" :value="__('Category')" class="cm-input-label cm-required-field" required />
                                <select id="cat_id" name="cat_id" class="ui search selection dropdown w-100" required>
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
                    <!-- Language Type -->
                    <div class="col mb-3">
                        <x-input-label for="language_id" :value="__('Language')" class="cm-input-label cm-required-field" />
                        <select id="language_id" name="language_id" class="ui search selection dropdown w-100 " required>
                            <option value="">Select User Language</option>
                            @foreach ($languages as $language)
                                    <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                        {{ $language->name_lan }} ({{ $language->name_en }})
                                    </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('language_id')" class="mt-2" />
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
    <script>
        // $('#country_id').dropdown({fullTextSearch: 'exact', selectOnBlur: false, forceSelection: false, showOnFocus: false,sortSelect: true});
        // $('#cat_id').dropdown({fullTextSearch: 'exact', selectOnBlur: false, forceSelection: false, showOnFocus: false,sortSelect: true});
        // $('#language_id').dropdown({fullTextSearch: 'exact', selectOnBlur: false, forceSelection: false, showOnFocus: false,sortSelect: true});

        $('.dropdown').dropdown({
            fullTextSearch: 'exact',
            selectOnBlur: false,
            forceSelection: false,
            showOnFocus: false,
            sortSelect: true
        });
            // document.addEventListener('DOMContentLoaded', function() {
            $('#country_id').on('change', function () {
                    const countrySelect = $('#country_id');
                    var country_id = countrySelect.val();
                    // Clear existing options in the state dropdown
                    $('#state_id').remove();

                    // Show spinner or loading indicator
                    Utils.showSpinner(); // Ensure this is a function call

                    // Fetch states for the selected country using AJAX
                    $.ajax({
                        url: '/api/system/getStatesbyCountry/' + country_id, // 'value' is the selected country_id from the dropdown
                        success: function (response) {
                            // Append the new select element for states
                            $('#state_container').append('<select id="state_id" name="state_id" class="hide ui dropdown search selection w-100">' +
                                '<option value="">Select State/Province</option>' +
                                '</select>');
                            // Check if the response contains states
                            if (response.length > 0) {
                                // Populate the state dropdown with the fetched states
                                const options = response.map(state => `<option value="${state.id}">${state.name_en} (${state.short_en})</option>`).join('');
                                // Initialize the dropdown now that the select element is populated and in the DOM
                                $('#state_id').dropdown({
                                    fullTextSearch: 'exact',
                                    selectOnBlur: false,
                                    forceSelection: false,
                                    showOnFocus: false,
                                    sortSelect: true
                                }).append(options);
                                // Remove the 'hide' class to show the dropdown
                                // Assuming your element has an id 'myElement'
                                $('#state_id').removeClass('hide');
                            }
                            // Hide spinner or loading indicator
                            Utils.hideSpinner();
                        },
                        error: function (xhr, status, error) {
                            // Hide spinner or loading indicator on error
                            Utils.hideSpinner(); // Ensure this is a function call
                        }
                    });

            });

          //  });
    </script>
</x-guest-layout>
