@extends('layouts/contentLayoutMaster')
@section('title', $title)

<!-- BEGIN: Content-->
@section('vendor-style')
    {{-- Button Css --}}
    <style>
        .show_img {
            max-width: 55px !important;
            height: 55px !important;
        }

        .preview_btn {
            position: absolute;
            top: -9px;
            right: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            background-color: #000000;
            padding: 5px;
            cursor: pointer;
            z-index: 10;
            transition: 0.3s ease;
            width: 26px;
            height: 25px;
            color: #ffffff;
        }

        .remove_img_btn {
            position: absolute;
            top: -8px;
            right: -9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            background-color: #fbb7b7;
            padding: 5px;
            cursor: pointer;
            z-index: 10;
            transition: 0.3s ease;
            width: 22px;
            height: 22px;

        }

        .remove_img_btn:hover {
            background-color: #ff9a9a;
            border-color: #999;
        }


        .img_preview_container img {
            height: 140px !important;
            width: 140px !important;
        }

        .container-repeater {
            border: 3px solid #82868b3b !important;
        }

        .remove-container-repeater {
            width: 30px !important;
            height: 30px !important;
            position: absolute;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            top: 2px;
            right: 12px;
            border-radius: 0.357rem;
            background-color: #fff !important;
            opacity: 1;
            transition: all 0.23s ease 0.1s;
            transform: translate(18px, -10px);
            cursor: pointer;
        }



        .remove-container-repeater:hover,
        .remove-container-repeater:focus,
        .remove-container-repeater:active {
            opacity: 1;
            outline: none;
            transform: translate(15px, -2px);
            box-shadow: none;
        }
    </style>
    {{-- Css Button Css --}}

@endsection

@section('content')

    <section class="app-modules-list">
        <div class="content-header  row">
            <div class="content-header-right  text-end  d-flex justify-content-start col-lg-7 col-md-7 col-sm-6 col-12 mb-1">

                @if (
                    $module->export_btn == '1' &&
                        !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.export')))
                    <!-- Export Button with Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-primary waves-effect waves-float waves-light dropdown-toggle"
                            type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i data-feather="download"></i> &nbsp;Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item ExportTypeBtn" href="javascript:void(0)"
                                    data-exporttype="exportAsPdf">Export as PDF</a></li>
                            <li><a class="dropdown-item ExportTypeBtn" href="javascript:void(0)"
                                    data-exporttype="exportAsExcel">Export as Excel</a></li>
                            <li><a class="dropdown-item ExportTypeBtn" href="javascript:void(0)"
                                    data-exporttype="exportAsCsv">Export as CSV</a></li>
                        </ul>
                    </div>
                    <!-- /Export Button with Dropdown -->
                @endif

                @if (
                    $module->import_btn == '1' &&
                        !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.import')))
                        
                    <div class="dropdown ms-1">
                        <button class="btn btn-outline-success waves-effect waves-float waves-light" type="button"
                            id="importButton">
                            <i data-feather="upload"></i> &nbsp;Import Data
                        </button>
                    </div>
                    <!-- End Offcanvas -->
                @endif
            </div>

            @if (
                $module->action_add == '1' &&
                    !(Auth::user()->hasRole('staff') &&
                        !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.create')
                    ))
                <div class="content-header-right  text-end  d-flex justify-content-end col-lg-5 col-md-5 col-sm-6 col-12">
                    @php
                        $isModel = $module->form_type == 'model';
                    @endphp
                    <div class="">
                        <a href="{{ !$isModel ? route('view.module_OnepageForm', [$module->module_slug]) : 'javascript:void(0);' }}"
                            class="btn btn-primary {{ $isModel ? 'Add_btn' : '' }} mb-1 " data-mid="{{ $module->id }}"
                            data-did="0"><i data-feather='plus'></i> Add
                            {{ $module->module_name }}</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="card">
            {!! createDatatableFormFilter($moduleListFormData) !!}
        </div>

    </section>

    @if (
        $module->export_btn == '1' &&
            !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.export')))

        {{-- Start Export Modal --}}
        <!-- Modal for Field Selection -->
        <div class="modal " id="fieldSelectionModal" tabindex="-1" aria-labelledby="fieldSelectionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" style="max-width:500px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fieldSelectionModalLabel">Select Fields to Export</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Dynamically populated checkboxes will appear here -->
                        <input type="hidden" value="" id="exportTypeField">
                        <div class="row" id="fieldsSelection" data-type="pdf"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="exportButton"><i data-feather='download'></i>
                            Export</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Export Modal --}}
    @endif

    @if (
        $module->import_btn == '1' &&
            !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $module->module_slug . '.import')))
        {{-- Start  Import Modal --}}
        <!-- Modal to Show Sample Format -->
        <div class="modal fade" id="importResultModal" tabindex="-1" aria-labelledby="importResultModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:700px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importResultModalLabel">Import Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container import-data p-0 ">
                            <form id="importForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="slug" value="{{ $module?->module_slug }}">
                                <div class="row">
                                    <div class="col-md-5 mb-2 ">
                                        <label for="importFile" class="form-label fw-bolder">Import
                                            Sheet (CSV, XLSX, XLS)<span class="text-danger">*</span></label>

                                        <input type="file" id="importFile" accept=".csv, .xlsx, .xls" name="file"
                                            id="file" class="form-control">
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label for="importImageFile" class="form-label fw-bolder">Import
                                            ZIP Files</label>
                                        <input type="file" id="importImageFile" accept=".zip" name="zip_file"
                                            id="zip_file" class="form-control">
                                    </div>

                                    <div class="col-md-2 mb-2 pt-2">
                                        <button type="submit" name="upload" id="upload"
                                            class="btn btn-primary form-control"> <i data-feather="upload"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="accordion accordion-margin mb-0" id="accordionMargin">
                                <div class=" card">
                                    <h2 class="accordion-header " id="headingMarginTwo">
                                        <button class="accordion-button collapsed text-danger rounded" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#accordionMarginTwo"
                                            aria-expanded="false" aria-controls="accordionMarginTwo">
                                            Note:
                                        </button>
                                    </h2>
                                    <div id="accordionMarginTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingMarginTwo" data-bs-parent="#accordionMargin">
                                        <div class="accordion-body">
                                            <ul style="fs-6 lh-1">
                                                <li><small> column names in your sheet exactly match the system field
                                                        names and
                                                        follow the same order.</small></li>
                                                <li><small>Upload images as a ZIP file, with image names inside matching
                                                        those in the
                                                        sheet.</small></li>
                                                <li><small>Click the download button to get a sample file for the
                                                        correct column
                                                        fields.</small></li>
                                                <li><small>Fields Name marked with (*) are required.</small></li>
                                                <li><small>If a required field is empty, the row will be skipped.</small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" id="downloadSampleBtn" class="float-end my-1">Download
                            Sample</a>
                        <div class="fields-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Field Name</th>
                                        <th>Title</th>
                                    </tr>
                                </thead>
                                <tbody id="fieldsContainer">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Import Modal --}}
    @endif

    {{-- Start Module Form Modal --}}

    <div class="modal " id="Form_modal" tabindex="-1" aria-labelledby="view-model" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view-model-label">{{ $module->module_name }} Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" name="#" id="ModuleForm">
                    <div class="modal-body" id="FormHtml">

                    </div>
                    <div class="modal-footer" id="position-model-footer">
                        <button type="button" class="btn btn-secondary" class="close-modal" data-bs-dismiss="modal"><i
                                data-feather='x-circle'></i> Close</button>
                        <button type="button" class="btn btn-primary" id="SaveModule"><i data-feather='save'></i> Save
                            Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Module Form Modal --}}


    {{-- Start Image Preview Modal --}}
    <div class="img_preview_container d-none">

    </div>
    {{-- End Image Preview Modal --}}

    {{-- Start View Modal --}}
    <div class="modal " id="ViewModal" tabindex="-1" aria-labelledby="view-model" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $module->module_name }} Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <table class="table ">

                    <tbody id="record_detail">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- End View Modal --}}
    <!-- END: Content-->
@endsection

<!-- BEGIN: Java Script-->
@section('page-script')
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                })
            }
            setModuleForm({{ $module->id }}, 0, 'this_btn')

        });


        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });
    </script>

    <script>
        $(document).on('click', '.Add_btn,.table_edit_data', function() {
            let modal = $("#Form_modal");
            var id = $(this).data('did');

            modal.find('form').trigger('reset')
                .find('input, textarea, select')
                .not(':checkbox, :radio, [name="table_name"]')
                .val(null)
                .trigger('change');
            modal.find('[type="checkbox"], [type="radio"]').prop("checked", false);
            modal.find('.module_file_preview, .ql-editor, form .invalid-feedback, [class$="-error"]').html('');
            modal.find('input').removeClass('error');
            modal.find('.module_file_preview').remove();
            modal.find('.repeater-container').each(function() {
                $(this).find('.repeater-input').not(':first').remove();
            });
            modal.find('.fields-repeater-container').each(function() {
                $(this).find('.container-repeater').not(':first').remove();
            });

            if ($(this).hasClass('table_edit_data')) {
                setModuleForm({{ $module->id }}, id, 'this_btn');
            }
            modal.modal("show");
        });

        $(document).on('click', '.view_btn', function() {
            var this_btn = $(this),
                module_id = $(this_btn).data('mid'),
                data_id = $(this_btn).data('did');

            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ route('view.details') }}", // Replace with your actual route
                data: {
                    "module_id": module_id,
                    "id": data_id,
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#record_detail").empty("");

                        var data = response.data;
                        data.forEach(function(item) {
                            var tr = `<tr>
                                <td class="text-primary">${item.title}:</td>
                                <td>${item.value}</td>
                                </tr>`;

                            // Append the item to the list
                            $("#record_detail").append(tr);
                        });
                        $("#ViewModal").modal('show');
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
        });


        // For Image Preview(Multiple Image)
        $(document).on('click', '.preview_btn', function() {
            var id = $(this).data('id'),
                tablename = $(this).data('tablename'),
                column_name = $(this).data('columnname');


            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('modules.img_preview') }}",
                data: {
                    id: id,
                    tablename: tablename,
                    column_name: column_name,
                },

                success: function(response) {
                    if (response.status == 200) {
                        var images_data = response.data;
                        preview_container = $(".img_preview_container ");
                        preview_container.html('');


                        images_data.forEach((img, index) => {
                            if (index != 0) {

                                var image =
                                    `
                            <a href="${img.url}" data-lightbox="${column_name+id}" data-title="${column_name} preview" >
                                <img src="${img.url}" alt="${img.img_name}" class="img-thumbnail ms-1 "
                                /></a>`;
                                preview_container.append(image);
                            }
                        });

                        firstAnchor = preview_container.find('a').first();
                        if (firstAnchor.length) {
                            firstAnchor.trigger("click");
                        }


                    } else {
                        toastr.info(`👋 ` + response.message,
                            'Images Not Found', {
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

        });


        // Set Module Form and also set edit data Of Module
        function setModuleForm(module_id, id, this_btn) {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('form.modal_form') }}", // Replace with your actual route
                data: {
                    "module_id": module_id,
                    "id": id,
                },
                beforeSend: function() {
                    // this_btn.prop('disabled', true);
                },
                success: function(response) {
                    if (response.status == 404) {
                        alert(response.message);
                    }
                    if (response.status == 200) {
                        // $("#Form_modal").modal("show");
                        // $('.select2').select2('destroy');
                        $("#FormHtml").html(response.data);
                        $('.select2').select2();

                        $('#ModuleForm').each(function() {
                            const textarea = $(this).find('textarea.quill-editor');
                            if (textarea.length > 0) {
                                textarea.each(function() {
                                    if (!$(this).siblings('.quill-container')
                                        .length) {
                                        let quillDiv = $(
                                            '<div class="quill-container mb-2"></div>'
                                        );
                                        $(quillDiv).html($(this).val());

                                        $(this).before(quillDiv);
                                        $(this).hide();
                                        var textar = $(this);

                                        let quill = new Quill(quillDiv[0], {
                                            // theme: 'snow',
                                            // bounds: '.full-quill-editor',
                                            modules: {
                                                formula: true,
                                                syntax: true,
                                                toolbar: [
                                                    [{
                                                            font: []
                                                        },
                                                        {
                                                            size: []
                                                        }
                                                    ],
                                                    ['bold', 'italic',
                                                        'underline',
                                                        'strike'
                                                    ],
                                                    [{
                                                            color: []
                                                        },
                                                        {
                                                            background: []
                                                        }
                                                    ],
                                                    [{
                                                            script: 'super'
                                                        },
                                                        {
                                                            script: 'sub'
                                                        }
                                                    ],
                                                    [{
                                                            header: '1'
                                                        },
                                                        {
                                                            header: '2'
                                                        },
                                                        'blockquote',
                                                        'code-block'
                                                    ],
                                                    [{
                                                            list: 'ordered'
                                                        },
                                                        {
                                                            list: 'bullet'
                                                        },
                                                        {
                                                            indent: '-1'
                                                        },
                                                        {
                                                            indent: '+1'
                                                        }
                                                    ],
                                                    [
                                                        'direction',
                                                        {
                                                            align: []
                                                        }
                                                    ],
                                                    ['link', 'formula'],
                                                    ['clean']
                                                ]
                                            },
                                            theme: 'snow'
                                        });

                                        quill.on('text-change', function() {
                                            $(textar).val(quill.root
                                                .innerHTML).trigger(
                                                'change');
                                        });
                                    }
                                });
                            }
                        });

                        if (feather) {
                            feather.replace({
                                width: 14,
                                height: 14
                            });
                        }
                    }
                },
                complete: function() {
                    // this_btn.prop('disabled', false);
                }
            })
        }

        // Store Module Date
        $('#SaveModule').on('click', function(e) {
            e.preventDefault();

            var formData = new FormData($('#ModuleForm')[0]);
            var form = $('#ModuleForm')[0];

            $.ajax({
                url: "{{ route('store_module') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#SaveModule').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },
                success: function(response) {
                    if (response.status == 200) {
                        toastr['success'](
                            '👋 ' + response.message,
                            'Record Store', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        location.reload();
                    } else {
                        toastr.info(`👋 ` + response.message,
                            'Failed to store', {
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

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ?
                                    $(
                                        '[name="' + key + '"]', form)[0] : $('[name="' +
                                        key + '"]',
                                        form);
                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[
                                            key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString +
                                        '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g,
                                            ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error('👋' + (errors[key][0].replace('_id', '')
                                        .replace(/_/g,
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
                    $('#SaveModule').attr('disabled', false).html(
                        '<i data-feather="save"></i> Save Changes');
                    feather.replace();
                }

            });


        });

        // Remove Error of Form
        $(document).on('keyup change', 'input,select,date,textarea', function(event) {
            // Get the name attribute of the fieldElement
            var inputValue = $(this).attr('name');

            if (inputValue == undefined)
                return;
            // Remove the 'error' class from elements with the specified name
            $('[name="' + inputValue + '"]').removeClass('error');

            // Reset the content of elements with the specified class
            var inputValue = inputValue.replace(/\[|\]/g, '');
            $('.' + inputValue + '-error').html('');
        });


        // Remove Image from Image Container
        $(document).on('click', '.remove_img_btn', function() {
            var id = $(this).data('id');
            var img = $(this).data('img');
            var tablename = $(this).data('tablename');
            var field_name = $(this).data('field');
            var remove_btn = $(this);


            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('destory_image') }}",
                data: {
                    id: id,
                    tablename: tablename,
                    img_name: img,
                    field_name: field_name
                },

                success: function(response) {
                    if (response.status == 200) {
                        $(remove_btn).closest('.image-container').remove();

                        toastr['success'](
                            '👋 ' + response.message,
                            'Image deleted', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    } else {
                        toastr.info(`👋 ` + response.message,
                            'Image Deletion Failed', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        // alert(response.message);
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
        });


        // Export Data Script Start
        // Show Fields In Modal
        $(document).on('click', '.ExportTypeBtn', function() {
            var export_type = $(this).data('exporttype');
            const exportMap = {
                exportAsPdf: 'pdf',
                exportAsExcel: 'excel',
                exportAsCsv: 'csv'
            };
            export_type = exportMap[export_type] || export_type;
            let module_id = "{{ encrypt_to($module->id) }}";

            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('show.module_fields') }}",
                data: {
                    "id": module_id
                },
                success: function(response) {
                    if (response.status == 200) {
                        var fields = response.data.fields;
                        var listGroup = $("#fieldsSelection");
                        listGroup.attr('data-type', '');
                        listGroup.attr('data-type', export_type);
                        $("#exportTypeField").val(export_type);

                        var is_slug = false;



                        listGroup.empty();
                        fields.forEach(function(field) {
                            if (field.is_slug == 1) is_slug = true;

                            var listItem = `
                                        <div class="col-6 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" value="${field.name}" id="${field.name}" checked>
                                                <label class="form-check-label" for="${field.name}">${field.title}</label>
                                            </div>
                                        </div>`;

                            // Append the item to the list
                            listGroup.append(listItem);
                        });

                        var DefaultItem = ``;
                        if (is_slug) {
                            DefaultItem = `
                        <div class="col-6 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" value="slug" id="slug" checked>
                                                <label class="form-check-label" for="slug">Slug</label>
                                            </div>
                                        </div>`;
                        }
                        DefaultItem += `
                                    <div class="col-6 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" value="status" id="status" checked>
                                                <label class="form-check-label" for="status">Status</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" value="created_at" id="created_at" checked>
                                                <label class="form-check-label" for="created_at">Created Date</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" value="updated_at" id="updated_at" checked>
                                                <label class="form-check-label" for="updated_at">Updated Date</label>
                                            </div>
                                        </div>`;

                        listGroup.append(DefaultItem);

                        $("#fieldSelectionModal").modal("show");
                    } else {
                        toastr.error(response.message, 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                }
            });
        });

        // Export Data
        $(document).on('click', '#exportButton', function() {
            var fieldsSelection = $("#fieldsSelection"),
                export_type = $("#exportTypeField").val(),
                module_slug = "{{ $module->module_slug }}",
                module_name = "{{ $module->module_name }}",
                fields = [];

            const exportMap = {
                pdf: 'pdf',
                excel: 'xlsx',
                csv: 'csv'
            };
            var export_extension = exportMap[export_type] || export_type;

            fields = fieldsSelection.find("input[name='fields[]']:checked").map(function() {
                return $(this).val(); // Collect values of checked inputs
            }).get();

            $.ajax({
                type: "get",
                // dataType: "json",
                url: "{{ route('export.module_data') }}", // Replace with your actual route
                data: {
                    "slug": module_slug,
                    "fields": fields,
                    "export_type": export_type
                },
                xhrFields: {
                    responseType: 'blob' // Important for file download
                },
                beforeSend: function() {
                    $("#exportButton").prop("disabled", true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    ); // Disable button & show loading state
                },
                success: function(response, status, xhr) {
                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');

                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        var matches = /filename="([^"]*)"/.exec(disposition);
                        if (matches !== null && matches[1]) filename = matches[1];
                    }

                    // If filename not found, generate default
                    if (!filename) {
                        filename = module_name + '_' + "export_" + new Date().toISOString().slice(0, 19)
                            .replace(/[:T]/g,
                                "-") + "." + export_extension;
                    }

                    var blob = new Blob([response], {
                        type: xhr.getResponseHeader('Content-Type')
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    toastr.success("File downloaded successfully!", "Success", {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    $("#fieldSelectionModal").modal("hide");
                },
                error: function(error) {
                    console.log('Error :: ', error?.status, error?.statusText);
                    if (error.status === 422) {
                        var errors = error.responseJSON.errors;
                        for (var key in errors) {
                            if (errors[key]?.length > 0) {

                                var convertedString = key.replace(/\[|\]/g, '');

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ?
                                    $(
                                        '[name="' + key + '"]', form)[0] : $('[name="' +
                                        key + '"]',
                                        form);
                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[
                                            key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString +
                                        '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g,
                                            ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error('👋' + (errors[key][0].replace('_id', '')
                                        .replace(/_/g,
                                            ' ')),
                                    'Somthing Wrong!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });

                            }
                        }
                    } else if (error.status === 404) {
                        toastr.error('No data found.', 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
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
                    $("#exportButton").prop("disabled", false).html(
                        '<i data-feather="download"></i> Export'); // Re-enable button
                    feather.replace();
                }
            });
        });
        // Export Data Script End

        let module_fields = null;
        // Start Import Data Script..
        $(document).on('click', '#importButton', function() {
            let module_id = "{{ encrypt_to($module->id) }}";
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('show.module_fields') }}",
                data: {
                    "id": module_id
                },
                success: function(response) {
                    if (response.status == 200) {
                        var fields = response.data.fields;

                        module_fields = fields;
                        var listGroup = $("#fieldsContainer");
                        listGroup.empty();
                        fields.forEach(function(field) {
                            var required = field.required == "1" ?
                                '<span class="text-danger">*</span>' : '';
                            var listItem = `
                                        <tr>
                                            <td><b>${field.name}${required}</b></td>
                                            <td>${field.title}</td>
                                        </tr>`;

                            // Append the item to the list
                            listGroup.append(listItem);
                        });
                        $("#importForm").trigger('reset');
                        $("#importResultModal").modal("show");

                    } else {
                        toastr.error(response.message, 'Error', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                }
            });
        });


        // Sample CSV  File
        $('#downloadSampleBtn').click(() => {
            const data = module_fields.map(field => field.name).join(',');
            const blob = new Blob([data], {
                type: 'text/csv'
            });
            const link = $('<a>', {
                href: URL.createObjectURL(blob),
                download: '{{ $module->module_name }}_sample_data.csv',
                css: {
                    'font-size': '12px',
                    'background-color': 'gray',
                    'color': 'white',
                }
            }).appendTo('body');
            link[0].click();
            URL.revokeObjectURL(link[0].href);
            link.remove();
        });

        // Import Data
        $(document).on('click', '#upload', function(event) {


            event.preventDefault();
            var formData = new FormData($('#importForm')[0]),
                form = $('#importForm')[0],
                this_btn = $(this);
            $.ajax({
                url: "{{ route('import.module_data') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#upload").prop("disabled", true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"></span>'
                    ); // Disable button & show loading state
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status == 200) {
                        toastr.success(response.message, 'Import Data', {
                            closeButton: true,
                            tapToDismiss: false
                        });

                        if (response.skiprow && response.skiprow.length > 0) {
                            var msg = response.skiprow,
                                skipmsg = "<ul>";


                            msg.forEach(function(msg) {
                                skipmsg += `<li>${msg}</li>`;
                            });
                            skipmsg += "</ul>";
                            Swal.fire({
                                title: 'Some Rows Were Skipped',
                                html: skipmsg,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Understood',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                    cancelButton: 'btn btn-outline-danger d-none'
                                },
                                buttonsStyling: false

                            });
                        }
                        $("#importResultModal").modal("hide");
                        reloadDataTable(this_btn);
                    } else {
                        toastr.error(response.message, 'Error', {
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

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ?
                                    $(
                                        '[name="' + key + '"]', form)[0] : $('[name="' +
                                        key + '"]',
                                        form);
                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[
                                            key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString +
                                        '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g,
                                            ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error((errors[key][0].replace('_id', '').replace(
                                        /_/g, ' ')) +
                                    '👋',
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
                    $("#upload").prop("disabled", false).html(
                        '<i data-feather="upload"></i>');
                    feather.replace();
                }
            });
        });
        // End Import Data Script..



        // Add Repeater Query
        $(document).on('click', '.add-repeater', function() {
            var this_btn = $(this),
                parent_div = $(this_btn).closest('.repeater-container .row'),
                repeater_input = $(this_btn).closest('.repeater-input').clone();


            $(repeater_input).find('input').val('');
            $(repeater_input).find('.input-group span').html('').append('<i data-feather="x"></i>');
            $(repeater_input).find('.input-group span').removeClass('add-repeater').addClass('remove-repeater');
            $(parent_div).append(repeater_input);
            feather.replace();
        });
        // End

        // Remove Repeater Query
        $(document).on('click', '.remove-repeater', function() {
            var repeater_input = $(this).closest('.repeater-input');

            repeater_input.remove();
        });
        // ENd


        $(document).on("click", "[class*='AddContainer-']", function(e) {
            e.preventDefault();
            var this_btn = $(this);

            var parent_div = $($(this_btn).parent('div').prev('.fields-repeater-container')),
                newIndex = parent_div.find('.container-repeater').length,
                repeater_input = parent_div.find('.container-repeater').first().clone();

            repeater_input.find("input, textarea, select").val("").removeAttr("checked selected").each(function() {
                let name = $(this).attr("name");
                if (name) {
                    $(this).attr("name", name.replace(/\[\d+](.*)/, "[" + newIndex +
                        "]$1")); // Updates index while keeping suffix
                }
            });
            repeater_input.append(
                    "<span class='remove-container-repeater bg-light-danger text-light border border-danger'><i data-feather='x'></i></span>"
                )
                .appendTo(parent_div).fadeIn();

            feather.replace();
        });

        $(document).on("click", ".remove-container-repeater", function(e) {
            e.preventDefault();
            $(this).closest('.container-repeater').fadeOut(300, function() {
                $(this).remove();
            });
        });
    </script>
@endsection
<!-- END: Java Script-->
