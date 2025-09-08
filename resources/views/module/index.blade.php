@extends('layouts/contentLayoutMaster')
@section('title', $title)
@section('vendor-style')
    <style>
        .disabled-link {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }

        .form-check-input.data_slug {
            /* width: 0.8rem; */
            /* height: 0.8rem; */
            margin-top: 0.3rem;
        }

        .slug_label {
            font-size: 0.9rem;
            margin-left: -0.2rem;
            margin-top: 0.3rem;
        }
    </style>
@endsection



@section('content')


    <!-- BEGIN: Content-->

    <section class="app-module-list">
        <a href="{{ route('module_form') }}" class="btn btn-primary mb-1"><i data-feather='plus'></i>&nbsp;Add
            Module</a>
        <div class="card">
            {!! createDatatableFormFilter($ModuleFilterData) !!}
        </div>
    </section>





    {{-- Model For Chnage Position --}}
    <div class="modal fade" id="position-model" tabindex="-1" aria-labelledby="position-model" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="position-model-label">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="table-status-form" style="display: none;">

                        <div class="border rounded p-1 mb-1">

                            <form action="#" class="mb-0 " method="POST" id="Tablestatus">
                                <input type="hidden" name="module_id" id="table_id">
                                <label class="fw-bold">Apply Actions to Modules</label>
                                <div class="mb-1 d-flex flex-wrap justify-content-start pt-1">
                                    <div class="form-check form-check-primary">
                                        <input type="checkbox" class="form-check-input" id="action_update" name="update"
                                            value="1" />
                                        <label class="form-check-label" for="action_update">Update Button</label>
                                    </div>
                                    <div class="form-check form-check-primary ms-1">
                                        <input type="checkbox" class="form-check-input" id="action_delete" name="delete"
                                            value="1" />
                                        <label class="form-check-label" for="action_delete">Delete Button</label>
                                    </div>
                                    <div class="form-check form-check-primary ms-1">
                                        <input type="checkbox" class="form-check-input" id="action_status" name="status"
                                            value="1" />
                                        <label class="form-check-label" for="action_status">Status Button</label>
                                    </div>
                                    <div class="form-check form-check-primary ms-1">
                                        <input type="checkbox" class="form-check-input" id="action_view" name="view"
                                            value="1" />
                                        <label class="form-check-label" for="action_view">View Button</label>
                                    </div>
                                    <div class="form-check form-check-primary ms-1">
                                        <input type="checkbox" class="form-check-input" id="action_add" name="add"
                                            value="1" />
                                        <label class="form-check-label" for="action_add">Add Button</label>
                                    </div>
                                    <div class="form-check form-check-primary">
                                        <input type="checkbox" class="form-check-input" id="export_btn" name="export"
                                            value="1" />
                                        <label class="form-check-label" for="export_btn">Export Button</label>
                                    </div>
                                    <div class="form-check form-check-primary ms-1">
                                        <input type="checkbox" class="form-check-input" id="import_btn" name="import"
                                            value="1" />
                                        <label class="form-check-label" for="import_btn">Import Button</label>
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label class="fw-bold">Select Fields to Show in Table</label>
                                    <select class="select2 form-select" id="feild_id" multiple name="feild_id[]">

                                    </select>
                                    <span class="error-message text-danger"></span>

                                </div>
                                <div class="d-flex justify-content-end ">

                                    <button type="button" class="btn btn-outline-primary" id="ChnageStatus">Update &
                                        Display Selected Fields</button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <h5 class="bold " id="sorting-label"></h5>
                    <p class="text-danger" id="sorting-note"></p>
                    <ul class="list-group mt-1" id="basic-list-group" data-type="">

                    </ul>
                </div>
                <div class="modal-footer" id="position-model-footer" style="display: none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="SaveList"><i data-feather='align-center'></i>
                        Rearrange Order</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end ... --}}

    {{-- Model For Filter --}}
    <div class="modal fade" id="filter-model" tabindex="-1" aria-labelledby="filter-model" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Module Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="border rounded p-1 mb-1">
                        <form action="#" class="mb-0 " method="POST" id="FilterForm">

                            <input type="hidden" name="moduleId" id="moduleId">

                            <div class="mb-1">
                                <label class="fw-bold">Choose Fields to Filter Data</label>
                                <select class="select2 form-select" id="is_filterId" multiple name="is_filterId[]">

                                </select>
                                <span class="error-message text-danger"></span>
                            </div>
                            <div class="d-flex justify-content-end ">
                                <button type="button" class="btn btn-outline-primary" id="is_filterBtn">Apply
                                    Filter</button>
                            </div>
                        </form>

                    </div>
                    <ul class="list-group mt-1" id="filterData">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="SaveFilter">Save Filter</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end ... --}}
    <!-- END: Body-->
@endsection


@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
<!-- BEGIN: Java Script-->
@section('page-script')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $('.select2').select2();


        //---------------------------------------------------------------------------------------------------------------------------------------------
        // Show  Feilds Records For Tabel show Feilds
        $(document).on('click', '.table-sort-btn', function() {

            let module_id = $(this).data("mid");
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('show.module_fields') }}", // Replace with your actual route
                data: {
                    "id": module_id
                },
                success: function(response) {
                    if (response.status == 404) {

                        toastr.error(response.message, 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }

                    var module_id = response.data.id;
                    var module_name = response.data.module_name;
                    var a_update = response.data.action_update;
                    var a_delete = response.data.action_delete;
                    var a_status = response.data.action_status;
                    var a_view = response.data.action_view;
                    var a_add = response.data.action_add;
                    var a_export = response.data.export_btn;
                    var a_import = response.data.import_btn;


                    var fields = response.data.fields;
                    $("#basic-list-group").empty(); // basic list group is empty

                    // checked values if action is give
                    $("#action_update").attr("checked", a_update == 1 ? true : false);
                    $("#action_delete").attr("checked", a_delete == 1 ? true : false);
                    $("#action_status").attr("checked", a_status == 1 ? true : false);
                    $("#action_view").attr("checked", a_view == 1 ? true : false);
                    $("#action_add").attr("checked", a_add == 1 ? true : false);
                    $("#export_btn").attr("checked", a_export == 1 ? true : false);
                    $("#import_btn").attr("checked", a_import == 1 ? true : false);

                    var selectTag = $("#feild_id");
                    selectTag.html('');
                    selectTag.val(null).trigger('change'); // select val is empty
                    $("#table_id").val(module_id); // set id in input *Module Id*

                    fields.forEach(function(field) {
                        var SelectVal = field.table_status == 1 ? 'selected' : '';
                        var option = `
                                <option value='${field.id}' ${SelectVal}>${field.title}</option>`;

                        // Append the item to the list
                        selectTag.append(option);
                    });


                    fields.sort(function(a, b) {
                        return a.table_sort - b.table_sort;
                    });



                    var listGroup = $("#basic-list-group");
                    listGroup.data('type', '');
                    listGroup.data('type', 'table_sort');

                    listGroup.empty();
                    fields.forEach(function(field) {

                        if (field.table_status == '1') {

                            var listItem = `
                                        <li class="list-group-item draggable border" data-mid="${module_id}" data-fid="${field.id}" >
                                            <div class="d-flex" >
                                                <div class="more-info">
                                               <i class="bi bi-grip-vertical"></i>
                                                    <h5>Title: ${field.title}</h5>
                                                    <span>Field: ${field.fields}</span>
                                                </div>
                                            </div>
                                        </li>`;

                            // Append the item to the list
                            listGroup.append(listItem);
                        }
                    });


                    $("#position-model-footer").show();

                    $("#table-status-form").show(); //Table fields status form show here
                    $("#position-model-label").text('Table Structure Sorting (' + response.data
                        .module_name + ')');
                    $("#sorting-label").text('Drag & Drop to rearrange the table structure🖐️');
                    // $("#position-model-footer").hide();
                    $("#position-model").modal("show");



                }
            })

        })

        //---------------------------------------------------------------------------------------------------------------------------------------------

        //---------------------------------------------------------------------------------------------------------------------------------------------
        // change status for show table data
        $(document).on('click', '#ChnageStatus', function(e) {
            e.preventDefault();
            var formData = new FormData($('#Tablestatus')[0]),
                form = $('#Tablestatus');
            $.ajax({
                url: "{{ route('update.status_tablefeilds') }}", // Replace with your actual route
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#ChnageStatus').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },

                success: function(response) {


                    if (response.status == 200) {
                        // alert(response.message);
                        toastr['success']('👋' + response.message, 'Sorting Update', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        var fields = response.data;

                        fields.sort(function(a, b) {
                            return a.table_sort - b.table_sort;
                        });

                        var listGroup = $("#basic-list-group");


                        listGroup.data('type', '');
                        listGroup.data('type', 'table_sort');

                        listGroup.empty();
                        fields.forEach(function(field) {
                            var listItem = `
                                    <li class="list-group-item draggable border" data-mid="${field.module_id}" data-fid="${field.id}" >
                                        <div class="d-flex" >
                                            <div class="more-info">
                                                <h5>Title: ${field.title}</h5>
                                                <span>Fields: ${field.fields}</span>
                                            </div>
                                        </div>
                                    </li>`;

                            // Append the item to the list
                            listGroup.append(listItem);
                        });

                        $("#position-model-footer").show();

                    } else {
                        toastr['error']('👋 Failed to update table actions and displayed fields!',
                            'Not Update', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }

                },
                error: function(error) {

                    console.log('Error :: ', error?.status, error?.statusText);

                    if (error.status === 422) {
                        var errors = error.responseJSON.errors;
                        for (var key in errors) {
                            if (errors[key]?.length > 0) {

                                var convertedString = key.replace(/\[|\]/g, '');

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ? $(
                                    '[name="' + key + '"]', form)[0] : $('[name="' + key + '[]"]',
                                    form);
                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString + '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g, ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error('👋' + (errors[key][0].replace('_id', '').replace(/_/g,
                                        ' ')),
                                    'Somthing Wrong!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });

                            }
                        }
                    } else {
                        // Handle unexpected errors
                        toastr.error('An unexpected error occurred!', 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        console.error('Error details:', error.responseText);
                    }

                },
                complete: function() {

                    $('#ChnageStatus').attr('disabled', false).html('Update & Display Selected Fields');

                }
            });
        });

        $(document).on('keyup change', 'input,select,date', function(event) {
            // Get the name attribute of the fieldElement
            var inputValue = $(this).attr('id');

            if (inputValue == undefined)
                return;
            // Remove the 'error' class from elements with the specified name
            $('[id="' + inputValue + '"]').removeClass('error');

            // Reset the content of elements with the specified class
            var inputValue = inputValue.replace(/\[|\]/g, '');
            $('.' + inputValue + '-error').html('');
        });
        //---------------------------------------------------------------------------------------------------------------------------------------------


        //---------------------------------------------------------------------------------------------------------------------------------------------
        // For Open Model With Fields Data For sorting of form_sort(Form Structure)
        $(document).on('click', '.form-sorting-btn', function() {
            $("#table-status-form").hide(); // Table fields status form hide here
            let module_id = $(this).data("mid");

            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('show.module_fields') }}", // Replace with your actual route
                data: {
                    "id": module_id
                },
                success: function(response) {
                    if (response.status == 404) {
                        toastr.error(response.message, 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }

                    var module_id = response.data.id;
                    var module_name = response.data.module_name;
                    var fields = response.data.fields;

                    fields.sort(function(a, b) {
                        return a.form_sort - b.form_sort;
                    });

                    var listGroup = $("#basic-list-group");
                    listGroup.data('type', '');
                    listGroup.data('type', 'form_sort');

                    listGroup.empty();
                    fields.forEach(function(field) {
                        var listItem = `
                                <li class="list-group-item draggable border" data-mid="${module_id}" data-fid="${field.id}" >
                                    <div class="d-flex" >
                                        <div class="more-info">
                                            <h5>Title: ${field.title}</h5>
                                            <span>Field: ${field.fields}</span>
                                             <div class="form-check w-100">
                                                <input type="checkbox" name="slug" class="form-check-input data_slug" id="slug${field.id}" value="1"
                                             ${field.is_slug == "1" ? "checked" : ""}/>
                                                <label class="form-check-label slug_label" for="slug${field.id}">As Slug</label>
                                            </div>
                                        </div>
                                            <div class="ms-auto w-25">

                                                <label class="fw-bold">Field Layout Size</label>
                                                <select class="form-select layout-size" aria-label="Default select example">
                                                <option value="col-md-4" ${field.layout_class == "col-md-4" ? "selected" : ""}>4 Columns Layout</option>
                                                <option value="col-md-6" ${field.layout_class == "col-md-6" ? "selected" : ""}>6 Columns Layout</option>
                                                <option value="col-md-8" ${field.layout_class == "col-md-8" ? "selected" : ""}>8 Columns Layout</option>
                                                <option value="col-md-10" ${field.layout_class == "col-md-10" ? "selected" : ""}>10 Columns Layout</option>
                                                <option value="col-md-12" ${field.layout_class == "col-md-12" ? "selected" : ""}>12 Columns Layout</option>
                                                </select>
                                        </div>



                                    </div>
                                </li>`;

                        // Append the item to the list
                        listGroup.append(listItem);
                    });
                    $("#position-model-label").text('Form Structure Sorting (' + response.data
                        .module_name + ')');
                    $("#sorting-label").text(
                        'Drag & Drop fields to create your perfect form layout🖐️');
                    $("#sorting-note").text(
                        'Note: This section is for the table fields structure. It will help change the structure of the table fields.'
                    );
                    $("#position-model-footer").show();
                    $("#position-model").modal("show");
                },
            });

        });
        //---------------------------------------------------------------------------------------------------------------------------------------------

        //---------------------------------------------------------------------------------------------------------------------------------------------
        // Module Duplicate script
        $(document).on('click', '.duplicate_module_btn', function() {
            var module_id = $(this).data('moduleid'),
                duplicate_element = $(this);
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to create a duplicate module!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Duplicate it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "{{ route('module.duplicate') }}",
                        data: {
                            "module_id": module_id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                toastr['success']('👋' + response.message, 'Duplicate Module', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                                reloadDataTable(duplicate_element);

                            } else {
                                toastr.error(response.message, 'Error', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                            }
                        },
                        error: function(error) {
                            toastr.error('An unexpected error occurred!', 'Error', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                            console.error('Error details:', error.responseText);
                        }
                    });

                } else {
                    toastr.info('👋 Duplicate module not created!', 'Duplicate Module', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                }
            });

        });
        //---------------------------------------------------------------------------------------------------------------------------------------------

        //---------------------------------------------------------------------------------------------------------------------------------------------
        // Update sorting for both(form or table)
        $(document).on('click', '#SaveList', function() {

            var sorting_type = $("#basic-list-group").data('type');


            var FileldsData = {
                type: sorting_type, //sort type(sorting for form or table structure)
                data: []
            };


            $("#basic-list-group .list-group-item").each(function(index) {
                var ModuleId = $(this).data('mid');
                var FileldsId = $(this).data('fid');
                var position = index + 1;

                var layoutSize = $(this).find('.layout-size').val(),
                    is_slug = $(this).find('.data_slug').prop("checked") ? '1' : '0';

                FileldsData.data.push({
                    module_id: ModuleId,
                    id: FileldsId,
                    position: position,
                    layout_class: layoutSize,
                    is_slug: is_slug
                });
            });
            var listData = JSON.stringify(FileldsData);

            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('update.module_fields') }}", // Replace with your actual route
                data: listData,
                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#SaveList').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },
                success: function(response) {
                    if (response.status == 200) {
                        // alert(response.message)

                        toastr['success']('👋' + response.message, 'Sorting Update', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        $("#position-model").modal("hide");
                    } else {

                        toastr.info(`👋 Failed to update sorting !`,
                            'Not Updated', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }

                },
                error: function(errors) {
                    console.log(errors);
                    toastr.info(`👋 Failed to update sorting !`,
                        'Not Updated', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                },
                complete: function() {
                    // Re-enable the button after the request completes
                    $('#SaveList').attr('disabled', false).html(
                        '<i data-feather="align-center"></i> Rearrange Order');
                    feather.replace();
                }

            });

        });

        //---------------------------------------------------------------------------------------------------------------------------------------------


        //---------------------------------------------------------------------------------------------------------------------------------------------
        // Fetch Filter Data for Apply Filter
        $(document).on('click', '.filter_btn', function() {

            let module_id = $(this).data("moduleid");
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('show.module_fields') }}", // Replace with your actual route
                data: {
                    "id": module_id
                },
                success: function(response) {
                    if (response.status == 404) {

                        toastr.error(response.message, 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }

                    module_id = response.data.id;
                    $("#moduleId").val(module_id);
                    var fields = response.data.fields;


                    var selectTag = $("#is_filterId");
                    selectTag.html('');
                    selectTag.val(null).trigger('change');

                    fields.forEach(function(field) {
                        var SelectVal = field.is_filter == 1 ? 'selected' : '';

                        if (['single_file', 'multiple_file', 'password', 'text_editor',
                                'textarea'
                            ].includes(field
                                .fields)) {
                            return;
                        }
                        var option = `
                            <option value='${field.id}' ${SelectVal}>${field.title}</option>`;

                        // Append the item to the list
                        selectTag.append(option);
                    });



                    var listGroup = $("#filterData");
                    listGroup.empty();
                    fields.forEach(function(field) {
                        if (field.is_filter == 1) {

                            var listItem = `
                                <li class="list-group-item border" data-mid="${module_id}" data-fid="${field.id}" >
                                    <div class="d-flex" >
                                        <div class="more-info">
                                                    <i class="bi bi-grip-vertical"></i>
                                                    <h5>Title: ${field.title}</h5>
                                                    <span>Field: ${field.fields}</span>
                                        </div>
                                        <div class=" ms-auto ">
                                                    <label class="fw-bold">Filter Type</label>
                                                    <select class="form-select filter_type" aria-label="Default select example">
                                                        <option value='select' ${field.filter_type == 'select' ? 'selected' : ''}>Dropdown</option>
                                                        <option value='radio' ${field.filter_type == 'radio' ? 'selected' : ''}>Radio</option>
                                                        <option value='checkbox' ${field.filter_type == 'checkbox' ? 'selected' : ''}>Checkbox</option>
                                                        <option value='date_range' ${field.filter_type == 'date_range' ? 'selected' : ''}>Date Range</option>
                                                        <option value='time_range' ${field.filter_type == 'time_range' ? 'selected' : ''}>Time Range</option>
                                                        <option value='datetime_range' ${field.filter_type == 'datetime_range' ? 'selected' : ''}>Datetime Range</option>

                                                          </select>
                                        </div>
                                    </div>
                                </li>
                            `;
                            // Append the item to the list
                            listGroup.append(listItem);
                        }
                    });

                    $("#filter-model").modal("show");
                }
            })

        });
        //---------------------------------------------------------------------------------------------------------------------------------------------

        $(document).on('click', '#is_filterBtn', function(e) {

            e.preventDefault();
            var formData = new FormData($('#FilterForm')[0]),
                form = $('#FilterForm');
            $.ajax({
                url: "{{ route('update.filter_feilds') }}", // Replace with your actual route
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#is_filterBtn').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },

                success: function(response) {


                    if (response.status == 200) {
                        // alert(response.message);
                        toastr['success']('👋' + response.message, 'Filter Feilds', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        var fields = response.data;


                        var listGroup = $("#filterData");

                        listGroup.empty();
                        fields.forEach(function(field) {
                            var listItem = `
                              <li class="list-group-item  border" data-mid="${field.module_id}" data-fid="${field.id}" >
                                    <div class="d-flex" >
                                        <div class="more-info">
                                                    <i class="bi bi-grip-vertical"></i>
                                                    <h5>Title: ${field.title}</h5>
                                                    <span>Field: ${field.fields}</span>
                                        </div>
                                        <div class=" ms-auto ">
                                                    <label class="fw-bold">Filter Type</label>
                                                    <select class="form-select filter_type" aria-label="Default select example">
                                                        <option value='select' ${field.filter_type == 'select' ? 'selected' : ''}>Dropdown</option>
                                                        <option value='radio' ${field.filter_type == 'radio' ? 'selected' : ''}>Radio</option>
                                                        <option value='checkbox' ${field.filter_type == 'checkbox' ? 'selected' : ''}>Checkbox</option>
                                                        <option value='date' ${field.filter_type == 'date' ? 'selected' : ''}>Date Range</option>
                                                        <option value='time' ${field.filter_type == 'time' ? 'selected' : ''}>Time Range</option>
                                                        <option value='datetime' ${field.filter_type == 'datetime' ? 'selected' : ''}>Datetime Range</option>
                                                    </select>
                                        </div>
                                    </div>
                                </li>
                            `;

                            // Append the item to the list
                            listGroup.append(listItem);
                        });


                    } else {
                        toastr['error']('👋 Filter fields update failed.!',
                            'Not Update', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }

                },
                error: function(error) {

                    console.log('Error :: ', error?.status, error?.statusText);

                    if (error.status === 422) {
                        var errors = error.responseJSON.errors;
                        for (var key in errors) {
                            if (errors[key]?.length > 0) {

                                var convertedString = key.replace(/\[|\]/g, '');

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ? $(
                                    '[name="' + key + '"]', form)[0] : $('[name="' + key + '[]"]',
                                    form);

                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString + '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g, ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error('👋' + (errors[key][0].replace('_id', '').replace(/_/g,
                                        ' ')),
                                    'Somthing Wrong!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });

                            }
                        }
                    } else {
                        // Handle unexpected errors
                        toastr.error('An unexpected error occurred!', 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        console.error('Error details:', error.responseText);
                    }

                },
                complete: function() {
                    $('#is_filterBtn').attr('disabled', false).html('Apply Filter');
                }
            });
        });


        $(document).on('click', '#SaveFilter', function() {

            var FileldsData = {
                data: []
            };


            $("#filterData .list-group-item").each(function(index) {
                var ModuleId = $(this).data('mid');
                var FileldsId = $(this).data('fid');
                var FilterType = $(this).find('.filter_type').val();

                FileldsData.data.push({
                    module_id: ModuleId,
                    id: FileldsId,
                    filter_type: FilterType
                });
            });
            var listData = JSON.stringify(FileldsData);

            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('update.filter_type') }}", // Replace with your actual route
                data: listData,
                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#SaveFilter').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },
                success: function(response) {
                    if (response.status == 200) {

                        toastr['success']('👋' + response.message, 'Filter Type Update', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        $("#filter-model").modal("hide");
                    } else {

                        toastr.info(`👋 Failed to update filter type!`,
                            'Failed', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }

                },
                error: function(error) {

                    console.log('Error :: ', error?.status, error?.statusText);

                    if (error.status === 422) {
                        var errors = error.responseJSON.errors;
                        console.log(errors);

                        for (var key in errors) {
                            if (errors[key]?.length > 0) {
                                toastr.error('👋' + (errors[key].replace('_id', '').replace(/_/g,
                                        ' ')),
                                    'Somthing Wrong!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });

                            }
                        }
                    } else {
                        // Handle unexpected errors
                        toastr.error('An unexpected error occurred!', 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        console.error('Error details:', error.responseText);
                    }
                },
                complete: function() {
                    // Re-enable the button after the request completes
                    $('#SaveFilter').attr('disabled', false).html('Save Filter');
                }

            });

        });


        $(document).on("change", ".data_slug", function() {
            $(".data_slug").not(this).prop("checked", false); // Uncheck all other checkboxes
        });
    </script>
@endsection
<!-- END: Java Script-->
