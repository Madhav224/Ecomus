@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
    <!-- Page css files -->
    <!-- Add Font Awesome CDN link -->

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/ui/jquery-ui.css') }}">

    <style>
        /* Summery Boxes Actions Buttons Css Start  */

        .summeybox_status {
            margin-left: 4px;
            margin-top: 4px;
        }

        .summeybox_status input {
            width: 22px !important;
            height: 14px !important;
        }

        .summeybox_editbtn {
            width: 16px !important;
            height: 16px !important;
            margin-right: 2px;
            margin-top: 4px;
            padding-bottom: 3px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            cursor: pointer;
            z-index: 100;
        }

        .summeybox_editbtn .feather,
        [data-feather] {
            height: 0.6rem !important;
            width: 0.6rem !important;
        }

        .summeybox_delbtn {
            width: 16px !important;
            height: 16px !important;
            margin-right: 4px;
            margin-top: 4px;
            padding-bottom: 3px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            cursor: pointer;
            z-index: 100;
        }

        .summeybox_delbtn .feather,
        [data-feather] {
            height: 0.7rem !important;
            width: 0.7rem !important;
        }

        .summery_boxes .feather,
        [data-feather] {
            height: 1.5rem;
            width: 2rem;
            display: inline-block;
        }
    </style>


@endsection

@section('content')

    <div class="modal animated show" id="summaryboxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Summary boxes</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! createFormHtmlContent($summaryFormData) !!}

                    <hr>
                    <div class="row " id="card-drag-area">
                        @foreach ($summeybox as $key => $value)
                            <div class="col-lg-4 col-sm-6 col-12 draggable" data-id="{{ $value['id'] }}">
                                <div class="card border-bottom-3 border-bottom-{{ $value['box_theme'] }}  summery_boxes">
                                    <div class="card-header p-0 bg-light-{{ $value['box_theme'] }} ">
                                        <div class="">
                                            <div class="form-check form-switch  summeybox_status">
                                                <input class="form-check-input change_status" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked"
                                                    {{ $value['status'] == 'active' ? 'checked' : '' }}
                                                    statusto="{{ encrypt_to('summary_boxes') . '/' . encrypt_to($value['id']) . '/' . encrypt_to('status') }}">
                                            </div>
                                        </div>
                                        <div class="d-flex" style="padding-bottom: 3px;">
                                            <a href="javascript:void(0);"
                                                class=" bg-light-primary border border-primary summeybox_editbtn openmodal-summaryboxModel "
                                                recordof="{{ encrypt_to('summary_boxes') . '/' . encrypt_to($value['id']) }}">
                                                <span class="avatar-content">
                                                    <i data-feather='edit' class="avatar-icon"></i>
                                                </span>
                                            </a>
                                            <a href="javascript:void(0);"
                                                class="bg-light-danger  border border-danger delete_record summeybox_delbtn"
                                                deleteto="{{ encrypt_to('summary_boxes') }}'/' {{ encrypt_to($value['id']) }}">

                                                <span class="avatar-content">
                                                    <i data-feather='x' class=""></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-row justify-content-between my-auto">
                                        <div class="avatar bg-light-{{ $value['box_theme'] }} p-50 m-0 my-1">
                                            <div class="avatar-content">
                                                <i data-feather="{{ $value['box_icon'] }}"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h2 class="fw-bolder mt-1 text-end">{{ $value['box_val'] }}</h2>
                                            <p class="card-text mb-0 text-end">{{ $value['box_title'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="module-list-dropdown" class="module-dropdown-menu" style="display: none;">
        <div class="module-list-card card border">
            <div class="card-body p-1">
                <div class="input-group">
                    <input type="text" id="module-search" class="form-control" placeholder="Search Modules..." />
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <form id="module-order" name="module-order" method="POST" action="{{ route('module.save-order') }}">
                    @csrf
                    <ul class="module-list my-1" id="draggable-container">
                        @foreach ($moduleListFormData['Data'] as $item)
                            <li class="module-list-item border-2 border-bottom" id="module-{{ $item['module']->id }}"
                                data-id="{{ $item['module']->id }}">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div>

                                        <span class="drag-handle">
                                            <i class="fas fa-grip-horizontal"></i>
                                        </span>
                                        <span
                                            class="module-name fs-5 fw-bolder text-dark">{{ $item['module']->module_name }}</span>
                                    </div>


                                    <div class="switch ms-2 form-check form-check-success form-switch">
                                        <input type="checkbox" class="toggle-status form-check-input"
                                            data-id="{{ $item['module']->id }}"
                                            {{ $item['status'] == '1' ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <input type="hidden" name="order" id="order" />
                        <input type="hidden" name="statuses" id="statuses" />
                    </ul>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm  btn-primary">Save Order</button>&nbsp;
                        <button type="button" id="cancel" class="btn btn-sm  btn-outline-danger ">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <section class="app-dashboard-list">
        <div class="row">
            @foreach ($summeybox as $key => $value)
                @if ($value['status'] == 'active')
                    <div class="col-lg-3 col-sm-6 col-12 mb-0">
                        <div class="card border-bottom-3 border-bottom-{{ $value['box_theme'] }} summery_boxes">
                            <div class="card-body d-flex flex-row justify-content-between my-auto p-1">
                                <div class="avatar bg-light-{{ $value['box_theme'] }} p-50 m-0 my-1">
                                    <div class="avatar-content">
                                        <i data-feather="{{ $value['box_icon'] }}"></i>
                                    </div>
                                </div>
                                <div class="my-auto">
                                    <h2 class="fw-bolder mt-1 text-end">{{ $value['box_val'] }}</h2>
                                    <p class="card-text  mb-0 text-end">{{ ucfirst($value['box_title']) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        <div class="row g-3 pt-3" id="sortable-table">
            @foreach ($moduleListFormData as $formData)
                @if (isset($formData['status']) && $formData['status'] == 1)
                    <div class="{{ $formData['box_size'] }}  dashboard_module m-0 px-1"
                        data-id="{{ $formData['module_id'] }}">
                        <div class="card resizable-card ">
                            <div class="card-body p-0">
                                @if (isset($formData['name']))
                                    <div class="table-module">
                                        <div class="container-module border-2 border-bottom mx-1 pt-1">
                                            <span class="drag-handle">
                                                <i class="fas fa-grip-vertical module-table-item"
                                                    id="module-{{ $formData['module_id'] }}"
                                                    data-id="{{ $formData['module_id'] }}"></i>
                                            </span>
                                            <h5 class="module-title " style="font-style:oblique;">
                                                <a href="{{ route('show.datatable', ['slug' => $formData['module_slug']]) }}"
                                                    class="fw-bolder ">
                                                    {{ $formData['module_name'] }}

                                                </a>
                                            </h5>
                                            {{-- <div class="ui-resizable-handle"></div> --}}
                                        </div>

                                        {!! createDatatableFormFilter($formData) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset('vendors/js/ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    {{--
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script> --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>

    <script>
        $(document).on('click', '#summarybox', function() {
            $("#summarybox_form #id").val('');
            $('#summaryboxModel').modal('show');
        });


        $(document).on('change', '#table_name', function() {
            var tablename = $(this).val();
            let column_select = $('#column_name'),
                column_val = $(column_select).attr('selected-value');

            if (tablename == "") {

                column_select.html('');
                return false
            }

            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ route('get.tables_columns') }}",
                data: {
                    'type': 'columns',
                    'table_name': tablename
                },
                success: function(data) {
                    if (data.status == 200) {
                        if (typeof data === 'object' && data !== null) {
                            // Loop through the object keys and values
                            sel_data = data.data;

                            var opt = $('<option></option>').attr('value',
                                '').text(
                                'select');

                            $(column_select).html(opt);
                            Object.keys(sel_data).forEach(function(key) {
                                var value = sel_data[key];
                                var option = $('<option></option>').attr('value',
                                    value).text(
                                    value);
                                // Append the option to the select element
                                $(column_select).append(option);
                            });

                            if (column_val) {
                                $(column_select).val(column_val);
                            }

                        } else {

                            $(column_select).append(
                                '<option>No options available</option>');
                        }
                    }
                },
                error: function(error) {
                    console.log(error.responseText);
                    toastr.info(`👋 Columns not found!`,
                        'Not Found', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }
            });
        });

        var icons = Object.keys(feather.icons);
        box_icon = $('#box_icon');

        if (icons.length) {
            icons.map(function(icon) {
                if (box_icon.length) {
                    box_icon.append(
                        '<option value="' + icon + '" data-icon="' + icon + '">' +
                        icon +
                        '</option>'
                    );
                }
            });
            $(box_icon).trigger('change');
        }


        $('#box_icon').each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                minimumResultsForSearch: 1,
                dropdownParent: $this.parent(),
                templateResult: iconFormat,
                templateSelection: iconFormat,
                escapeMarkup: function(es) {
                    return es;
                }
            });
        });

        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) {
                return icon.text;
            }
            var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + icon.text;
            return $icon;
        }
        $('.draggable').draggable({
            revert: true, // Revert the position if not dropped in the correct area
            cursor: 'move', // Change cursor to move when dragging
            // helper: "clone",
        });

        $('#card-drag-area').droppable({
            drop: function(event, ui) {
                var BoxessData = [];

                $("#card-drag-area .draggable").each(function(index) {
                    var Id = $(this).data('id');
                    var position = index + 1;
                    BoxessData.push({
                        id: Id,
                        position: position,
                    });
                });
                var BoxesData = JSON.stringify(BoxessData);

                $.ajax({
                    url: "{{ route('boxes.sorting') }}",
                    method: 'POST',
                    data: BoxesData,
                    success: function(response) {
                        if (response.status == 200) {

                            toastr.success(
                                response.message, 'Boxes Order', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                        } else {
                            toastr.info(
                                response.message, 'Boxes Order', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.info(`👋 Failed to update order !`,
                            'Not Updated', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }
                });
            }
        });
    </script>
    <script>
        $('#module-list-toggle, #cancel').on('click', function() {
            $('#module-list-dropdown').toggle();
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('#module-list-dropdown').hide();
            }
        });
        $('#module-search').on('keyup', function() {
            var searchValue = $(this).val().toLowerCase();
            $('#draggable-container .no-match').remove();
            var $modules = $('#draggable-container .module-list-item').hide().filter(function() {
                return $(this).find('.module-name').text().toLowerCase().includes(searchValue);
            }).show();

            if (!$modules.length) {
                $('#draggable-container').append(
                    '<li class="no-match text-danger text-center">No module found</li>');
            }
        });

        // Make the modules draggable within the container
        $('#draggable-container').sortable({
            items: '.module-list-item',
            placeholder: 'sortable-placeholder',
            update: function(event, ui) {

            }
        });
        $('#draggable-container').disableSelection();

        $('#sortable-table').sortable({
            items: '.dashboard_module',
            handle: '.drag-handle',
            placeholder: 'sortable-placeholder',
            update: function(event, ui) {
                var order = [];
                $('#sortable-table .table-module').each(function(index) {
                    var moduleId = $(this).find('.module-table-item').data('id');

                    if (moduleId !== undefined) {
                        order.push(moduleId);
                    }
                });
                $.ajax({
                    url: "{{ route('module.save-order') }}",
                    method: 'POST',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // console.log(response);
                        toastr.success(
                            response.message, 'Module Resize', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                    },
                    error: function() {
                        toastr.error('Error saving order.',
                            'Error', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }
                });
            }
        });

        $('#sortable-table').disableSelection();
        $('.toggle-status').on('change', function() {
            var checkbox = $(this);
            var moduleId = checkbox.data('id');
            var status = checkbox.is(':checked') ? '1' : '0';
            checkbox.data('status', status);

        });

        $('#module-order').on('submit', function(event) {
            event.preventDefault();

            var order = [];
            var statuses = {};


            $('#draggable-container .module-list-item').each(function(index) {
                order.push($(this).data('id'));
            });


            $('.toggle-status').each(function() {
                var moduleId = $(this).data('id');
                var status = $(this).is(':checked') ? '1' : '0';
                statuses[moduleId] = status;
            });


            $('#order').val(JSON.stringify(order));
            $('#statuses').val(JSON.stringify(statuses));

            this.submit();
        });



        $(document).ready(function() {
            let resizeTimeout;
            $(".resizable-card").resizable({
                handles: "e", // Enables resizing from the right side
                start: function() {
                    $(this).addClass("resizing"); // Add smooth effect class
                },
                resize: function(event, ui) {
                    let $module = $(this).closest(".dashboard_module");
                    let width = ui.size.width;

                    // Column size based on width
                    let newColClass = width >= 1000 ? "col-md-12" :
                        width >= 800 ? "col-md-10" :
                        width >= 600 ? "col-md-8" :
                        width >= 400 ? "col-md-6" :
                        width >= 200 ? "col-md-4" : "col-md-2";

                    // Apply new column class if it changes
                    if (!$module.hasClass(newColClass)) {
                        $module.removeClass("col-md-2 col-md-4 col-md-6 col-md-8 col-md-10 col-md-12")
                            .addClass(newColClass);

                        // Debounce Ajax request
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(function() {
                            $.ajax({
                                url: "{{ route('update.columnsize') }}", // Add your URL here
                                method: "POST",
                                data: {
                                    moduleid: $module.data(
                                        "id"
                                    ), // Assuming you have a data attribute with module id
                                    columnsize: newColClass,
                                    _token: $('meta[name="csrf-token"]').attr(
                                        'content') // CSRF token
                                },
                                success: function(response) {

                                    if (response.status != 200) {

                                        toastr['error'](
                                            response.message, 'Module Resize', {
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                },
                                error: function() {
                                    toastr.error('An unexpected error occurred!',
                                        'Error', {
                                            closeButton: true,
                                            tapToDismiss: false
                                        });
                                }
                            });
                        }, 150); // Debounced Ajax request
                    }
                },
                stop: function() {
                    $(this).removeClass("resizing"); // Remove effect class
                    $(this).css({
                        width: "",
                        height: ""
                    }); // Reset inline styles
                }
            });
        });
    </script>
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

        .container-module {
            display: flex;
            justify-content: space-between;
            padding: 3px;
        }

        .module-list-card {
            /* max-width: 360px; */
            max-width: 23%;
            width: 100%;
            position: absolute;
            right: 28px;
            top: 138px;
            z-index: 10;
        }

        .drag-handle {
            cursor: move;
            font-size: 18px;
            /* margin-right: 15px; */
        }

        .module-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            max-height: 252px;
            overflow: scroll;
            /* overflow-y: auto;
            overflow-x: auto; */
            overflow: auto;
            white-space: nowrap;
        }

        .module-list::-webkit-scrollbar {
            width: 6px;
            height: 6px;
            /* Width of the scrollbar */
        }

        .module-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            /* Track color */
            border-radius: 4px;
        }

        .module-list::-webkit-scrollbar-thumb {
            background: #888;
            /* Scrollbar color */
            border-radius: 4px;
        }

        .module-list::-webkit-scrollbar-thumb:hover {
            background: #555;
            /* Scrollbar color on hover */
        }


        .module-list-item {
            padding: 7px;
            margin: 8px 0;
            cursor: pointer;
        }

        .module-list-item:hover {
            background-color: #cbcbcb29;
        }

        .resizable-card {
            min-width: 100px;
            max-width: 100%;
            position: relative;
            transition: width 0.2s ease-out;
        }

        .resizable-card::after {
            content: "";
            position: absolute;
            top: 0;
            height: 100%;
            width: 8px;
            cursor: ew-resize;
        }

        .resizable-card::after {
            right: 0;
        }
    </style>
@endsection
