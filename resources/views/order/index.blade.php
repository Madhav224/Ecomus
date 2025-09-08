@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
@endsection
@section('content')

    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($OrderDataFilterData) !!}
        </div>
    </section>

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
        });

        $(document).ready(function() {
            $(document).on('change', '.order_status', function() {
                const order_status = $(this).val();
                var this_btn = $(this),
                    // order_status = $(this_btn).val(),
                    orderid = $(this_btn).data('orderid'),
                    form = $(this_btn).closest('form'),
                    oldstatus = $(this_btn).data('oldstatus');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('order.status') }}", // Replace with your actual route
                    data: {
                        "order_id": orderid,
                        "order_status": order_status,
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            toastr['success'](
                                '👋 ' + response.message,
                                'Order Status', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                                reloadDataTable(this_btn);
                        } else {
                            $(this_btn).val(oldstatus);
                            toastr.info(`👋 ` + response.message,
                                'Order Status', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });

                        }
                    },
                    error: function(error) {
                        if (error.status === 422) {
                            // Handle validation errors
                            var errors = error.responseJSON.errors;
                            for (var key in errors) {
                                if (errors[key]?.length > 0) {

                                    // var convertedString = key.replace(/\[|\]/g, '');
                                    var convertedString = key.replace(/\[|\]/g, '');

                                    var selecttor = $('[name="' + key + '"]', form).length > 1 ?
                                        $('[name="' + key + '"]', form)[0] : $('[name="' + key +
                                            '"]', form);
                                    selecttor = selecttor.length == 0 ? ($('[name="' + key +
                                        '[]"]', form).length > 1 ? $('[name="' + key +
                                        '[]"]', form)[0] : $('[name="' + key + '[]"]',
                                        form)) : selecttor;

                                    $(selecttor).addClass('error');

                                    // if ($('.' + convertedString + '-error', form).length > 0) {
                                    //     $('.' + convertedString + '-error', form).html(errors[
                                    //         key][0].replace('_id', '').replace(/_/g,
                                    //         ' '));
                                    // } else {
                                    //     $('.' + convertedString + '-error', form).remove();
                                    //     $('<small class="error ' + convertedString +
                                    //             '-error">' + (errors[key][0].replace('_id', '')
                                    //                 .replace(/_/g, ' ')) + '</small>')
                                    //         .insertAfter(selecttor);
                                    // }
                                    $(this_btn).val(oldstatus);
                                    toastr.error((errors[key][0].replace('_id', '').replace(
                                            /_/g, ' ')) + '👋',
                                        'Somthing Wrong!', {
                                            closeButton: true,
                                            tapToDismiss: false
                                        });

                                }
                            }
                        }
                    }


                });
            });

        });
    </script>



@endsection
