@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')

@endsection
@section('content')
    <div class="content-header  row">
        <div class="content-header-right  text-end  d-flex justify-content-end col-lg-12 col-md-12 col-sm-12 col-12">
            <a href="#" class="btn btn-outline-primary mb-1  brand_sorting" data-pid="0"><i
                    data-feather='list'></i>&nbsp;
                Brand Sorting</a>

            @if (!(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.brands.create')))
                <a href="#" class="btn btn-primary ms-1 mb-1 open-my-model" mymodel="BrandModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    Brand</a>
            @endif
        </div>
    </div>

    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($BrandDataFilterData) !!}
        </div>
    </section>

    {{-- Blog Form Modal --}}
    <div class="modal animated show" id="BrandModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Brand Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! createFormHtmlContent($BrandFormData) !!}

                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    <div class="modal fade" id="SidebarSort-model" tabindex="-1" aria-labelledby="position-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="position-model-label">Brand Sorting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group mt-1" id="basic-list-group" data-type="">

                    </ul>
                </div>
                <div class="modal-footer" id="position-model-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="Savesort">Confirm</button>
                </div>
            </div>
        </div>
    </div>

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

        });

        $(document).on('click', '.brand_sorting', function() {


            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('brand.sortdata') }}",
                data: {

                },
                success: function(response) {
                    if (response.status == 404) {
                        toastr.info(`👋` + response.message + "!",
                            'Not Found', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        return
                    }
                    var sidebar_data = response.data;
                    var listGroup = $("#basic-list-group");
                    listGroup.empty();
                    sidebar_data.forEach(function(data) {

                        var listItem = `
        <li class="list-group-item draggable" data-sid="${data.id}" style="border:1px solid #22292f20;">
            <div class="d-flex" >
                <i data-feather="circle"></i>
                <div class="more-info">
                    <h5> ${data.brand_name}</h5>
                </div>
            </div>
        </li>`;
                        // Append the item to the list
                        listGroup.append(listItem);
                    });
                    $("#SidebarSort-model").modal("show");
                }
            })
        });

        $('#Savesort').click(
            function() {

                var SidebarData = {
                    data: []
                };


                $("#basic-list-group .list-group-item").each(function(index) {
                    // var ModuleId = $(this).data('mid');
                    var Id = $(this).data('sid');
                    var position = index + 1;

                    var layoutSize = $(this).find('.layout-size').val();

                    SidebarData.data.push({
                        id: Id,
                        position: position,

                    });
                });
                var listData = JSON.stringify(SidebarData);

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('brand.update_sortdata') }}",
                    data: listData,
                    success: function(response) {
                        if (response.status == 200) {

                            toastr['success']('👋' + response.message, 'Sorting Update', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                            $("#SidebarSort-model").modal("hide");
                            location.reload();
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
                    }

                });

            }
        );
    </script>


@endsection
