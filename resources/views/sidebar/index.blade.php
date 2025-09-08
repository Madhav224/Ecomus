@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', 'Sidebar Management')

@section('vendor-style')

@endsection
@section('content')

<section class="app-sidebar-list">
    <a href="#" class="btn btn-primary mb-1 open-my-model" mymodel="sidebarModel"><i data-feather='plus'></i>&nbsp;Add
        Sidebar</a>
    <a href="#" class="btn btn-outline-primary mb-1  sidebar_sorting" data-pid="0"><i data-feather='list'></i>&nbsp;
        Sidebar Sorting(Parent)</a>
    <div class="card">
        {!! createDatatableFormFilter($SidebarDataFilterData) !!}
    </div>
</section>



<div class="modal animated show" id="sidebarModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Sidebar Form</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {!! createFormHtmlContent($SidebarFormData) !!}

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="SidebarSort-model" tabindex="-1" aria-labelledby="position-model" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="position-model-label">Sidebar Sorting</h5>
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
    $('.select2').select2();



    var link_attr = $("#sidebar_link_attribute").val();
    $('#module_name').val(link_attr).trigger('change');


    var icons = Object.keys(feather.icons);
    sidebar_sel = $('#sidebar_icon');

    if (icons.length) {
        icons.map(function(icon) {
            if (sidebar_sel.length) {
                sidebar_sel.append(
                    '<option value="' + icon + '" data-icon="' + icon + '">' +
                    icon +
                    '</option>'
                );
            }
        });
        $(sidebar_sel).trigger('change');
        $(sidebar_sel).addClass('select2InModal form-control');
    }

    $('#sidebar_icon').each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            dropdownAutoWidth: true,
            width: '100%',
            minimumResultsForSearch: 1, // Enable search when there are results
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
            return icon.text; // If there's no ID, return the text (for the initial placeholder)
        }
        // Constructing the icon with Feather icon SVG
        var $icon = feather.icons[$(icon.element).data('icon')].toSvg() + " " + icon.text;
        return $icon;
    }




    $(".module_div").addClass("d-none");

    $(".is_dropdown").change(function() {
        var this_val = $(this).is(":checked") == true ? true : false;

        if (this_val == true) {
            $(".module_div,.link_type_div, .sidebar_link_div,.sidebar_link_attribute_div").addClass(
                "d-none");
            $('input[name="link_type"]').prop("checked", false);
            $('#parent_id').parent().addClass("d-none");
             $(".permissions_slug_div").addClass("d-none");
        } else {
            $(".link_type_div,.sidebar_link_div, .sidebar_link_attribute_div").removeClass("d-none");
            $(".module_div").addClass("d-none");
            $('#parent_id').parent().removeClass("d-none");
             $(".permissions_slug_div").removeClass("d-none");

        }
    });


    $(".link_type").change(function() {
        var this_val = $(this).val();


        $(".module_div, .sidebar_link_div, .sidebar_link_attribute_div").addClass("d-none");

        if (this_val == "internal_route") {
            $(".sidebar_link_div,.sidebar_link_attribute_div").removeClass("d-none");
            $(".permissions_slug_div").removeClass("d-none");
        } else if (this_val == "external_link") {
            $(".sidebar_link_div").removeClass("d-none");
            $(".permissions_slug_div").removeClass("d-none");
        } else if (this_val == "dynamic_module") {
            $(".module_div").removeClass("d-none");
            $(".permissions_slug_div").addClass("d-none");
        }
    });


    $(document).on('click', '.sidebar_sorting', function() {

        var perent_id = $(this).data('pid');
        $.ajax({
            type: "post",
            dataType: "json",
            url: "{{ route('sidebar.sortdata') }}", // Replace with your actual route
            data: {
                "parent_id": perent_id
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
                                        <h5> ${data.sidebar_label}</h5>
                                    </div>
                                </div>
                            </li>`;
                    // Append the item to the list
                    listGroup.append(listItem);
                });
                $("#SidebarSort-model").modal("show");
            }
        })
    })



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
                url: "{{ route('sidebar.update_sortdata') }}",
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
