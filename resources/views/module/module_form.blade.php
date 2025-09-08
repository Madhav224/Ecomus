@extends('layouts/contentLayoutMaster')
@section('title', 'Form')

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
<!-- BEGIN: Content-->
@section('content')

    <div class="content-wrapper container-xxl p-0">

        <div class="content-body">
            <section>
                <div class="row">
                    <!-- Invoice repeater -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <form action="#" name="#" class="needs-validation" enctype="multipart/form-data"
                                    id="ModuleForm" novalidate>


                                    <div id="FieldsData">

                                    </div>

                                    <div class="d-flex justify-content-end align-items-end">
                                        <a href="{{ route('show.datatable', ['slug' => $slug]) }}"
                                            class="btn btn-secondary"><i data-feather='arrow-left-circle'></i> Back</a>

                                        <button type="button" class="btn btn-primary ms-1 d-none " name="submit"
                                            id="SaveModule"><i data-feather='save'></i> Save
                                            Changes</button>
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>
                    <!-- /Invoice repeater -->
                </div>
            </section>

        </div>
    </div>
    {{-- </div> --}}
    <!-- END: Content-->
@endsection


<!-- BEGIN: Java Script-->
@section('page-script')
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
        let module_slug = "{{ $slug }}";
        let data_id = "{{ $data_id ?? 0 }}";

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                })
            }
            setModuleForm(module_slug, data_id)
        });



        function setModuleForm(module_slug, data_id) {

            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ route('form.page_form') }}", // Replace with your actual route
                data: {
                    "module_slug": module_slug,
                    "data_id": data_id
                },
                beforeSend: function() {
                    //   Optionally, you can show a loader here
                    $('#FieldsData').html(`<div class="text-center">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`);
                },
                success: function(response) {
                    if (response.status == 404) {
                        alert(response.message);
                    }
                    if (response.status == 200) {
                        // $("#Form_modal").modal("show");
                        // $('.select2').select2('destroy');
                        if (response.status == 404) {
                            $("#FieldsData").html('');
                            alert(response.message);
                        }
                        if (response.status == 200) {
                            $("#FieldsData").html('');
                            $("#FieldsData").html(response.data);
                            $('.select2').select2();
                            $("#SaveModule").removeClass('d-none');

                            $('#ModuleForm').each(function() {
                                const textarea = $(this).find('textarea.quill-editor');
                                if (textarea.length > 0) {
                                    textarea.each(function() {
                                        if (!$(this).siblings('.quill-container').length) {
                                            let quillDiv = $(
                                                '<div class="quill-container mb-2"></div>');
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
                                                $(textar).val(quill.root.innerHTML)
                                                    .trigger('change');
                                            });
                                        }
                                    });
                                }
                            });
                        }


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

                    $('#SaveModule').html(
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

                        location.href = `{{ route('show.datatable', ['slug' => $slug]) }}`;
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

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ? $(
                                    '[name="' + key + '"]', form)[0] : $('[name="' + key + '"]',
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
                    $('#SaveModule').html('<i data-feather="save"></i> Save Changes');
                    feather.replace();
                }

            });


        });

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
