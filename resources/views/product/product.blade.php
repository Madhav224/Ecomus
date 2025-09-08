@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
    <style>
        .categories_show_img {
            width: 70px;
            height: 70px;
            object-fit: cover;
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
            /* cursor: pointer; */
            z-index: 10;
            transition: 0.3s ease;
            width: 26px;
            height: 25px;
            color: #ffffff;
        }
    </style>
@endsection
@section('content')
    <div class="content-header  row">
        {{-- <div class="content-header-right  text-end  d-flex justify-content-start col-lg-7 col-md-7 col-sm-6 col-12 mb-1">
            @if (!(Auth::user()->hasRole('staff') && !Auth::user()->can('export product')))
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
            @endif
            <!-- /Export Button with Dropdown -->

            @if (!(Auth::user()->hasRole('staff') && !Auth::user()->can('import product')))
                <div class="dropdown ms-1">
                    <button class="btn btn-outline-success waves-effect waves-float waves-light" type="button"
                        id="importButton">
                        <i data-feather="upload"></i> &nbsp;Import Data
                    </button>
                </div>
            @endif

        </div> --}}
        {{-- @if (!(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.products.create')))
            <div class="content-header-right  text-end  d-flex justify-content-end col-lg-5 col-md-5 col-sm-6 col-12">
                <a href="{{ route('productform') }}" class="btn btn-primary mb-1 open-my-model" mymodel="BlogModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    Product</a>
            </div>
        @endif --}}
            
    </div>
    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($ProductDataFilterData) !!}
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
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                })
            }

            $('.select2').select2({
                // dropdownAutoWidth: true,
                minimumResultsForSearch: 0
            });

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });

        });
    </script>
@endsection
