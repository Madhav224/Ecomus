<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset(mix('vendors/js/ui/jquery.sticky.js')) }}"></script>
<!-- Include the socket.io v2 client library -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> -->
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<!-- toastr -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

{{-- start lightbox js --}}
<script src="{{ asset('vendors/lightbox2/js/lightbox.js') }}"></script>
{{-- end lightbox js --}}


{{-- By Harsh --}}

<script src="{{ asset('vendors/js/extensions/dragula.min.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-drag-drop.js') }}"></script>
<script src="{{ asset('vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('js/scripts/forms/pickers/form-pickers.js') }}"></script>


{{-- <script src="{{ asset('js/scripts/forms/form-quill-editor.js') }}"></script> --}}
<script src="{{ asset('vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset('vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>

{{-- <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script> --}}

<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>

{{-- End  --}}
@if ($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif

@if (!empty($ajaxformsubmit))
    <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendors/helper/js/form.min.js') }}?v=1"></script>
@endif

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script src="{{ asset('vendors/helper/js/paginate.min.js') }}"></script>


<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
