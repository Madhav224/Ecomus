@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('content')
<style type="text/css">
    #profile_picture{
        height: 100px !important;
        width: 100px !important;
    }
    .img_preview{
        margin-top: 10px;
        display: flex;
        flex-direction: column-reverse;
        align-content: stretch;
        align-items: center;
        flex-direction: column;
    }
    .datatable-switch.form-check .form-check-inputg
    {
        height: 32px !important;
        /* background: #7367f0 !important;
        background: #7367f030 !important; */
        width: 32px !important;
    }
    .datatable-switch.form-check .form-check-label .switch-icon-left {
        left: 15px !important;
        /* top: 5px !important; */
        color: #7367f0 !important;
    }
    .datatable-switch.form-check .form-check-label .switch-icon-right {
        left: 15px !important;
        /* top: 5px !important; */
        color: #e7e6ec !important;
    } 
    .datatable-switch.form-check .form-check-input{
        background-image: none !important;
    }
    .form-check-primary .form-check-input:checked {
        border-color: #7367f0;
        background-color: #665dd540;
        color: #7367f0 !important;
    } 
    .datatable-switch.form-check .form-check-label .switch-icon-right 
    {
        color : #ea5455 !important;
    }
    .form-switch .form-check-input:not(:checked) {
        background-color:rgba(234, 84, 85, 0.12) !important;
    }
</style>
<section class="app-user-list">
<button class="btn btn-primary mb-1" id="addstaff"><i data-feather='plus'></i>&nbsp;Add</button>
    <div class="card">
            {!! createDatatableFormFilter($staffListFormData) !!}      
    </div>

    <div class="modal animated show" id="staffModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="staffForm" method="POST" name="staffForm" action="{{ route('store.staff') }}" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"  name="id" id="id">
                        
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="mb-1 col-6">
                                        <label class="form-label" for="basic-addon-name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon-name" />
                                        <small class="error name-error "></small>
                                    </div>
                                    <div class="mb-1 col-6">
                                        <label class="form-label" for="basic-addon-mobile">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile" aria-label="Mobile" aria-describedby="basic-addon-mobile" />
                                        <small class="error mobile-error "></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-6">
                                        <label class="form-label" for="basic-addon-email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon-email" />
                                        <small class="error email-error "></small>
                                    </div>
                                    <div class="mb-1 col-6" id="allpass">
                                        <label class="form-label" for="basic-addon-password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon-password" />
                                        <small class="error password-error "></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1 img_preview">
                                    <div id="image-preview">
                                        <div>
                                            <img id="profile_picture" src="{{ url('public/images/select_image.png') }}"  data-default-src="{{ url('public/upload/no-image.png') }}" alt="Preview" style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 1px solid #ccc;">
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        <label for="account_picture" class="btn btn-sm btn-primary mb-75 me-75">Upload Image</label>
                                        <input type="file" name="account_picture" id="account_picture" class="form-control preview-image-input" data-target="profile_picture" accept="image/*" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
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
@endsection

@section('page-script')
  {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>

    <script>
        $(document).ready(function() {
            const id = $(this).data('id');

            $("#addstaff").click(function() {
                $('#modelHeading').text('Add Staff');
                $('.error').html('');

                // Show the modal with the id "ajaxModel"
                $("#staffModel").modal("show");
            });
        });

        // document.getElementById('account_picture').addEventListener('change', function(event) {
        //     const previewImg = document.getElementById('profile_picture');
        //     const defaultSrc = previewImg.getAttribute('data-default-src');
        //     const file = event.target.files[0];

        //     if (file) {
        //         if (file.type.startsWith('image/')) {
        //             const reader = new FileReader();
        //             reader.onload = function(e) {
        //                 previewImg.src = e.target.result;
        //             };
        //             reader.onerror = function() {
        //                 console.error("Error reading file.");
        //                 alert("Failed to preview the image. Please try again.");
        //                 previewImg.src = defaultSrc;
        //             };
        //             reader.readAsDataURL(file);
        //         } else {
        //             alert("Unsupported file format. Please upload an image.");
        //             previewImg.src = defaultSrc;
        //         }
        //     } else {
        //         previewImg.src = defaultSrc;
        //     }
        // });

        $(document).on('click', '.openmodal-staffModel', function() {

            // Get references to the form elements
            var passwordField = document.getElementById('allpass');
            var idField = $(this).data('id');
            
            // Check if it's an edit mode
            if (idField) {
                passwordField.style.display = 'none'; // Hide password field for edit
            } else {
                passwordField.style.display = 'block'; // Show password field for add
            }
        });


    </script>
    
@endsection