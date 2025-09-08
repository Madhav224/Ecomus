@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
<style>
    .form-control.variant-value-color {
     display:none ;
}
</style>
@endsection
@section('content')
    <section class="app-sidebar-list">
        <div class="card">
            {!! createDatatableFormFilter($VariantDataFilterData) !!}
        </div>
    </section>

    {{-- Variant Form Modal --}}
    <div class="modal animated show" id="variantModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Variant Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! createFormHtmlContent($VariantFormData) !!}

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

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const parentSelect = document.querySelector('[name="variant_parent_id"]');
            const colorInputWrapper = document.getElementsByClassName('variant-value-color')[0];
            const colorInput = document.querySelector('input[name="variant_value"]');
            const colorChecked = document.querySelector('.form-check .variant-color-checkbox');
            const colorLabel = document.querySelector('.form-check-label');


            $('#variantModel').on('shown.bs.modal', function() {

                setTimeout(() => {

                    const selectedAttrValue = parentSelect.getAttribute('selected-value');
                    const idInput = document.querySelector('input[name="id"]');
                    const id = idInput?.value || null;
                    console.log("id", id);
                    console.log("selectedAttrValue", selectedAttrValue);
                    if (id) {
                        fetchVariantData(id);
                    } else if (selectedAttrValue) {
                        fetchVariantData(selectedAttrValue);
                    }
                }, 50);
            });

            // Reusable function to fetch and update UI
            function fetchVariantData(selectedId) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('variant_change', ['id' => '__ID__']) }}".replace('__ID__', selectedId),
                    success: function(response) {
                        console.log("Response", response);
                        if (response.is_color == '1') {
                            colorInputWrapper.style.display = 'block';
                            colorInput.value = response.variant_value ?? '#000000';
                            colorChecked.value = response.is_color ?? '0';
                            colorChecked.style.display = 'none';
                            colorLabel.style.display = 'none';
                        } else {
                            colorInputWrapper.style.display = 'none';
                            colorInput.value = '';
                            colorChecked.style.display = 'none';
                            colorLabel.style.display = 'none';
                        }
                    },
                    error: function() {
                        colorInputWrapper.style.display = 'none';
                        colorInput.value = '';
                    }
                });
            }

            // On change of parent select
            parentSelect.addEventListener('change', function() {
                const selectedId = parseInt(this.value);
                if (selectedId) {
                    fetchVariantData(selectedId);
                } else {
                    colorInputWrapper.style.display = 'none';
                    colorInput.value = '';
                }
            });
            function toggleColorBox() {
                const value = $('#variant_parent_id').val();
                if (value === '' || value === null) {
                    $('#is_color0').closest('div').show();
                } else {
                    $('#is_color0').closest('div').hide();
                }
            }
            toggleColorBox();
            $('#variant_parent_id').on('change', toggleColorBox);
        });
    </script>
@endsection
