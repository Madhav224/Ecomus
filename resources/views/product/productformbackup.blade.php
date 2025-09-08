@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', 'Product Form')

@section('vendor-style')


@endsection
<style>
    .mb-7 {
        margin-bottom: 75px;
    }


    .table-responsive-variant {
    overflow-x: auto;
    width: 100%;
}

.table-variant {
    border-collapse: collapse;
    min-width: 1200px; /* Adjust based on content */
}

.table-variant th, .table-variant td {
    padding: 10px;
    white-space: nowrap;
    border: 1px solid #ddd;
}

.table-variant th {
    background-color: #f9f9f9;
    font-weight: bold;
}

.table-variant td:first-child,
.table-variant th:first-child,
.table-variant td:nth-child(2),
.table-variant th:nth-child(2) {
    position: sticky;
    left: 0;
    background: #fff;
    z-index: 2;
}

.table-variant td:nth-child(2),
.table-variant th:nth-child(2) {
    left: 150px; /* Width of first column */
    z-index: 2;
}

.table-variant td:first-child,
.table-variant th:first-child {
    min-width: 150px;
    z-index: 3;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.image-preview-container {
    display: flex;
    align-items: center;
    gap: 8px;
}
    </style>

@section('content')

    {{-- @dd($product_category); --}}
    <form action="">
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
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
         <div class="col-md-10">
            <div class="row">
               <input type="text" name="id" id="id" hidden>
               <div class="form-group col-md-6 col-12 ">
                  <label for="product_name" class="form-label">Product Name</label>
                  <input type="text" name="product_name" id="product_name" class="form-control"
                     placeholder="Enter Product name">
               </div>
               <div class="form-group col-md-6 col-12 ">
                  <label for="product_slug" class="form-label">Product Slug</label>
                  <input type="text" name="product_slug" id="product_slug" class="form-control"
                     placeholder="Enter Product slug">
               </div>
               <div class="form-group col-md-6 col-12 mt-1">
                  <label for="product_sku_code" class="form-label">Product SKU code</label>
                  <input type="text" name="product_sku_code" id="product_sku_code" class="form-control"
                     placeholder="Enter Product sku code">
               </div>
               <div class="form-group col-md-6 col-12 mt-1">
                  <label for="product_category" class="form-label">Product Category</label>
                  <select name="product_categorie_id[]" id="product_categorie_id" class="form-control select2"
                     multiple="multiple">
                     @foreach ($product_category as $category)
                     <option value="{{ $category->id }}">{{ $category->categorie_name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
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
         <div class="col-md-10">
            <div class="row">
               <div class="form-group col-md-12 col-12 mb-7">
                  <label for="product_description" class="form-label">Short Description</label>
                  <textarea name="product_short_description" id="product_short_description" class="form-control"
                     placeholder="Enter Short Description" rows="4"></textarea>
               </div>
               <div class="form-group col-md-12 col-12 mt-1 mb-7">
                  <label for="product_description" class="form-label">Long Description</label>
                  <textarea name="product_long_description" id="product_long_description" class="form-control quill-editor"
                     placeholder="Enter Long Description" rows="4"></textarea>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
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
         <div class="col-md-10">
            <div class="row">
               <label for=""><b>Product Details</b></label>
               <div class="repetor border rounded p-2">
                  <div class="repetor_container">
                     <div class="row">
                        <div class="form-group col-md-5 col-12">
                           <label for="product_name" class="form-label">Title</label>
                           <input type="text" name="title" class="form-control" placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-5 col-12">
                           <label for="product_name" class="form-label">Value</label>
                           <input type="text" name="value" class="form-control"
                              placeholder="Enter Value">
                        </div>
                        <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                           <button class="btn btn-primary btn-sm add_more" type="button">
                           <i data-feather="plus"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
               <label class="mt-1"><b>Product Additional Details</b></label>
               <div class="repetor border  rounded p-2">
                  <div class="repetor_container">
                     <div class="row">
                        <div class="form-group col-md-5 col-12">
                           <label for="product_name" class="form-label">Title</label>
                           <input type="text" name="aditional_title" class="form-control"
                              placeholder="Enter title">
                        </div>
                        <div class="form-group col-md-5 col-12">
                           <label for="product_name" class="form-label">Value</label>
                           <input type="text" name="aditional_value" class="form-control"
                              placeholder="Enter Value">
                        </div>
                        <div class="form-group col-md-2 col-12 mt-2 d-flex justify-content-center">
                           <button class="btn btn-primary btn-sm add_more" type="button">
                           <i data-feather="plus"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
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
         <div class="col-md-10">
            <div class="row">
               <div class="form-group col-md-6 col-12 ">
                  <label for="product_slug" class="form-label">Product Images</label>
                  <input type="file" name="product_images[]" id="product_images" class="form-control"
                     placeholder="Enter Product Images" accept="image/*" multiple>
               </div>
            </div>
            <div class="row" id="image-preview-container">
               <!-- Image previews will appear here -->
            </div>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
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
         <div class="col-md-10">
            <div class="row">
               <!-- MRP Field -->
               <div class="form-group col-md-4 col-12">
                  <label for="product_mrp" class="form-label">MRP<span class="text-danger">*</span></label>
                  <div class="input-group">
                     <span class="input-group-text"><b>₹</b></span>
                     <input type="number" name="product_mrp" id="product_mrp" class="form-control"
                        placeholder="Enter MRP">
                  </div>
               </div>
               <!-- Price Field -->
               <div class="form-group col-md-4 col-12">
                  <label for="product_price" class="form-label">Price<span class="text-danger">*</span></label>
                  <div class="input-group">
                     <span class="input-group-text"><b>₹</b></span>
                     <input type="text" name="product_price" id="product_price" class="form-control"
                        placeholder="Enter Price">
                  </div>
               </div>
               <!-- Discount Field -->
               <div class="form-group col-md-4 col-12">
                  <label for="product_discount" class="form-label">Discount<span
                     class="text-danger">*</span></label>
                  <div class="input-group">
                     <span class="input-group-text"><b>%</b></span>
                     <input type="number" name="product_discount" id="product_discount" class="form-control"
                        placeholder="Enter Discount" value="0">
                  </div>
               </div>
               <div class="form-group col-md-4 col-12 mt-1">
                  <label for="product_discount" class="form-label">Stock<span
                     class="text-danger">*</span></label>
                  <div class="input-group">
                     <input type="number" name="product_stock" id="product_stock" class="form-control"
                        placeholder="Enter Stock">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card p-3">
      <div class="row">
         <div class="col-md-2">
            <div class="d-flex align-items-center">
               <div class="me-1 border p-1 bg-light-primary rounded">
                  <i data-feather="box" style="width: 22px; height: 22px;"></i>
               </div>
               <div>
                  <h6 class="m-0">Variants</h6>
                  <p class="m-0" style="font-size: small; line-height: normal;">Add Variants</p>
               </div>
            </div>
         </div>
       
         <div class="col-md-10 repetor_container">
            <div class="row align-items-end mb-2">
               <div class="form-group col-md-5 col-12">
                  <label class="form-label">Variants</label>
                  <select name="variant_parent_id[]" id="product_variant_id"
                     class="form-control select2 variant-parent" multiple>
                     @foreach ($variants as $variant)
                     <option value="{{ $variant->id }}">{{ $variant->variant_name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="form-group" id="variant-container">
               <div id="combinations-container" class="gap-2 mt-2">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12 col-md-12 text-end">
      <button type="submit" class="btn btn-primary text-capitalize" id="saveBtn">Save Product</button>
   </div>
</form>

<div class="modal fade" id="image-upload-modal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload Variant Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="file" id="modal-image-input" accept="image/*" multiple class="form-control">
        <div class="row mt-3" id="modal-image-preview-container"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-images-btn">Save Images</button>
      </div>
    </div>
  </div>
</div>


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
        const product = @json($product);
        const productvariants = @json($productvariants);
        const isedit = @json($isedit);
    </script>
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
                minimumResultsForSearch: 0,
                placeholder: 'Select',
            });

            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });

        });

        var quill = new Quill('#product_short_description', {
            modules: {
                formula: true,
                syntax: true,
                toolbar: [
                    [{
                            font: []
                        },
                        {
                            size: []
                        }
                    ],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: 'super'
                        },
                        {
                            script: 'sub'
                        }
                    ],
                    [{
                            header: '1'
                        },
                        {
                            header: '2'
                        },
                        'blockquote',
                        'code-block'
                    ],
                    [{
                            list: 'ordered'
                        },
                        {
                            list: 'bullet'
                        },
                        {
                            indent: '-1'
                        },
                        {
                            indent: '+1'
                        }
                    ],
                    [
                        'direction',
                        {
                            align: []
                        }
                    ],
                    ['link', 'formula'],
                    ['clean']
                ]
            },
            theme: 'snow'
        });

        var quill = new Quill('#product_long_description', {
            modules: {
                formula: true,
                syntax: true,
                toolbar: [
                    [{
                            font: []
                        },
                        {
                            size: []
                        }
                    ],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                            color: []
                        },
                        {
                            background: []
                        }
                    ],
                    [{
                            script: 'super'
                        },
                        {
                            script: 'sub'
                        }
                    ],
                    [{
                            header: '1'
                        },
                        {
                            header: '2'
                        },
                        'blockquote',
                        'code-block'
                    ],
                    [{
                            list: 'ordered'
                        },
                        {
                            list: 'bullet'
                        },
                        {
                            indent: '-1'
                        },
                        {
                            indent: '+1'
                        }
                    ],
                    [
                        'direction',
                        {
                            align: []
                        }
                    ],
                    ['link', 'formula'],
                    ['clean']
                ]
            },
            theme: 'snow'
        });


        // Add Repeater Query
        $(document).on('click', '.add_more', function() {
            var this_btn = $(this),
                parent_div = $(this_btn).closest('.row'),
                repeater_input = $(this_btn).closest('.repetor_container').find('.row:first').clone();

            $(repeater_input).find('input').val('');

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


        $(document).ready(function() {
            let selectedFiles = [];

            $('#product_images').on('change', function(event) {
                selectedFiles = Array.from(event.target.files);
                refreshImagePreviews(); // Centralized function handles everything
            });


            function refreshImagePreviews() {
                const $container = $('#image-preview-container');

                // Count existing image boxes to start indexing correctly
                let existingCount = $container.find('.image-container').length;

                console.log("existingCount",existingCount);

                if (!isedit) {
                    $container.empty();
                    existingCount = 0; // Reset index if not in edit mode
                }

                $.each(selectedFiles, function(index, file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const dataIndex = existingCount + index;
                        const $img = $('<img>', {
                            src: e.target.result,
                            alt: 'Product Image',
                            css: {
                                width: '100%',
                                height: 'auto',
                                objectFit: 'cover'
                            }
                        });

                        const $imageBox = $('<div>', {
                            class: 'image-container col-md-3 col-sm-4 col-6 position-relative m-2',
                            'data-index': dataIndex
                        });

                        // Radio Input for main image
                        const $radioWrapper = $('<div class="mb-2">');
                        const $radioInput = $('<input>', {
                            type: 'radio',
                            name: 'main_image',
                            value: dataIndex,
                            class: 'main-image-radio',
                            checked: (existingCount + index === 0 && !
                                isedit) // only select if first image and not editing
                        });
                        const $radioLabel = $('<label>').text(' Main Image');

                        $radioWrapper.append($radioInput, $radioLabel);
                        $imageBox.append($radioWrapper, $img);

                        // Remove button
                        const $removeButton = $('<button>', {
                            type: 'button',
                            class: 'btn btn-danger btn-sm position-absolute bottom-0 start-50 translate-middle-x',
                            text: 'Remove'
                        });

                        $removeButton.on('click', function() {
                            const removeIndex = parseInt($imageBox.attr('data-index'));
                            // Remove from selectedFiles using relative index
                            const relativeIndex = dataIndex - existingCount;
                            selectedFiles.splice(relativeIndex, 1);

                            const dt = new DataTransfer();
                            selectedFiles.forEach(f => dt.items.add(f));
                            $('#product_images')[0].files = dt.files;

                            refreshImagePreviews(); // Re-render
                        });

                        $imageBox.append($removeButton);
                        $container.append($imageBox);
                    };

                    reader.readAsDataURL(file);
                });
            }

            let variantSelectedFiles = {}; // Store selected files per variant

            $(document).on('change', 'input[type="file"][id^="product_variant_images_"]', function(event) {

                const inputId = $(this).attr('id');
                const index = inputId.split('_').pop(); // Get variant index
                const files = Array.from(event.target.files);


                variantSelectedFiles[index] = files;

                refreshVariantPreviews(index);
            });

            function refreshVariantPreviews(index) {
                const $container = $(`#variant-preview-container-${index}`);

                // Only clear container if it's not edit mode
                if (isedit == false) {
                    $container.empty();
                }

                const files = variantSelectedFiles[index];
                console.log("files",files);
                if (!files) return;

                $container.find('.image-container[data-existing!="true"]').remove();
                // Get how many images already exist (only matters in edit mode)
               // let existingCount = $container.find('.image-container').length;
               let existingCount = $container.find('.image-container[data-existing="true"]').length;
               console.log("existingCount",existingCount);

                files.forEach((file, i) => {
                    const dataIndex = existingCount + i;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const $img = $('<img>', {
                            src: e.target.result,
                            alt: 'Variant Image',
                            class: 'img-fluid rounded',
                            style: 'height: auto; width: 100%; object-fit: cover;'
                        });

                        const $box = $('<div>', {
                            class: 'image-container col-md-3 col-sm-4 col-6 position-relative m-2',
                            'data-existing': 'false', 
                            'data-index': dataIndex
                        });

                        const $radioWrapper = $('<div class="mb-2 text-start">');
                        const $radio = $('<input>', {
                            type: 'radio',
                            name: `main_variant_image_${index}`,
                            value: dataIndex,
                              checked: dataIndex === 0 // Only check the first one if needed
                            
                        });
                        const $label = $('<label>').text(' Main Image');
                        $radioWrapper.append($radio, $label);
                        $box.append($radioWrapper, $img);

                        const $removeBtn = $('<button>', {
                            type: 'button',
                            class: 'btn btn-danger btn-sm position-absolute bottom-0 start-50 translate-middle-x mt-1',
                            text: 'Remove'
                        });

                        $removeBtn.on('click', function() {
                            const removeIndex = parseInt($box.attr('data-index'));

                            // Remove preview box
                            $box.remove();

                            // Also remove from variantSelectedFiles
                            variantSelectedFiles[index].splice(removeIndex - existingCount, 1);

                            // Rebuild FileList
                            const dt = new DataTransfer();
                            variantSelectedFiles[index].forEach(f => dt.items.add(f));
                            $(`#product_variant_images_${index}`)[0].files = dt.files;

                            // Refresh preview after removing
                            refreshVariantPreviews(index);
                        });

                        $box.append($removeBtn);
                        $container.append($box);
                    };
                    reader.readAsDataURL(file);
                });
            }

            // Submit logic
            $('form').on('submit', function(event) {
                event.preventDefault();
                $('#saveBtn').prop("disabled", true);

                let details = {};
                let additionalDetails = {};

                // Extract details
                $('.repetor').eq(0).find('.repetor_container .row').each(function() {
                    let title = $(this).find('input[name="title"]').val().trim();
                    let value = $(this).find('input[name="value"]').val().trim();
                    if (title && value) details[title] = value;
                });

                $('.repetor').eq(1).find('.repetor_container .row').each(function() {
                    let title = $(this).find('input[name="aditional_title"]').val().trim();
                    let value = $(this).find('input[name="aditional_value"]').val().trim();
                    if (title && value) additionalDetails[title] = value;
                });

                 const mainImageIndex = $('input[name="main_image"]:checked').val();
                console.log("mainImageIndex",mainImageIndex);

                
                const formData = new FormData(this);

               


                selectedFiles.forEach(file => formData.append('product_images[]', file));
                formData.append('main_image_index', mainImageIndex);
                formData.append('details', JSON.stringify(details));
                formData.append('additional_details', JSON.stringify(additionalDetails));

                let variantIDs = [];

 
             
              
                $('#variant-table-body tr').each(function(index) {
                const row = $(this);


                const images = imageDataByIndex[index] || [];
                    console.log("imageesss for index", index, images);

                    images.forEach((img, i) => {
                        formData.append(`variants[${index}][images][${i}]`, img.file);
                        if (img.isThumbnail) {
                            formData.append(`variants[${index}][thumbnail_index]`, i);
                        }
                    });
              
                formData.append(`variants[${index}][combination]`, row.find('td').eq(0).text().trim());
                formData.append(`variants[${index}][ids]`, row.find('input[name^="variant_ids[' + index + ']"]').val());
                formData.append(`variants[${index}][mrp]`, row.find('input[name^="product_variant_mrp"]').val());
                formData.append(`variants[${index}][price]`, row.find('input[name^="product_variant_price"]').val());
                formData.append(`variants[${index}][discount]`, row.find('input[name^="product_variant_discount"]').val());
                formData.append(`variants[${index}][stock]`, row.find('input[name^="product_variant_stock"]').val());
                formData.append(`variants[${index}][sku]`, row.find('input[name^="product_variant_skucode"]').val());
                formData.append(`variants[${index}][youtube]`, row.find('input[name^="product_variant_youtube_link"]').val());

                const variantID = row.find(`input[name="variant_id[${index}]"]`).val();
                if (variantID) {
                    formData.append(`variants[${index}][id]`, variantID);
                }

                
               
            });
                console.log("formData",formData);


                for (let pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]);
                }


                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.success(response.Message, 'Success');
                        window.location.href = '/ecommerce_panel/product';
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('#saveBtn').prop("disabled", false);
                            $('.text-danger').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            $.each(errors, function(key, value) {
                                let input = $('[name="' + key + '"]');
                                if (!input.length) input = $('[name="' + key + '[]"]');
                                input.addClass('is-invalid');
                                if (!input.next('.text-danger').length) {
                                    input.after('<span class="text-danger">' + value[
                                        0] + '</span>');
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>


    <script>
        const mrpInput = document.getElementById('product_mrp');
        const discountInput = document.getElementById('product_discount');
        const priceInput = document.getElementById('product_price');

        function calculateFromMRPAndDiscount() {
            const mrp = parseFloat(mrpInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;

            if (discount > 100) {
                discountInput.value = 100;
                return;
            }

            const price = mrp - (mrp * (discount / 100));
            priceInput.value = price.toFixed(2);
        }

        function calculateFromMRPAndPrice() {
            const mrp = parseFloat(mrpInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;

            if (price > mrp) {
                alert("Price cannot be more than MRP");
                priceInput.value = "";
                return;
            }

            const discount = ((mrp - price) / mrp) * 100;
            discountInput.value = discount.toFixed(2);
        }

        mrpInput.addEventListener('input', () => {
            if (discountInput.value !== "") {
                calculateFromMRPAndDiscount();
            } else if (priceInput.value !== "") {
                calculateFromMRPAndPrice();
            }
        });

        discountInput.addEventListener('input', calculateFromMRPAndDiscount);
        priceInput.addEventListener('input', calculateFromMRPAndPrice);
    </script>



    <script>

$(document).on('click', '.remove-variant', function() {
    const variantId = $(this).data('variant');
    // Remove the corresponding div using the variantId
    $(`#variant-${variantId}`).remove();
});

let imageDataByIndex = {}; // Store uploaded images per variant
let selectedVariantIndex = null;
function openImageModal(index) {
    selectedVariantIndex = index;
    $('#modal-image-preview-container').empty();

    const images = imageDataByIndex[index] || [];

    console.log(images);

        // Loop through the images and create the necessary HTML for each image
    images.forEach((imageObj, i) => {
        const { path, isThumbnail } = imageObj;

        const imagePreview = `
            <div class="image-container col-md-3 col-sm-4 col-6 position-relative m-2" data-index="${i}">
                <img src="${path}" class="img-thumbnail" style="width: 100%; height: auto; object-fit: cover;" />
                <div class="form-check mt-2">
                    <input class="form-check-input main-image-radio" type="radio" name="main_image_${selectedVariantIndex}" value="${i}" ${isThumbnail ? 'checked' : ''}>
                    <label class="form-check-label">Main Image</label>
                </div>
            </div>`;
        
        $('#modal-image-preview-container').append(imagePreview);
    });

    $('#image-upload-modal').modal('show');
}

$(document).on('change', 'input[name="main_image"]', function() {
    const selectedIndex = $(this).val();

    const variantIndex = selectedVariantIndex;

            imageDataByIndex[variantIndex].forEach((imageObj, i) => {
                imageObj.isThumbnail = (i == selectedIndex);
            });

    console.log('Updated image data:', imageDataByIndex[selectedVariantIndex]);
});

$('#modal-image-input').on('change', function () {
    const files = Array.from(this.files);
    const imagePreviewContainer = $('#modal-image-preview-container');

    // Store File objects directly
    imageDataByIndex[selectedVariantIndex] = files.map((file, i) => ({
        file: file,
        path: URL.createObjectURL(file), // For preview only
        isThumbnail: i === 0
    }));

    // Clear previous previews
    imagePreviewContainer.empty();

  
    imageDataByIndex[selectedVariantIndex].forEach((imgObj, i) => {
        imagePreviewContainer.append(`
            <div class="image-container col-md-3 col-sm-4 col-6 position-relative m-2" data-index="${i}">
                <img src="${imgObj.path}" class="img-thumbnail" style="width: 100%; height: auto;">
                <div class="mb-2 text-start">
                    <input type="radio" name="main_image" value="${i}" ${imgObj.isThumbnail ? 'checked' : ''}>
                    <label> Main Image</label>
                </div>
            </div>
        `);
    });
    // Update preview and count
    const thumb = imageDataByIndex[selectedVariantIndex].find(img => img.isThumbnail);
    $('#main-image-preview-' + selectedVariantIndex).attr('src', thumb?.path || '').show();
    $('#image-count-badge-' + selectedVariantIndex).text(files.length);
});


// Save images functionality (you can extend this to handle server-side upload)
$('#save-images-btn').click(function () {
    const selected = $('input[name="main_image"]:checked').val();
    const images = imageDataByIndex[selectedVariantIndex] || [];

    images.forEach((img, i) => {
        img.isThumbnail = (parseInt(selected) === i);
    });
    // Reflect thumbnail in table
    const thumbnailImage = images.find(img => img.isThumbnail)?.path || '';
    $(`#main-image-preview-${selectedVariantIndex}`)
        .attr('src', thumbnailImage)
        .show();
    $(`#image-count-badge-${selectedVariantIndex}`).text(images.length);

    $('#image-upload-modal').modal('hide');
});
        $('#product_variant_id').change(function(e) {
            e.preventDefault();
            var id = $(this).val();
            let existingSelectedValues = [];
            $.ajax({
                type: "GET",
                 url: "{{ route('variant.data') }}",              
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        $('#variant-container').removeClass('d-none');
                        const total = id.length;
                        console.log("total",total);
                        const data = response.data;
                        console.log("data",data);
                        const entries = Object.entries(data).filter(([key, val]) => Object.keys(val)
                            .length > 0);
                        const keys = entries.map(([key]) => key);
                        const values = entries.map(([_, val]) => Object.entries(val));
                        console.log("values",values);
                        const combinations = getCombinations(values);

                        console.log("combinations",combinations);

                        let dropdowns = '';
                        Object.entries(data).forEach(([variant, values]) => {
                          
                            dropdowns += `
                                <div class="form-group row col-md-12 col-12" id="variant-${variant}">
                                    <div class="col-md-2 col-12">
                                        <label class="form-label" style="color:black; font-size: 18px; font-weight: bold;">${variant}</label>
                                    </div>
                                    <div class="col-md-10 col-12 d-flex">
                                        <select name="variant_${variant}[]" class="form-control select2" multiple>
                                            ${Object.entries(values).map(([id, label]) => {
                                                
                                                        return `
                                                            <option value="${id}" selected>${label}</option>
                        
                                                `;
                                            }).join('')}
                                        </select>
                                           <button type="button" class="btn btn-danger btn-sm remove-variant mx-2" data-variant="${variant}">X</button>
                                        <div id="selected-${variant}" class="selected-values mt-2"></div>
                                      
                                    </div>
                                </div>
                            `;
                        });



                        let tableHeader = `
                            <div class="table-responsive-variant">
                            <table class="table table-variant">
                                <thead>
                                    <tr>
                                        <th>Variants</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Stock</th>
                                        <th>SKU</th>
                                        <th>YouTube</th>                                     
                                    </tr>
                                </thead>
                                <tbody id="variant-table-body">
                                </tbody>
                            </table>
                            </div>
                        `;

                        $('#combinations-container').html(dropdowns + tableHeader);
                        $('.select2').select2();
                        let $tbody = $('#variant-table-body');               

                        const isEdit = isedit;

                        const existingRows = {};
                        $('#variant-table-body tr').each(function () {
                            const key = $(this).find('td:first').text().trim().replace(/\s+/g, '').toLowerCase();
                            existingRows[key] = $(this).clone();
                        });

                        $tbody.empty(); // Clear
                        combinations.forEach((combination, index) => {
                        let combinationdata = combination.map(([_, val]) => val).join('_');
                        let row = '<tr>';
                        let combinationString = combination.map(([id, val]) => val).join(' / ');
                        let combinationIds = combination.map(([id, val]) => id); 
                        console.log("fdf",combinationIds);
                        let normalized = str => str.replace(/\s+/g, '').toLowerCase();
                        let existingVariant = productvariants.find(v => 
                            normalized(v.variant_combination) === normalized(combinationdata)
                        );

                        let variantID = '';
                        let mrpInputvalue = '';
                        let discountInputvalue = '';
                        let priceInputvalue = '';
                        let stockInputvalue = '';
                        let skucode = '';
                        let youtubeLink = '';
                        let imagePaths = [];
                        let thumbnailImage = '';

                        if (isEdit && existingVariant) {
                            variantID = existingVariant.id || '';
                            mrpInputvalue = existingVariant.product_variant_mrp || '';
                           
                            discountInputvalue = existingVariant.product_variant_discount || '';
                            priceInputvalue = existingVariant.product_variant_price || '';
                            stockInputvalue = existingVariant.product_variant_stock || '';
                            skucode = existingVariant.product_variant_skucode || '';
                            youtubeLink = existingVariant.product_variant_youtube_link || '';

                            try {
                                imagePaths = JSON.parse(existingVariant.product_variant_images || '[]');
                            } catch (e) {
                                imagePaths = [];
                            }
                            thumbnailImage = existingVariant.product_variant_thumbnail_image || '';

                           
                            imageDataByIndex[index] = imagePaths.map(imgPath => ({
                                path: `/ecommerce_panel/${imgPath}`,
                                isThumbnail: imgPath === thumbnailImage
                            }));
                        }

                        // Add the combined string to the row
                        row += `<td>${combinationString}
                          <input type="hidden" name="variant_ids[${index}][]" value='${JSON.stringify(combinationIds)}'>
                          <input type="text" name="variant_id[${index}]" value="${variantID}" hidden>
                          </td>`;
                        

                        // Image Upload
                        row += `
                                 <td>
                                    <div class="image-preview-container" onclick="openImageModal(${index})">
                                        <img src="/ecommerce_panel/${thumbnailImage}" class="main-image-preview" id="main-image-preview-${index}" 
                                            style="width: 50px; height: 50px; display: ${thumbnailImage ? 'inline-block' : 'none'}; cursor: pointer;" />
                                        <span class="badge badge-secondary" id="image-count-badge-${index}">${imagePaths.length}</span>
                                         <input type="text" name="variant_id[${index}]" value="${variantID}" hidden>
                                    </div>
                                </td>`;

                            row += `<td><input type="number" class="form-control variant-mrp" name="product_variant_mrp[${index}]" value="${mrpInputvalue}"></td>`;

                                // Price
                                row += `<td><input type="text" class="form-control variant-price" name="product_variant_price[${index}]" value="${priceInputvalue}"></td>`;

                                // Discount
                                row += `<td><input type="text" class="form-control variant-discount" name="product_variant_discount[${index}]" value="${discountInputvalue}"></td>`;

                                // Stock
                                row += `<td><input type="text" class="form-control" name="product_variant_stock[${index}]" value="${stockInputvalue}"></td>`;

                                // SKU
                                row += `<td><input type="text" class="form-control" name="product_variant_skucode[${index}]" value="${skucode}"></td>`;

                                // YouTube Link
                                row += `<td><input type="text" class="form-control" name="product_variant_youtube_link[${index}]" value="${youtubeLink}"></td>`;

                              

                        row += '</tr>';
                        $tbody.append(row);
                    });

                    }
                }
            });
        });

        function getCombinations(arrays, prefix = []) {
            if (!arrays.length) return [prefix];
            const [first, ...rest] = arrays;
            return first.flatMap(val => getCombinations(rest, [...prefix, val]));
        }

        // Price/MRP/Discount Autofill Logic
        $('#combinations-container').on('input', '.variant-mrp, .variant-discount, .variant-price', function() {
            const index = $(this).data('index');

            const $mrp = $(`.variant-mrp[data-index="${index}"]`);
            const $discount = $(`.variant-discount[data-index="${index}"]`);
            const $price = $(`.variant-price[data-index="${index}"]`);

            const mrp = parseFloat($mrp.val()) || 0;
            const discount = parseFloat($discount.val()) || 0;
            const price = parseFloat($price.val()) || 0;

            if ($(this).hasClass('variant-discount') || ($(this).hasClass('variant-mrp') && $discount.val() !==
                    "")) {

                if (discount > 100) {
                    $discount.val(100);
                    return;
                }
                const newPrice = mrp - (mrp * (discount / 100));
                $price.val(newPrice.toFixed(2));
            } else if ($(this).hasClass('variant-price') || ($(this).hasClass('variant-mrp') && $price.val() !==
                    "")) {

                if (price > mrp) {
                    alert("Price cannot be more than MRP");
                    return;
                }
                const newDiscount = ((mrp - price) / mrp) * 100;
                $discount.val(newDiscount.toFixed(2));
            }
        });
    </script>



    <script>
        if (product) {
            console.log(product);
            console.log(productvariants);
            $('#product_name').val(product.product_name ?? '');
            $('#id').val(product.id ?? '');
            $('#product_slug').val(product.product_slug ?? '');
            $('#product_sku_code').val(product.product_sku_code ?? '');
            $('#product_mrp').val(product.product_mrp ?? '');
            $('#product_price').val(product.product_price ?? '');
            $('#product_discount').val(product.product_discount ?? '');
            $('#product_stock').val(product.product_stock ?? '');
            $('#product_stock').val(product.product_stock ?? '');
            $('#product_stock').val(product.product_stock ?? '');
            $('#product_short_description').val(product.product_short_description ?? '');
            $('#product_long_description').val(product.product_long_description ?? '');

            let categoryIds = JSON.parse(product.product_categorie_id || '[]');
            $('#product_categorie_id').val(categoryIds).trigger('change');

            let variant_ids = JSON.parse(productvariants[0].variant_parent_id || '[]');
            $('#product_variant_id').val(variant_ids).trigger('change');

            const product_details = JSON.parse(product.product_details);
            const product_additional_details = JSON.parse(product.product_additional_details);

            function populateRepeater(containerSelector, data, titleName, valueName) {
                const container = $(containerSelector);
                let first = true;

                Object.entries(data).forEach(([key, value]) => {
                    let row;

                    if (first) {
                        row = container.find('.row:first');
                        first = false;
                    } else {
                        row = container.find('.row:first').clone();
                        row.find('input').val('');
                        row.find('.add_more').removeClass('add_more').addClass('remove-repeater').html(
                            '<i data-feather="x"></i>');
                        container.append(row);
                    }

                    row.find(`input[name="${titleName}"]`).val(key);
                    row.find(`input[name="${valueName}"]`).val(value);
                });

                feather.replace(); // for feather icons
            }

            $(document).ready(function() {
                let existingImages = JSON.parse(product.product_images.replace(/\\/g, ''));
                let existingThumbnail = product.product_thumbnail_image;

                populateRepeater(
                    '.repetor_container:eq(0)',
                    product_details,
                    'title',
                    'value'
                );

                populateRepeater(
                    '.repetor_container:eq(1)',
                    product_additional_details,
                    'aditional_title',
                    'aditional_value'
                );

                if (existingImages && existingImages.length > 0) {
                    renderImages();
                }

                function renderImages() {

                    $('#image-preview-container').empty();

                    existingImages.forEach((imgPath, index) => {
                        const $imageBox = $('<div>', {
                            class: 'image-container col-md-3 col-sm-4 col-6 position-relative m-2',
                            'data-index': index,
                            
                        });

                        const isThumbnail = imgPath === existingThumbnail;

                        const $radioWrapper = $('<div class="mb-2">');
                        const $radioInput = $('<input>', {
                            type: 'radio',
                            name: 'main_image',
                            value: index,
                            class: 'main-image-radio',
                            checked: isThumbnail
                        });
                        const $radioLabel = $('<label>').text(' Main Image');

                        $radioWrapper.append($radioInput, $radioLabel);

                        const $img = $('<img>', {
                            src: '/ecommerce_panel/' + imgPath,
                            alt: 'Product Image',
                            css: {
                                width: '100%',
                                height: 'auto',
                                objectFit: 'cover'
                            }
                        });

                        const $removeButton = $('<button>', {
                            type: 'button',
                            class: 'btn btn-danger btn-sm position-absolute bottom-0 start-50 translate-middle-x',
                            'data-id': product.id,
                            'data-image': imgPath,

                            text: 'Remove'
                        });

                        // $removeButton.on('click', function() {
                        //     const wasChecked = $radioInput.prop(
                        //         'checked');

                        //     existingImages.splice(index, 1);
                        //     if (wasChecked && existingImages.length > 0) {
                                
                        //         existingThumbnail = existingImages[0];
                        //     } else if (existingImages.length === 0) {
                        //         existingThumbnail = null;
                        //     }

                        //     renderImages(); 
                        // });

                        $removeButton.on('click', function () {
                            const image = $(this).data('image'); // assuming you store image path in `data-image`
                            const id = $(this).data('id');       // product ID
                            const $button = $(this);             // store reference to the button

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This image will be permanently removed!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                if (result.isConfirmed) { 
                                    $.ajax({
                                        url: '{{route("remove.image")}}', 
                                        method: 'POST',
                                        data: {
                                            _token: $('meta[name="csrf-token"]').attr('content'), 
                                            id: id,
                                            image: image
                                        },
                                        success: function (response) {
                                            if (response.status === 200) {
                                                toastr['success']('👋 ' + response.message + '!', ('Actions'), {
                                                        closeButton: true,
                                                        tapToDismiss: false
                                                    });
                                                // Remove image from DOM
                                                $button.closest('.image-container').remove();

                                              
                                                existingImages.splice(index, 1);

                                                if (wasChecked && existingImages.length > 0) {
                                                    existingThumbnail = existingImages[0];
                                                } else if (existingImages.length === 0) {
                                                    existingThumbnail = null;
                                                }

                                                renderImages(); // Refresh preview if needed
                                            }
                                        },
                                        error: function () {
                                            Toastr.error('Something went wrong while deleting the image.');
                                        }
                                    });
                                }
                            });
                        });


                        $imageBox.append($radioWrapper, $img, $removeButton);
                        $('#image-preview-container').append($imageBox);
                    });
                }


            });


        }
    </script>

   
@endsection
