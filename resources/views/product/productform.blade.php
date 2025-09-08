@php($ajaxformsubmit = false)
@extends('layouts/contentLayoutMaster')

@section('title', $title)
@section('vendor-style')

@endsection

<style>
    .remove_product_image {
        position: absolute;
        bottom: 3px;
        right: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        background-color: #fbb7b7;
        padding: 5px;
        cursor: pointer;
        z-index: 10;
        transition: 0.3s ease;
        width: 84px !important;
        height: 26px !important;
    }

    .preview_image {
        width: 124px;
        height: 118px;
        object-fit: cover;
    }

    .preview_variant_image {
        width: 110px;
        height: 105px;
        object-fit: cover;
    }

    .remove_variant_image {
        position: absolute;
        bottom: 3px;
        right: 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        background-color: #fbb7b7;
        padding: 5px;
        cursor: pointer;
        z-index: 10;
        transition: 0.3s ease;
        width: 84px !important;
        height: 26px !important;
    }

    /* .variant-table-wrapper {
    overflow-x: auto;
    width: 100%;
  }

  #variant-table {
    border-collapse: collapse;
    width: max-content;
    min-width: 100%;
  }

  #variant-table th,
  #variant-table td {
    width: 12rem;
    white-space: nowrap;
  }

  #variant-table th:first-child,
  #variant-table td:first-child {
    position: sticky;
    left: 0;
    z-index: 5;
    background: white;
    width: 20rem;
    }

    #variant-table thead th {
        position: sticky;
        top: 0;
        z-index: 3;
        background: #f1f1f1;
    }

    */
</style>

@section('content')
    <form action="" id="productform">
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2 ">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">General info</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add General info</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-10 ">
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="{{ $product?->id ?? 0 }}">

                        <div class="col-md-12 col-12 ">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                placeholder="Enter Product name" value="{{ $product?->product_name }}">
                        </div>
                        <div class="col-md-6 col-12 mt-1">
                            <label for="product_slug" class="form-label">Product Slug</label>
                            <input type="text" name="product_slug" id="product_slug" class="form-control"
                                placeholder="Enter Product slug" value="{{ $product?->product_slug }}">
                        </div>
                        <div class="col-md-6 col-12 mt-1">
                            <label for="product_sku_code" class="form-label">Product SKU code</label>
                            <input type="text" name="product_sku_code" id="product_sku_code" class="form-control"
                                placeholder="Enter Product sku code" value="{{ $product?->product_sku_code }}">
                        </div>

                        <div class=" col-md-6 col-12 mt-1">
                            <label for="product_brand_id" class="form-label">Product Brand</label>
                            <select name="product_brand_id" id="product_brand_id" class="form-select">
                                <option value="">Select</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ $product?->product_brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-md-6 col-12 mt-1">
                            <label for="product_category_id" class="form-label">Product Category</label>
                            <select name="product_categorie_id[]" id="product_categorie_id" class="form-select select2"
                                multiple>
                                @foreach ($product_category as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, $product?->product_categorie_id ?? []) ? 'selected' : '' }}>
                                        {{ $category->categorie_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Description</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Description</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10  col-md-10">
                    <div class="row">
                        <div class="col-md-12 col-12 mb-5">
                            <label for="product_description" class="form-label">Short Description</label>
                            <textarea name="product_short_description" id="product_short_description" class="form-control quill-editor"
                                placeholder="Enter Short Description" rows="4">{{ $product?->product_short_description }}</textarea>
                        </div>
                        <div class="col-md-12 col-12 mt-3 mb-5">
                            <label for="product_description" class="form-label">Long Description</label>
                            <textarea name="product_long_description" id="product_long_description" class="form-control quill-editor"
                                placeholder="Enter Long Description" rows="4">{{ $product?->product_long_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Details</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Details</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10  col-md-10">
                    <div class="row">
                        {{-- <label for=""><b>Product Details</b></label> --}}
                        <label for=""><b>About This Products</b></label>
                        <div class="repetor border rounded p-2">
                            <div class="repetor_container">
                                @if (!empty($product?->product_details))
                                    @foreach ($product?->product_details as $key => $value)
                                        <div class="row {{ $loop->index != 0 ? 'mt-1' : '' }}">
                                            <div class="form-group col-md-10 col-12">
                                                <label for="product_name" class="form-label">Title</label>
                                                <input type="text" name="product_details[]"
                                                    class="form-control" placeholder="Enter title"
                                                    value="{{ $value ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                                                <button
                                                    class="btn btn-primary btn-sm {{ $loop->index == 0 ? 'add_more' : 'remove-repeater' }}"
                                                    type="button">
                                                    <i data-feather="{{ $loop->index == 0 ? 'plus' : 'x' }}"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- @foreach ($product?->product_details as $key => $value)
                                        <div class="row {{ $loop->index != 0 ? 'mt-1' : '' }}">
                                            <div class="form-group col-md-5 col-12">
                                                <label for="product_name" class="form-label">Title</label>
                                                <input type="text" name="product_details[title][]"
                                                    class="form-control" placeholder="Enter title"
                                                    value="{{ $key ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label for="product_name" class="form-label">Value</label>
                                                <input type="text" name="product_details[value][]"
                                                    class="form-control" placeholder="Enter Value"
                                                    value="{{ $value ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                                                <button
                                                    class="btn btn-primary btn-sm {{ $loop->index == 0 ? 'add_more' : 'remove-repeater' }}"
                                                    type="button">
                                                    <i data-feather="{{ $loop->index == 0 ? 'plus' : 'x' }}"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                @else
                                    <div class="row">
                                        <div class="form-group col-md-10 col-12">
                                            <label for="product_name" class="form-label">Description</label>
                                            <input type="text" name="product_details[]" class="form-control"
                                                placeholder="Enter Descriptions">
                                        </div>
                                        <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-sm add_more" type="button">
                                                <i data-feather="plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                        <label class="mt-1"><b>Product Additional Details</b></label>
                        <div class="repetor border  rounded p-2">
                            <div class="repetor_container">
                                @if (!empty($product?->product_additional_details))
                                    @foreach ($product?->product_additional_details as $key => $value)
                                        <div class="row {{ $loop->index != 0 ? 'mt-1' : '' }}">
                                            <div class="form-group col-md-5 col-12">
                                                <label for="product_name" class="form-label">Title</label>
                                                <input type="text" name="product_additional_details[title][]"
                                                    class="form-control" placeholder="Enter title"
                                                    value="{{ $key ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label for="product_name" class="form-label">Value</label>
                                                <input type="text" name="product_additional_details[value][]"
                                                    class="form-control" placeholder="Enter Value"
                                                    value="{{ $value ?? '' }}">
                                            </div>
                                            <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                                                <button
                                                    class="btn btn-primary btn-sm {{ $loop->index == 0 ? 'add_more' : 'remove-repeater' }}"
                                                    type="button">
                                                    <i data-feather="{{ $loop->index == 0 ? 'plus' : 'x' }}"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row">
                                        <div class="form-group col-md-5 col-12">
                                            <label for="product_name" class="form-label">Title</label>
                                            <input type="text" name="product_additional_details[title][]"
                                                class="form-control" placeholder="Enter title">
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label for="product_name" class="form-label">Value</label>
                                            <input type="text" name="product_additional_details[value][]"
                                                class="form-control" placeholder="Enter Value">
                                        </div>
                                        <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-sm add_more" type="button">
                                                <i data-feather="plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Images</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Images</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10  col-md-10">
                    <div class="row">
                        <div class="form-group col-md-12 col-12 ">
                            <label for="product_slug" class="form-label">Product Images</label>
                            <input type="file" name="product_images[]" id="product_images" class="form-control"
                                placeholder="Enter Product Images" accept=".png,.jpg,.jpeg,.webp" multiple>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap" id="image-preview-container">

                        @if ($product?->product_images_url)
                            @foreach ($product?->product_images_url as $i => $image)
                                <div class="image-container position-relative m-2" data-i="{{ $i }}"
                                    data-pid="{{ $product?->id }}">
                                    <div class="mb-2">
                                        <input type="radio" name="product_thumbnail_image"
                                            value="{{ $product?->product_images[$i] }}"
                                            id="{{ $product?->product_images[$i] . $i }}main_image"
                                            class="main-image-radio"
                                            {{ $product?->product_thumbnail_image_url === $image ? 'checked' : '' }}>
                                        <label for="{{ $product?->product_images[$i] . $i }}main_image">Main Image</label>
                                    </div>
                                    <a href="{{ $image }}" data-lightbox="Product Image{{ $i }}"
                                        data-title="Product Image preview">
                                        <img src="{{ $image }}" class="rounded preview_image">
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm remove_product_image delete_image"
                                        data-id="{{ $product?->id }}" data-image="{{ $product?->product_images[$i] }}"
                                        data-variant_id="0">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Pricing</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Pricing</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="row">
                        <!-- MRP Field -->
                        <div class="form-group col-md-4 col-12">
                            <label for="product_mrp" class="form-label">MRP<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><b>₹</b></span>
                                <input type="text" name="product_mrp" id="product_mrp" class="form-control"
                                    placeholder="Enter MRP" value="{{ $product?->product_mrp }}">
                            </div>
                        </div>
                        <!-- Price Field -->
                        <div class="form-group col-md-4 col-12">
                            <label for="product_price" class="form-label">Price<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><b>₹</b></span>
                                <input type="text" name="product_price" id="product_price" class="form-control"
                                    placeholder="Enter Price" value="{{ $product?->product_price }}">
                            </div>
                        </div>

                        <!-- Discount Field -->
                        <div class="form-group col-md-4 col-12">
                            <label for="product_discount" class="form-label">Discount<span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><b>%</b></span>
                                <input type="text" name="product_discount" id="product_discount" class="form-control"
                                    placeholder="Enter Discount" value="{{ $product?->product_discount }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mt-1">
                            <label for="product_stock" class="form-label">Stock<span class="text-danger">*</span></label>
                            <input type="number" name="product_stock" id="product_stock" class="form-control"
                                placeholder="Enter Stock" min="0" step="1"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                value="{{ $product?->product_stock }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Product Variants</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Variants</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="row align-items-end mb-1">
                        <div class=" col-md-12 col-12">
                            <label class="form-label">Variants</label>
                            <select name="variant_parent_id[]" id="product_variant_id" class="form-select select2"
                                multiple>
                                @foreach ($variants as $variant)
                                    <option value="{{ $variant->id }}"
                                        {{ in_array($variant->id, $product?->product_variant_parent_ids ?? []) ? 'selected' : '' }}>
                                        {{ ucfirst($variant->variant_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-end mb-1 variant_childs_container">
                        @if (!empty($product?->product_variants_data))
                            @foreach ($product?->product_variants_data as $parentindex => $parentvariant)
                                <div class="col-12 col-md-12 mb-1">
                                    <label class="form-label"
                                        for="{{ $parentvariant['variant_name'] }}">{{ $parentvariant['variant_name'] }}
                                        variants</label>
                                    <select name="" id="{{ $parentvariant['variant_name'] }}"
                                        class="form-select select2 variants_childs" data-pid="{{ $parentvariant['id'] }}"
                                        data-pname="{{ $parentvariant['variant_name'] }}" multiple>
                                        @foreach ($parentvariant['children'] as $child)
                                            <option value="{{ $child['id'] }}"
                                                {{ in_array($child['id'], $product?->product_variants_child_ids ?? []) ? 'selected' : '' }}>
                                                {{ ucfirst($child['variant_name']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="table-responsive variant-table-wrapper">
                        <table class="table {{ $product && $product?->ProductVariants->isNotEmpty() ? '' : 'd-none' }} "
                            id="variant-table">
                            <thead>
                                <tr>
                                    <th>Combination</th>
                                    <th class="p-1"> </th>
                                    <th>SKU Code</th>
                                    <th>MRP</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Stock</th>
                                    <th> Link</th>
                                </tr>
                            </thead>
                            <tbody class="table-body" id="variant-table-body">
                                @if ($product?->ProductVariants)
                                    @foreach ($product?->ProductVariants as $index => $variant)
                                        {{-- {{ dd($variant->parent,$variant->variant_parent_ids)}} --}}
                                        <tr>
                                            <td>{{ $variant?->variant_combination_names }}
                                            <td class="p-1"> <a href="#" class=" open-my-model"
                                                    mymodel="ImagesModel" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Open Image Modal"><i
                                                        data-feather="image" style="width: 18px; height: 18px;"></i></a>
                                            </td>
                                            <input type="hidden" class="form-control form-control-sm"
                                                id="{{ $index }}id" name="variants[{{ $index }}][id]"
                                                value="{{ $variant?->id }}">
                                            <input type="hidden" class="form-control form-control-sm"
                                                id="{{ $index }}variant_combination"
                                                name="variants[{{ $index }}][variant_combination]"
                                                value="{{ $variant?->variant_combination_names }}">
                                            <input type="hidden" class="form-control form-control-sm"
                                                id="{{ $index }}variant_ids"
                                                name="variants[{{ $index }}][variant_ids]"
                                                value='{{ $variant?->variant_ids_names }}'>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                    id="{{ $index }}product_variant_skucode"
                                                    name="variants[{{ $index }}][product_variant_skucode]"
                                                    placeholder="SKU Code"
                                                    value="{{ $variant?->product_variant_skucode }}">
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm variant_mrp"
                                                    id="{{ $index }}product_variant_mrp"
                                                    name="variants[{{ $index }}][product_variant_mrp]"
                                                    placeholder="MRP(₹)" value="{{ $variant?->product_variant_mrp }}">
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm variant_price"
                                                    id="{{ $index }}product_variant_price"
                                                    name="variants[{{ $index }}][product_variant_price]"
                                                    placeholder="Price(₹)"
                                                    value="{{ $variant?->product_variant_price }}">
                                            </td>
                                            <td><input type="text"
                                                    class="form-control form-control-sm variant_discount"
                                                    id="{{ $index }}product_variant_discount"
                                                    name="variants[{{ $index }}][product_variant_discount]"
                                                    placeholder="Discount(%)"
                                                    value="{{ $variant?->product_variant_discount }}">
                                            </td>
                                            <td><input type="number" class="form-control form-control-sm"
                                                    name="variants[{{ $index }}][product_variant_stock]"
                                                    id="{{ $index }}product_variant_stock" placeholder="Stock"
                                                    min="0" step="1"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    value="{{ $variant?->product_variant_stock }}">
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                    id="{{ $index }}product_variant_youtube_link"
                                                    name="variants[{{ $index }}][product_variant_youtube_link]"
                                                    placeholder="Youtube Link"
                                                    value="{{ $variant?->product_variant_youtube_link }}"></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>

                        {{-- Variants Images Form Modal --}}
                        <div class="modal animated show" id="ImagesModel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelHeading">Variants Images</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row " id="variantsimages_container">
                                            @if ($product?->ProductVariants)
                                                @foreach ($product?->ProductVariants as $index => $variant)
                                                    <div class="col-md-12 col-12 mb-1">
                                                        <label for="{{ $index }}product_variant_images"
                                                            class="form-label
                                            ">Product
                                                            Variants({{ $variant?->variant_combination_names }})
                                                            Images</label>
                                                        <input type="file"
                                                            name="variants[{{ $index }}][product_variant_images][]"
                                                            id="{{ $index }}product_variant_images"
                                                            class="form-control variant_images"
                                                            data-imgindex="{{ $index }}"
                                                            accept=".png,.jpg,.jpeg,.webp" multiple>
                                                        <div class="d-flex flex-wrap"
                                                            id="variantimg-preview-{{ $index }}">
                                                            @if (!empty($variant?->product_variant_images_url))
                                                                @foreach ($variant?->product_variant_images_url as $i => $image)
                                                                    <div class="image-container position-relative m-2"
                                                                        data-i="{{ $i }}"
                                                                        data-pid="{{ $product?->id }}">
                                                                        <div class="mb-2">
                                                                            <input type="radio"
                                                                                name="variants[{{ $index }}][product_variant_thumbnail_image]"
                                                                                value="{{ $variant?->product_variant_images[$i] }}"
                                                                                id="{{ $index . $i . $variant?->product_variant_images[$i] }}main_image"
                                                                                class="main-image-radio"
                                                                                {{ $variant?->product_variant_thumbnail_image_url == $image ? 'checked' : '' }}>
                                                                            <label
                                                                                for="{{ $index . $i . $variant?->product_variant_images[$i] }}main_image">Main
                                                                                Image</label>
                                                                        </div>
                                                                        <a href="{{ $image }}"
                                                                            data-lightbox="Product Image{{ $i }}"
                                                                            data-title="Product Image preview">
                                                                            <img src="{{ $image }}"
                                                                                class="rounded preview_variant_image"
                                                                                alt="{{ $variant->product_variant_images[$i] }}">
                                                                        </a>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm remove_variant_image delete_image"
                                                                            data-id="{{ $product?->id }}"
                                                                            data-image="{{ $variant?->product_variant_images[$i] }}"
                                                                            data-variant_id="{{ $variant?->id }}">Remove</button>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2">
                    <div class="d-flex align-items-center">
                        <div class="me-1 border p-1 bg-light-primary rounded">
                            <i data-feather="box" style="width: 22px; height: 22px;"></i>
                        </div>
                        <div>
                            <h6 class="m-0">Frequently Bought</h6>
                            <p class="m-0" style="font-size: small; line-height: normal;">Add Frequently Bought</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="row align-items-end mb-1">
                        <div class=" col-md-12 col-12">
                            <label class="form-label">Frequently Bought</label>
                            <select name="frequently_bought[]" id="frequently_bought" class="form-select select2"
                                multiple data-placeholder="Select up to 2 products">
                                @foreach ($all_products as $pro)
                                    <option value="{{ $pro->id }}"
                                        {{ in_array($pro->id, $product?->frequently_bought ?? []) ? 'selected' : '' }}>
                                        {{ ucfirst($pro->product_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card p-1">
            <div class="col-12 col-md-12 text-end">
                <a href="{{ route('product.index') }}" class="btn btn-secondary"><i data-feather='skip-back'></i>
                    Close</a>
                <button type="submit" class="btn btn-primary text-capitalize" id="saveBtn"><i
                        data-feather='save'></i>Save Product</button>
            </div>
        </div>
    </form>




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

            $('.select2').select2({
                // dropdownAutoWidth: true,
                minimumResultsForSearch: 0,
                placeholder: 'Select',
            });
        });

        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        });

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                })
            }
        });

        // ----------------------------------
        const cfg = {
            theme: 'snow',
            modules: {
                formula: true,
                syntax: true,
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        script: 'super'
                    }, {
                        script: 'sub'
                    }],
                    [{
                        header: '1'
                    }, {
                        header: '2'
                    }, 'blockquote', 'code-block'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }, {
                        indent: '-1'
                    }, {
                        indent: '+1'
                    }],
                    ['direction', {
                        align: []
                    }],
                    ['link', 'formula'],
                    ['clean']
                ]
            }
        };

        const bindQuill = id => {
            const $t = $('#' + id);
            const cid = `q_${id}`;
            $t.after(`<div id="${cid}" style="min-height:150px"></div>`).hide();
            const q = new Quill(`#${cid}`, cfg);
            q.root.innerHTML = $t.val();
            // live-sync on every change
            q.on('text-change', () => {
                $t.val(q.root.innerHTML);
            });
            return q;
        };

        // initialize both editors
        bindQuill('product_short_description');
        bindQuill('product_long_description');
        // ----------------------------------

        // -----------------------------------------------
        // Product Details & Product Additional Details repeater and remove repeater script
        // Add Repeater Query
        $(document).on('click', '.add_more', function() {
            var this_btn = $(this),
                parent_div = $(this_btn).closest('.row'),
                repeater_input = $(this_btn).closest('.repetor_container').find('.row:first').clone();

            $(repeater_input).find('input').val('');
            $(repeater_input).addClass('mt-1');

            $(repeater_input).find('.add_more').removeClass('add_more').addClass('remove-repeater').html(
                '<i data-feather="x"></i>');

            $(this_btn).closest('.repetor_container').append(repeater_input);

            feather.replace();
        });
        // Remove Repeater Query
        $(document).on('click', '.remove-repeater', function() {
            var repeater_input = $(this).closest('.row');
            repeater_input.remove();
        });
        // -----------------------------------------------


        $(document).ready(function() {

            // Seleect Image And Preview image script start..............
            let selectedFiles = [];

            $('#product_images').on('change', e => {
                selectedFiles = [...e.target.files];
                renderPreviews();
            });

            function renderPreviews() {
                const isedit = "{{ $product?->id ? true : false }}",
                    preview_container = $('#image-preview-container');

                // if (!isedit) preview_container.empty();
                $('#image-preview-container .image-container').filter(function() {
                    return !$(this).attr('data-pid');
                }).remove();

                selectedFiles.forEach((file, i) => {
                    const r = new FileReader();
                    r.onload = e => {
                        const $box = $(`
                <div class="image-container position-relative m-2" data-i="${i}">
                    <div class="mb-2">
                        <input type="radio" name="product_thumbnail_image" value="${file.name}" id="${file.name}${i}main_image" class="main-image-radio" ${!isedit && i === 0 ? 'checked' : ''}>
                        <label for="${file.name}${i}main_image">Main Image</label>
                    </div>
                    <a href="${e.target.result}" data-lightbox="Product Image${i}" data-title="Product Image preview" >
                    <img src="${e.target.result}" class="rounded preview_image" alt=${file.name}>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm remove_product_image delete_image" data-id="" data-image=""   data-variant_id="">Remove</button>
                </div>
            `);
                        preview_container.append($box);
                    };
                    r.readAsDataURL(file);
                });

                setTimeout(() => {
                    if (!$('.main-image-radio:checked').length && selectedFiles.length)
                        $('.main-image-radio').first().prop('checked', true);
                }, 50);
            }

            //  remove product image
            $(document).on('click', '.delete_image', function() {

                var id = $(this).data('id') ?? 0,
                    image = $(this).data('image') ?? null,
                    variant_id = $(this).data('variant_id') ?? 0;
                const closest_container = $(this).closest('.image-container');


                if (image == null || image == undefined || image == '') {
                    const index = closest_container.data('i');
                    selectedFiles.splice(index, 1);
                    const dt = new DataTransfer();
                    selectedFiles.forEach(f => dt.items.add(f));
                    $('#product_images')[0].files = dt.files;
                    closest_container.remove();

                } else {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('remove.image') }}",
                        data: {
                            id: id,
                            image: image,
                            variant_id: variant_id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                closest_container.remove();
                                toastr['success'](
                                    '👋 ' + response.message,
                                    'Image deleted', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });
                            } else {
                                toastr.info(`👋 ` + response.message,
                                    'Image Deletion Failed', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });
                                // alert(response.message);
                            }
                        },
                        error: function(error) {
                            toastr.error('An unexpected error occurred!', 'Error', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                            console.error('Error details:', error.responseText);
                        }
                    });
                }
            });
            // End remove product image
            // End Image Preview Script.......

            let variantSelectedFiles = {};

            // Submit logic
            $('form').on('submit', function(event) {
                event.preventDefault();
                var form = $('#productform');

                $('#saveBtn').attr('disabled', true).html(
                    '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                );
                const formData = new FormData(this);

                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.Status == 200) {
                            toastr['success'](
                                '👋 ' + response.Message,
                                'Product Store ', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                });
                            location.href = "{{ route('product.index') }}";
                        } else if (response.Status == 403) {
                            toastr.error('👋' + (response?.Message ? response?.Message :
                                'Somthing Wrong!'), 'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            });

                            if (response?.Redirect) {
                                window.location = response?.Redirect;
                            }
                        } else {
                            toastr['error'](
                                '👋 ' + response.Message,
                                'Product Store Error', {
                                    closeButton: true,
                                    tapToDismiss: false,
                                });
                        }
                    },
                    error: function(error) {
                        console.log('error :: ', error?.status, error?.statusText)
                        if (error.status === 422) {
                            // Handle validation errors
                            var errors = error.responseJSON.errors;
                            for (var key in errors) {
                                if (errors[key]?.length > 0) {

                                    // var convertedString = key.replace(/\[|\]/g, '');
                                    var convertedString = key.replace(/\[|\]/g, '');

                                    var selecttor = $('[name="' + key + '"]', form).length > 1 ?
                                        $(
                                            '[name="' + key + '"]', form)[0] : $('[name="' +
                                            key + '"]',
                                            form);


                                    selecttor = selecttor.length == 0 ? ($('#' + key, form)
                                        .length > 1 ? $('#' + key, form)[0] : $(
                                            '#' + key, form)) : selecttor;

                                    $(selecttor).addClass('error');

                                    if ($('.' + convertedString + '-error', form).length > 0) {
                                        $('.' + convertedString + '-error', form).html(errors[
                                                key][0]
                                            .replace('_id', '').replace(/_/g, ' '));
                                    } else {
                                        $('.' + convertedString + '-error', form).remove();
                                        $('<small class="error ' + convertedString +
                                            '-error">' + (errors[
                                                key][0].replace('_id', '').replace(/_/g,
                                                ' ')) +
                                            '</small>').insertAfter(selecttor);
                                    }
                                    toastr.error((errors[key][0].replace('_id', '').replace(
                                            /_/g, ' ')) +
                                        '👋',
                                        'Somthing Wrong!', {
                                            closeButton: true,
                                            tapToDismiss: false
                                        });

                                }
                            }
                        }
                        if (error?.status == 419) {
                            let person = confirm("Page Session is Expired! Reload");
                            if (person)
                                location.reload();
                        }
                    },
                    complete: function() {
                        // Re-enable the button after the request completes
                        $('#saveBtn').attr('disabled', false).html(
                            '<i data-feather="save"></i> Save Product');
                        feather.replace();
                    }

                });
            });

            $(document).on('keyup change', 'input,select,date,textarea', function(event) {
                // Get the name attribute of the fieldElement
                var inputValue = $(this).attr('id');

                if (inputValue == undefined)
                    return;
                // Remove the 'error' class from elements with the specified name
                $('[id="' + inputValue + '"]').removeClass('error');

                // Reset the content of elements with the specified class
                var inputValue = inputValue.replace(/\[|\]/g, '');
                $('.' + inputValue + '-error').html('');
            });

        });
    </script>


    <script>
        // $(function() {
        //     const $mrp = $('#product_mrp'),
        //         $discount = $('#product_discount'),
        //         $price = $('#product_price');

        //     const clean = v => v.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        //     const fmt = v => parseFloat(v).toFixed(2);

        //     function updatePrice() {
        //         const m = parseFloat(clean($mrp.val())) || 0;
        //         let d = parseFloat(clean($discount.val())) || 0;
        //         if (d > 100) d = 100;
        //         if (!m) return $price.val('');
        //         $discount.val(fmt(d));
        //         $price.val(fmt(m - m * d / 100));
        //     }

        //     function updateDiscount() {
        //         const m = parseFloat(clean($mrp.val())) || 0;
        //         const p = parseFloat(clean($price.val())) || 0;
        //         if (!m) return $discount.val('');
        //         if (p > m) {
        //             alert("Price cannot be greater than MRP");
        //             $price.val('');
        //             return $discount.val('');
        //         }
        //         $discount.val(fmt(((m - p) / m) * 100));
        //     }

        //     $mrp.on('input', () => {
        //         $mrp.val(clean($mrp.val()));
        //         if ($discount.val()) updatePrice();
        //         else if ($price.val()) updateDiscount();
        //         else {
        //             $price.val('');
        //             $discount.val('');
        //         }
        //     });

        //     $discount.on('input', () => updatePrice())
        //         .on('blur', () => {
        //             let v = parseFloat(clean($discount.val()));
        //             if (isNaN(v)) $discount.val('');
        //             else $discount.val(fmt(v > 100 ? 100 : v));
        //             updatePrice();
        //         });

        //     $price.on('input', () => updateDiscount())
        //         .on('blur', () => {
        //             let v = parseFloat(clean($price.val()));
        //             if (!isNaN(v)) $price.val(fmt(v));
        //         });
        // });
    </script>
    <script>
        $(function() {
            const $mrp = $('#product_mrp'),
                $discount = $('#product_discount'),
                $price = $('#product_price');

            // Clean input: allow digits and max one dot
            const clean = val => {
                val = val.replace(/[^0-9.]/g, ''); // Remove all except digits and dot
                const parts = val.split('.');
                if (parts.length > 2) {
                    val = parts[0] + '.' + parts.slice(1).join('');
                }
                return val;
            };

            // Format number with 2 decimals
            const fmt = val => {
                let n = parseFloat(val);
                return isNaN(n) ? '' : n.toFixed(2);
            };

            function updatePrice() {
                const m = parseFloat(clean($mrp.val())) || 0;
                let d = parseFloat(clean($discount.val())) || 0;
                if (d > 100) d = 100;
                if (!m) {
                    $price.val('');
                    return;
                }
                $discount.val(d.toFixed(2));
                const priceVal = m - (m * d / 100);
                $price.val(priceVal.toFixed(2));
            }

            function updateDiscount() {
                const m = parseFloat(clean($mrp.val())) || 0;
                const p = parseFloat(clean($price.val())) || 0;
                if (!m) {
                    $discount.val('');
                    return;
                }
                if (p > m) {
                    alert("Price cannot be greater than MRP");
                    $price.val('');
                    $discount.val('');
                    return;
                }
                const discountVal = ((m - p) / m) * 100;
                $discount.val(discountVal.toFixed(2));
            }

            // MRP input event
            $mrp.on('input', function() {
                this.value = clean(this.value);
                if ($discount.val()) updatePrice();
                else if ($price.val()) updateDiscount();
                else {
                    $price.val('');
                    $discount.val('');
                }
            });

            // Discount input event
            $discount.on('input', function() {
                this.value = clean(this.value);
                let val = parseFloat(this.value);
                if (!isNaN(val)) {
                    if (val > 100) val = 100;
                    else if (val < 0) val = 0;
                    this.value = val.toString();
                }
                updatePrice();
            }).on('blur', function() {
                let val = parseFloat(this.value);
                if (!isNaN(val)) {
                    if (val > 100) val = 100;
                    else if (val < 0) val = 0;
                    this.value = val.toFixed(2);
                } else {
                    this.value = '';
                }
                updatePrice();
            });

            // Price input event
            $price.on('input', function() {
                this.value = clean(this.value);
                updateDiscount();
            }).on('blur', function() {
                let val = parseFloat(this.value);
                if (!isNaN(val)) this.value = val.toFixed(2);
            });
        });
    </script>




    {{-- End Here --}}

    {{-- variants script start --}}
    <script>
        // Show Variants child list script
        $("#product_variant_id").change(function(e) {
            e.preventDefault();
            var ids = $(this).val();

            $('.variant_childs_container').empty();
            $('#variant-table-body').empty();
            $('#variant-table').addClass('d-none');

            $.ajax({
                type: "GET",
                url: "{{ route('variant.data') }}",
                data: {
                    ids: ids
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        var container = $('.variant_childs_container');
                        container.empty(); // Clear previous variants

                        response.data.forEach(function(variantParent) {
                            var variantName = variantParent.variant_name[0].toUpperCase() +
                                variantParent.variant_name.slice(1),
                                html = '';
                            html +=
                                `
                             <div class="col-12 col-md-12 mb-1">
                            <label class="form-label" for="${variantName}">${variantName} variants</label>
                            <select name="" id="${variantName}" class="form-control form-select select2 variants_childs"
                            data-pid="${variantParent.id}" data-pname="${variantName}" multiple>`
                            variantParent.children.forEach(function(variantChild) {
                                var ChildName = variantChild
                                    .variant_name[0].toUpperCase() +
                                    variantChild.variant_name.slice(1);
                                html +=
                                    `<option value="${variantChild.id}">${ChildName}</option>`;
                            });
                            html += `
                            </select>
                        </div>`;

                            container.append(html);
                        });

                        // Reinitialize the select2 for the new elements
                        $('.select2').select2({
                            minimumResultsForSearch: 0,
                            placeholder: 'Select',
                        });
                    } else {
                        toastr.error('👋 ' + response.message, 'Somthing Wrong!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                },
                error: function(error) {
                    console.log('error :: ', error?.status, error?.statusText)

                    toastr.error('Variant not found👋',
                        'Somthing Wrong!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }
            });
        });
        // end

        // Show Variantsn Container list script

        $(document).on('change', '.variants_childs', function() {
            $('#variant-table-body').empty();
            variantContainer();
        });


        function variantContainer() {
            const variant_array = [];
            $('.variants_childs').each(function() {

                $(this).find('option:selected').each(function() {
                    variant_array.push({
                        id: $(this).val(),
                        name: $(this).text(),
                        parent_id: $(this).closest('select').data('pid'),
                        parent_name: $(this).closest('select').data('pname'),
                    });
                });
            });

            // Group by parent_id
            const groups = {};
            variant_array.forEach(item => {
                if (!groups[item.parent_id]) groups[item.parent_id] = [];
                groups[item.parent_id].push(item);
            });

            // Sort parent_ids
            const sortedParentIds = Object.keys(groups).sort((a, b) => a - b);

            // Prepare array of arrays to perform cartesian product
            const groupArrays = sortedParentIds.map(pid => groups[pid]);

            // Cartesian product
            function cartesian(arrays) {
                return arrays.reduce((acc, curr) => {
                    const res = [];
                    acc.forEach(a => {
                        curr.forEach(b => {
                            res.push(a.concat([b]));
                        });
                    });
                    return res;
                }, [
                    []
                ]);
            }

            const combinations = cartesian(groupArrays);
            var html = '',
                images_html = '',
                variant_body = $('#variant-table-body'),
                images_container = $('#variantsimages_container');

            const product_mrp = parseFloat($('#product_mrp').val()) || 0,
                product_discount = parseFloat($('#product_discount').val()) || 0,
                product_price = parseFloat($('#product_price').val()) || 0;



            variant_body.empty();
            images_container.empty();
            if (combinations.length !== 0) {
                $("#variant-table").removeClass('d-none');
                // $("#add_variants_img").removeClass('d-none');
            }

            combinations.forEach((combo, index) => {
                const combinationName = combo.map(c => c.name).join(',');
                const combinationIds = combo.map(c => c.id).join(",");

                images_html += `<div class="col-md-12 col-12 mb-1">
                                        <label for="${index}product_variant_images"
                                            class="form-label
                                            ">Product
                                            Variants(${combinationName}) Images</label>
                                        <input type="file" name="variants[${index}][product_variant_images][]" id="${index}product_variant_images"
                                            class="form-control variant_images" data-imgindex="${index}"
                                            accept=".png,.jpg,.jpeg,.webp" multiple>
                                            <div class="d-flex flex-wrap" id="variantimg-preview-${index}">

                                            </div>
                                    </div>`;

                html += `
                    <tr>
                            <td>${combinationName}

                               <input type="hidden" class="form-control form-control-sm" id="${index}id" name="variants[${index}][id]"
                                     value="0">
                               <input type="hidden" class="form-control form-control-sm" id="${index}variant_combination" name="variants[${index}][variant_combination]"
                                     value="${combinationName}">
                               <input type="hidden" class="form-control form-control-sm" id="${index}variant_ids" name="variants[${index}][variant_ids]"
                                     value='${combinationIds}'>
                                     </td>
                                     <td class="p-1">
                                        <a href="#" class=" open-my-model"  mymodel="ImagesModel"
                                         data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Open Image Modal">
                                            <i data-feather="image" style="width: 18px; height: 18px;"></i>
                                            </a></td>
                            <td><input type="text" class="form-control form-control-sm" id="${index}product_variant_skucode" name="variants[${index}][product_variant_skucode]"
                                    placeholder="SKU Code"></td>
                            <td><input type="text" class="form-control form-control-sm variant_mrp" id="${index}product_variant_mrp" name="variants[${index}][product_variant_mrp]"
                                    placeholder="MRP(₹)" value="${product_mrp}"></td>
                            <td><input type="text" class="form-control form-control-sm variant_price" id="${index}product_variant_price" name="variants[${index}][product_variant_price]"
                                    placeholder="Price(₹)" value="${product_price}"></td>
                            <td><input type="text" class="form-control form-control-sm variant_discount" id="${index}product_variant_discount" name="variants[${index}][product_variant_discount]"
                                    placeholder="Discount(%)" value="${product_discount}"></td>
                            <td><input type="number" class="form-control form-control-sm" name="variants[${index}][product_variant_stock]" id="${index}product_variant_stock"
                                    placeholder="Stock" min="0" step="1"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"></td>
                            <td><input type="text" class="form-control form-control-sm" id="${index}product_variant_youtube_link" name="variants[${index}][product_variant_youtube_link]"
                                    placeholder="Youtube Link"></td>
                        </tr>`;
            });

            variant_body.html(html);
            images_container.html(images_html);
            if (variant_array.length === 0) {

                $('#variant-table-body').empty();
                $('#variant-table').addClass('d-none');
            }
            feather.replace();
            variant_body.find('[data-bs-toggle="tooltip"]').tooltip();
        }

        $(document).on('click', '.open-my-model', function(e) {
            e.preventDefault();

            let modelId = $(this).attr('mymodel');

            if (modelId) {
                $('#' + modelId).modal('show');
            }
        });

        $(document).on('change', '.variant_images', function(e) {
            var imgindex = $(this).data('imgindex');
            selectedFiles = [...e.target.files];
            variantimgPreviews(imgindex);
        });



        function variantimgPreviews(imgindex) {
            const isedit = "{{ $product?->id ? true : false }}",
                preview_container = $('#variantimg-preview-' + imgindex);


            $('#variantimg-preview-' + imgindex + ' .image-container').filter(function() {
                return !$(this).attr('data-pid');
            }).remove();

            selectedFiles.forEach((file, i) => {
                const r = new FileReader();
                r.onload = e => {
                    const $box = $(`
                <div class="image-container position-relative m-2" data-i="${i}">
                    <div class="mb-2">
                        <input type="radio" name="variants[${imgindex}][product_variant_thumbnail_image]" value="${file.name}" id="${imgindex}${i}${file.name}main_image" class="main-image-radio" ${!isedit && i === 0 ? 'checked' : ''}>
                        <label for="${imgindex}${i}${file.name}main_image">Main Image</label>
                    </div>
                    <a href="${e.target.result}" data-lightbox="Product Image${i}" data-title="Product Image preview" >
                    <img src="${e.target.result}" class="rounded preview_variant_image" alt="${file.name}">
                    </a>
                    <button type="button" class="btn btn-danger btn-sm remove_variant_image delete_image" data-id="" data-image=""  data-variant_id="">Remove</button>
                </div>
            `);
                    preview_container.append($box);
                };
                r.readAsDataURL(file);
            });

            setTimeout(() => {
                if (!$('.main-image-radio:checked').length && selectedFiles.length)
                    $('.main-image-radio').first().prop('checked', true);
            }, 50);
        }
        // End
    </script>
    {{-- end her --}}


    {{-- Product Variants Mrp , Price , Discount script --}}
    <script>
        $(function() {
            $('#variant-table').on('input', '.variant_mrp, .variant_discount, .variant_price', function() {
                const $tr = $(this).closest('tr'),
                    $m = $tr.find('.variant_mrp'),
                    $d = $tr.find('.variant_discount'),
                    $p = $tr.find('.variant_price');

                [$m, $d, $p].forEach($el => $el.val($el.val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g,
                    '$1')));

                const m = +$m.val() || 0,
                    d = Math.min(+$d.val() || 0, 100),
                    p = +$p.val() || 0;

                if ($(this).hasClass('variant_discount')) return $p.val(m ? (m - m * d / 100).toFixed(2) :
                    '');
                if ($(this).hasClass('variant_price')) {
                    if (p > m) return alert("Price > MRP"), $p.val(''), $d.val('');
                    return $d.val(m ? ((m - p) / m * 100).toFixed(2) : '');
                }
                // If MRP changed
                $d.val() ? $p.val(m ? (m - m * d / 100).toFixed(2) : '') :
                    $p.val() && (p > m ? (alert("Price > MRP"), $p.val(''), $d.val('')) : $d.val(m ? ((m -
                        p) / m * 100).toFixed(2) : ''));
            });
        });
    </script>
    {{-- End Here --}}

@endsection
