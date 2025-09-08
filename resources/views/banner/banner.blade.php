@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')

@endsection
@section('content')

    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($BannerDataFilterData) !!}
        </div>
    </section>

    {{-- Blog Form Modal --}}
    <div class="modal animated show" id="BlogModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Blog Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! createFormHtmlContent($BannerFormData) !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- </section> --}}
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


            $(".link_type").change(function() {
                var this_val = $(this).val();

                $(".product_div, .category_div, .link_div").addClass("d-none");

                if (this_val == "product") {
                    $(".product_div").removeClass("d-none");
                } else if (this_val == "category") {
                    $(".category_div").removeClass("d-none");
                } else if (this_val == "link") {
                    $(".link_div").removeClass("d-none");
                }
            });

        });
    </script>



@endsection
