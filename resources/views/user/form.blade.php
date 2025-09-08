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
                <form method="post" action="{{ route('store.user') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Basic Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php($profile_img = asset($isedit && file_exists(public_path('upload/user/' . $userData?->profile_picture)) && !empty($userData?->profile_picture) ? 'upload/user/' . $userData?->profile_picture : 'upload/user/default.webp'))

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
                                        @if (!$isedit)
                                            @role('supperadmin')
                                                @php($user_type = 'admin')
                                            @endrole
                                            @role('admin')
                                                @php($user_type = 'staff')
                                            @endrole
                                            @role('staff')
                                                @php($user_type = 'staff')
                                            @endrole
                                            <input type="hidden" id="user_type" name="user_type"
                                                value="{{ $user_type ?? '' }}">

                                            <small class="error user_type-error"></small>
                                        @else
                                            <input type="hidden" id="user_type" name="user_type"
                                                value="{{ $isedit ? $userData?->getRoleNames()->first() : '' }}">
                                            <small class="error user_type-error"></small>
                                        @endif
                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Name</label>
                                            <input type="name" id="name" placeholder="Name" class="form-control"
                                                name="name" value="{{ $isedit ? $userData?->name : '' }}">
                                        </div>
                                        <input type="hidden" id="id" name="id" value="{{ $id }}">

                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Email</label>
                                            <input type="email" id="email" placeholder="Email" class="form-control"
                                                name="email" value="{{ $isedit ? decrypt_to($userData?->email) : '' }}">
                                        </div>
                                        <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                            <label class="form-label">Mobile</label>
                                            <input type="tel" id="mobile" placeholder="Mobile" class="form-control "
                                                name="mobile" value="{{ $isedit ? decrypt_to($userData?->mobile) : '' }}">
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
                                        @endif
                                        @if (Auth::user()->hasRole(['admin', 'staff']))
                                            <div class="mb-1 col-lg-4 col-md-6 col-12 ">
                                                <label class="form-label">Role</label>
                                                <select class="form-select select2" id="staff_role_id"
                                                    name="staff_role_id">
                                                    <option value="">Select User Type</option>

                                                    @foreach ($StaffRole as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $isedit && $userData?->staff_role_id === $role->id ? 'selected' : '' }}>
                                                            {{ ucwords(str_replace('-', ' ', $role->name)) }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="error staff_role_id-error"></small>
                                            </div>
                                        @endif

                                        @if (!$isedit)
                                            <div class="col-lg-8 col-md-8 col-12  ">
                                                <div id="requirements"
                                                    class="d-flex flex-wrap border border-2 rounded p-1">
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
                            <h4 class="card-title">Remark</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <textarea class="form-control" rows="3" name="user_remark">{{ $isedit ? $userData?->user_remark : '' }}</textarea>
                                </div>
                                <div class="col-12 pt-2 ">
                                    <button type="submit"
                                        class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ $isedit ? 'Update' : 'Create' }}</button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                                </div>
                            </div>
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
    </script>



    {{-- Page js files --}}
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
