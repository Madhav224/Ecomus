@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/extensions/ext-component-ratings.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/jquery.rateyo.min.css') }}">
@endsection
@section('content')

    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($ReviewDataFilterData) !!}
        </div>
    </section>

    {{-- Product Flag Modal --}}
    <div class="modal animated show" id="ReviewModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Product Review Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Rate (out of 5)</label>
                    <div class="full-star-ratings mb-1 " id="rating-2" data-rateyo-full-star="true"></div>

                    {!! createFormHtmlContent($ReviewFormData) !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
@endsection


@section('vendor-script')
    <script src="{{ asset('js/scripts/extensions/ext-component-ratings.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('vendors/js/extensions/jquery.rateyo.min.js') }}"></script>


    <script>
        function initRateYo() {
            $(".full-star-ratings").each(function() {
                const rating = parseFloat($(this).data("rateyo-rating")) || 0;

                $(this).rateYo({
                    rating: rating,
                    fullStar: true,
                    readOnly: true,
                    starWidth: "20px"
                });
            });
        }

        $(document).on('ajaxComplete datatableLoaded', function() {
            initRateYo();
        });

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


        $("#rating-2").rateYo({
            fullStar: true,
            rating: $("#stars").val() ?? 0,
            onSet: function(rating) {
                $("#stars").val(rating);
            }
        });

        $(document).on('change', '#stars', function() {
            var val = parseFloat($(this).val()) || 0;
            $("#rating-2").rateYo("option", "rating", val);
        });
    </script>
@endsection
