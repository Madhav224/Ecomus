@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('content')
<style type="text/css">

</style>
<section class="app-category-list">
<button class="btn btn-primary mb-1" id="addcategory"><i data-feather='plus'></i>&nbsp;Add</button>
    <div class="card">
            {!! createDatatableFormFilter($categoryListFormData) !!}
    </div>

    <div class="modal animated show" id="categoryModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Category Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" method="POST" name="categoryForm" action="{{ route('store.category') }}" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="row d-flex align-items-center">
                            <!-- Left Column: Fields -->
                            <div class="col-md-8">
                                <div class="mb-1">
                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Category Name" required>
                                    <small class="text-danger category_name-error"></small>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-6">
                                        <label class="form-label">Category Slug <span class="text-danger">*</span></label>
                                        <input type="text" id="category_slug" name="category_slug" class="form-control" placeholder="Category Slug" required>
                                        <small class="text-danger category_slug-error"></small>
                                    </div>
                                    <div class="mb-1 col-6">
                                        <label class="form-label">Category Parent</label>
                                        <select class="form-control select2" name="category_parent_id" id="category_parent_id">
                                            <option value="">Not Selected</option>
                                            @foreach($category_parent as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger category_parent_id-error"></small>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Category Description</label>
                                    <textarea id="category_description" name="category_description" class="form-control" placeholder="Category Description"></textarea>
                                    <small class="text-danger category_description-error"></small>
                                </div>

                                <!-- SEO Section -->
                                <h5>SEO</h5>
                                <div class="row">
                                    <div class="mb-1 col-6">
                                        <label class="form-label">SEO Title</label>
                                        <input type="text" id="seo_title" name="seo_title" class="form-control" placeholder="SEO Title">
                                    </div>
                                    <div class="mb-1 col-6">
                                        <label class="form-label">Slug (SEO URL)</label>
                                        <input type="text" id="seo_slug" name="seo_slug" class="form-control" placeholder="SEO URL">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-6">
                                        <label class="form-label">SEO Description</label>
                                        <textarea id="seo_description" name="seo_description" class="form-control"  placeholder="SEO Description"></textarea>
                                    </div>
                                    <div class="mb-1 col-6">
                                        <label class="form-label">Robot Meta Tag</label>
                                        <select class="form-control select2" name="robot_meta" id="robot_meta">
                                            <option value="index">Index</option>
                                            <option value="follow">Follow</option>
                                            <option value="noindex">Noindex</option>
                                            <option value="nofollow">Nofollow</option>
                                            <option value="noarchive">Noarchive</option>
                                            <option value="nosnippet">Nosnippet</option>
                                            <option value="noimageindex">Noimageindex</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label>Is Active For Hot List(At a time only one category display)<span class="text-danger">*</span></label>
                                    <div>
                                        <label>
                                            <input name="is_hot_mode" id="is_hot_mode" type="checkbox" value="active"> Is Hot Mode
                                        </label>
                                    </div>
                                    <span class="span-error" id="is_hot_mode-error"></span>
                                </div>
                            </div>

                            <!-- Right Column: Image Upload -->
                            <div class="col-md-4">
                                <div id="image-preview">
                                    <label class="form-label" for="basic-addon-name">Category Desktop Image<span class="text-danger">*</span></label>
                                    <div>
                                        <img id="category_image" src="{{ url('public/images/select_image.png') }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 1px solid #ccc;">
                                    </div>
                                    <div class="mt-1">
                                        <label for="category_desktop_image" class="btn btn-sm btn-primary mb-75 me-75">Upload Image</label>
                                        <input type="file" name="category_desktop_image" id="category_desktop_image" class="form-control preview-image-input" data-target="category_image"  accept="image/*" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        $(document).ready(function() {
            $("#addcategory").click(function() {

                $('#modelHeading').text('Add Category');
                $('.error').html('');

                // Show the modal with the id "ajaxModel"
                $("#categoryModel").modal("show");
            });
        });
    </script>

@endsection
