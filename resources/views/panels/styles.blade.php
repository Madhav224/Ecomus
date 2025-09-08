<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors-rtl.min.css')) }}" />
@else
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}?v=1.3" />
@endif

@yield('vendor-style')
<!-- END: Vendor CSS-->

<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset(path: mix('css/core.css')) }}?v=2.3" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/dark-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/bordered-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/semi-dark-layout.css')) }}" />
<link rel="stylesheet" href="{{ url('/css/custom.css') }}?v={{ time() }}">
{{-- Start By Harsh --}}

<link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/extensions/ext-component-drag-drop.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/dragula.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/wizard/bs-stepper.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/quill.bubble.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/editors/quill/quill.snow.css') }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
<!-- END: Vendor CSS-->

<link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/form-quill-editor.css') }}">

{{--  Animation Css ex.modal Animation --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/animate/animate.min.css') }}">
{{-- End --}}

{{-- Font-awesome css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}">
{{-- Font-awesome css --}}


{{-- start Lightbox css --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/lightbox2/css/lightbox.css') }}">
{{-- end Lightbox css --}}

{{-- Date Filcker --}}
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/base/plugins/forms/pickers/form-pickadate.css') }}">

{{-- End By Harsh --}}
@php $configData = Helper::applClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
    <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/horizontal-menu.css')) }}" />
@else
    <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/vertical-menu.css')) }}" />
@endif

{{-- Page Styles --}}
@yield('page-style')

<!-- laravel style -->
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />

<!-- BEGIN: Custom CSS-->

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
    <link rel="stylesheet" href="{{ asset(mix('css-rtl/custom-rtl.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css-rtl/style-rtl.css')) }}" />
@else
    {{-- user custom styles --}}
    <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />
@endif

{{-- toastr --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">

<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">

<style>
    .modal::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari */
    }
    .modal {
        scrollbar-width: none;
        /* Firefox */
    }
</style>
