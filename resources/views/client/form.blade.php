@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

    <style>
        .input-width-drop-down>input {
            position: relative !important;
            flex: none !important;
            width: 75% !important;
        }

        .input-width-drop-down>select {
            position: relative !important;
            flex: none !important;
            width: 25% !important;
        }
    </style>
@endsection

@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
    @php($isedit = !is_null($userData) || $id > 0)
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('client.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Basic Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php($profile_img = $userData?->profile_image_url ?? asset('upload/default.webp'))

                                <div class="profile-pic position-relative text-center col-lg-3 col-md-3 col-12">
                                    <label
                                        class="position-absolute w-50 h-50 d-flex align-items-end justify-content-end  text-white rounded-circle ms-5"
                                        for="file">
                                    </label>
                                    <input id="file" type="file" name="profile_image" hidden value=""
                                        accept="image/jpeg,image/png,image/webp" />
                                    <img src="{{ $profile_img }}" id="output"
                                        class="rounded-circle shadow border border-5 " width="165" height="165" />

                                    <small class="error profile_image-error"></small>
                                </div>

                                <div class="col-lg-9 col-md-9 col-12 ">
                                    <div class="row">
                                        <input type="hidden" id="id" name="id" value="{{ $id }}">

                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Name</label>
                                            <input type="name" id="name" placeholder="Name" class="form-control"
                                                name="name" value="{{ $isedit ? $userData?->name : '' }}">
                                        </div>

                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Email</label>
                                            <input type="email" id="email" placeholder="Email" class="form-control"
                                                name="email" value="{{ $isedit ? $userData?->email : '' }}">
                                        </div>
                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Mobile</label>
                                            <input type="tel" id="phone_no" placeholder="Mobile" class="form-control "
                                                name="phone_no" value="{{ $isedit ? $userData?->phone_no : '' }}">
                                        </div>


                                        @if (!$isedit)
                                            <div class="mb-1 col-lg-4 col-md-6 col-12">
                                                <label class="form-label">Password</label>
                                                <div class=" input-group input-group-merge form-password-toggle">
                                                    <input type="password" id="password" placeholder="Password"
                                                        class="form-control" name="password" aria-describedby="password">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div>
                                                <small class="error password-error"></small>
                                            </div>
                                            <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                                <label class="form-label">Confirm Password</label>
                                                <div class=" input-group input-group-merge form-password-toggle">
                                                    <input type="password" id="confirm_password"
                                                        placeholder="Confirm Password" class="form-control"
                                                        name="confirm_password" aria-describedby="confirm_password">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            data-feather="eye"></i></span>
                                                </div>
                                                <small class="error confirm_password-error"></small>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-12  ">
                                                <div id="requirements" class="d-flex flex-wrap border border-2 rounded p-1">
                                                    <p class="col-6" id="length"><i data-feather='frown'
                                                            id="ilength"></i> Min.
                                                        8 characters</p>
                                                    <p class="col-6" id="lowercase"><i data-feather='frown'
                                                            id="ilowercase"></i>
                                                        Include lowercase letter</p>
                                                    <p class="col-6" id="uppercase"><i data-feather='frown'
                                                            id="iuppercase"></i>
                                                        Include uppercase letter</p>
                                                    <p class="col-6" id="number"><i data-feather='frown'
                                                            id="inumber"></i>
                                                        Include number</p>
                                                    <p class="col-12" id="characters"><i data-feather='frown'
                                                            id="icharacters"></i>
                                                        Include a special character:
                                                        #.-?!@$%^&*</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Address Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" id="address_id" name="address_id"
                                    value="{{ $UserAddress?->id }}">

                                <div class=" col-lg-4 col-md-6 col-12 ">
                                    <label for="user_country_id" class="form-label">Country</label>
                                    <select name="user_country_id" id="user_country_id" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $isedit && $userData?->user_country_id == $country->id ? 'selected' : '' }}>
                                                {{ $country->country_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4 col-md-6 col-12 ">
                                    <label for="user_state_id" class="form-label">State</label>
                                    <select name="user_state_id" id="user_state_id" class="form-select select2">
                                        <option value="">Select</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ $isedit && $userData?->user_state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->state_name }}</option>
                                            @if ($isedit && $userData?->user_state_id == $state->id)
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        setcities({{ $userData->user_state_id }}, {{ $userData->user_city_id }});
                                                    });
                                                </script>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                                <div class=" col-lg-4 col-md-6 col-12 ">
                                    <label for="user_city_id" class="form-label">City</label>
                                    <select name="user_city_id" id="user_city_id" class="form-select select2">
                                        <option value="">Select</option>
                                    </select>
                                </div>

                                <div class=" col-lg-4 col-md-6 col-12 mt-1">
                                    <label class="form-label " for="address_line_1">Flat, House no., Building, Company,
                                        Apartment</label>
                                    <input type="text" id="address_line_1"
                                        placeholder="Flat, House no., Building, Company,Apartment" class="form-control"
                                        name="address_line_1" value="{{ $UserAddress?->address_line_1 }}">
                                </div>
                                <div class=" col-lg-4 col-md-6 col-12 mt-1">
                                    <label class="form-label " for="address_line_2">Area, Street, Sector, Village</label>
                                    <input type="text" id="address_line_2" placeholder="Area, Street, Sector, Village"
                                        class="form-control" name="address_line_2"
                                        value="{{ $UserAddress?->address_line_2 }}">
                                </div>
                                <div class=" col-lg-4 col-md-6 col-12 mt-1">
                                    <label class="form-label" for="landmark">Landmark</label>
                                    <input type="text" id="landmark" placeholder="E.g. near apollo hospital"
                                        class="form-control" name="landmark" value="{{ $UserAddress?->landmark }}">
                                </div>
                                <div class=" col-lg-4 col-md-6 col-12 mt-1">
                                    <label class="form-label" for="pincode">Pincode</label>
                                    <input type="number" id="pincode" placeholder="6 digits [0-9] PIN code"
                                        class="form-control" name="pincode" value="{{ $userData?->pincode }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-1">
                        <div class="col-12 col-md-12 text-end">
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                            <button type="submit" class="btn btn-primary ms-50 waves-effect waves-float waves-light"><i
                                    data-feather='save'></i> {{ $isedit ? 'Update' : 'Create' }}
                                Client</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection


@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.in.js')) }}"></script>

@endsection

@section('page-script')




    <script>
        $(document).ready(function() {

            $('.select2').select2({
                // dropdownAutoWidth: true,
                minimumResultsForSearch: 0,
                placeholder: 'Select',
            });
        });

        $(document).ready(function() {
            $('#file').on('change', function(event) {
                $('#output').attr('src', URL.createObjectURL(event.target.files[0]));
            });
            const password = $("#password");

            function updateRequirement(id, valid) {
                var requirement = $("#" + id),
                    icon = $("#i" + id);
                if (valid) {
                    requirement.addClass("text-success");
                    icon.attr("data-feather", "smile");
                } else {
                    requirement.removeClass("text-success");
                    icon.attr("data-feather", "frown");
                }
                feather.replace();

            }

            password.on("input", function() {
                const value = password.val();
                updateRequirement("length", value.length >= 8);
                updateRequirement("lowercase", /[a-z]/.test(value));
                updateRequirement("uppercase", /[A-Z]/.test(value));
                updateRequirement("number", /\d/.test(value));
                updateRequirement("characters", /[#.?!@$%^&*-]/.test(value));
            });
        });


        $(document).on('change', '#user_state_id', function(e) {
            e.preventDefault();
            var state_id = $(this).val();
            setcities(state_id)
        });

        function setcities(state_id, value = 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('get.cities') }}",
                data: {
                    state_id: state_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        var city_select = $('#user_city_id');
                        city_select.empty();

                        html = '';
                        response.data.forEach(function(city) {
                            html +=
                                `<option value="${city.id}"  ${value != 0 && value == city.id ? 'selected' : ''}>${city.city_name}</option>`;

                        });
                        city_select.append(html);

                        // Reinitialize the select2 for the new elements
                        $('.select2').select2({
                            minimumResultsForSearch: 0,
                            placeholder: 'Select',
                        });
                    } else {
                        toastr.error('👋 ' + response.message, 'Somthing Wrong!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                },
                error: function(error) {
                    console.log('error :: ', error?.status, error?.statusText)

                    toastr.error('Cities not found👋',
                        'Somthing Wrong!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }
            });
        }
    </script>



    {{-- Page js files --}}
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
