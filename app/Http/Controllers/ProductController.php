<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Variant;
use App\Exports\BlogExport;
use App\Models\Categorie;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class ProductController extends Controller
{
    private $module_slug = 'products';
    #=====================================================================================================
    #Product list Function
    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);


        if ($request->ajax()) {
            $Data = Product::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'product name',
                'product slug',
                'product sku code',
                'categorie Names',
                'Brand Name',
                'product thumbnail image',
                'product mrp',
                'product price',
                'product discount',
                'product stock',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);


            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);

            $nhed = [];
            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('product_name', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);

            $tbody_data = $tbody->items();


            foreach ($tbody_data as $key => $data) {

                $image_url = $data->product_thumbnail_image_url;

                $actionButtons = '';

                $actionButtons .= $editpermission ?
                    '<a href="' . route('productform', ['slug' => $data->product_slug]) . '" class="avatar avatar-status bg-light-primary ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                            <span class="avatar-content">
                           <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                        </a>' : '';
                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger ms-25 delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'products/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';
                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check ms-25  form-switch form-check-primary d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('products') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';

                $tbody_data[$key] =
                    [
                        '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >'
                        ,
                        $actionButtons,
                        $data->product_name ?? '--',
                        $data->product_slug ?? '--',
                        $data->product_sku_code,
                        implode(',', $data->category_names) ?? '--',

                        $data->brand->brand_name ?? '--',

                        "<a href='$image_url' data-lightbox='$data->id' data-title='image preview' class='show_img_a'><img src='$image_url' class='rounded ' alt='image' style='width: 50px;height: 50px;'></a>",

                        $data->product_mrp ?? '--',
                        $data->product_price ?? '--',
                        $data->product_discount ?? '--',
                        $data->product_stock ?? '--',
                        $data->updated_at ?? '--',
                    ];

                if ($deletepermission == false && $statuspermission == false)
                    unset($tbody_data[$key][0]);


                if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                    unset($tbody_data[$key][1]);
            }

            // dd($tbody_data);

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Product list")],
        ];
        $file['title'] = ucwords("Product list");

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="' . route('productform') . '" class="btn btn-primary mb-1 open-my-model" mymodel="BlogModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    Product</a>'
            : '';

        $file['ProductDataFilterData'] = [
            'name' => 'blog',
            'action' => route('product.index'),
            'bulk_action_url' => 'products',
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];
        return view('product.product', $file);
    }
    #=====================================================================================================

    #=====================================================================================================
    #Product store(insert and update) Function
    public function store(Request $request)
    {
        $id = $request->input('id');

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name,' . $id,
            'product_slug' => 'nullable|unique:products,product_slug,' . $id,
            'product_sku_code' => 'nullable |unique:products,product_sku_code,' . $id,
            'product_brand_id' => 'nullable|exists:brands,id',
            'product_categorie_id' => 'required|array',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
            // 'product_details.*' => 'required',
            'product_additional_details.*' => 'nullable',
            'product_images.*' => 'required|image|mimes:jpg,jpeg,png,webp',
            'main_image' => 'nullable|integer',
            'product_mrp' => 'required|numeric|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
            'product_stock' => 'required|numeric|min:0',
            'frequently_bought' => 'nullable|array|max:2'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $product = Product::where('id', $id)->first();

        $product_images = $product?->product_images ?? [];
        $productThumbnailImage = $request->input('product_thumbnail_image') ?? $product?->product_thumbnail_image;


        $directory = public_path('upload/products');

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($request->hasFile('product_images')) {
            $multipleImages = $request->file('product_images');

            foreach ($multipleImages as $index => $image) {


                $filename = rand() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename);

                $relativePath = 'upload/products/' . $filename;
                $product_images[] = $relativePath;

                if ($image->getClientOriginalName() === $productThumbnailImage) {
                    $productThumbnailImage = $relativePath;
                }
            }
        }


        if ($productThumbnailImage == null && !empty($product_images)) {
            $productThumbnailImage = $product_images[0];
        }

        $product_details = $request->input('product_details',[]);

        $product_additional_details =
            array_combine(
                array_values($request->input('product_additional_details.title') ?? []),
                array_values($request->input('product_additional_details.value') ?? [])
            );

        $product_slug = Str::slug(trim($request->input('product_slug') ?? $request->input('product_name')));
        $product_sku_code = Str::slug(
            trim($request->input('product_sku_code')) ?: 'sku' . $product_slug . rand(1, 100000)
        );

        $product = Product::updateOrCreate(
            ['id' => $id],
            [
                'product_name' => $request->input('product_name', null),
                'product_slug' => $product_slug,
                'product_sku_code' => $product_sku_code,
                'product_categorie_id' => $request->input('product_categorie_id', null),
                'product_brand_id' => $request->input('product_brand_id', null),
                'product_short_description' => $request->input('product_short_description', null),
                'product_long_description' => $request->input('product_long_description', null),
                'product_details' => $product_details,
                'product_additional_details' => $product_additional_details,
                'product_thumbnail_image' => $productThumbnailImage ?? null,
                'product_images' => $product_images,
                'product_mrp' => $request->input('product_mrp'),
                'product_price' => $request->input('product_price'),
                'product_discount' => $request->input('product_discount'),
                'product_stock' => $request->input('product_stock'),
                'frequently_bought' => $request->input('frequently_bought', null),
            ]
        );


        if ($product && $request->variants) {
            $variants = $request->input('variants', []);
            $allProductVariants = [];

            foreach ($variants as $index => $variant) {
                $variant_id = $variant['id'] ?? 0;

                $ProductVariant = ProductVariant::where('id', $variant_id)->first();



                $variant_images = $ProductVariant?->product_variant_images ?? [];
                $variantThumbnailImage = $variant['product_variant_thumbnail_image'] ?? $ProductVariant?->product_variant_thumbnail_image;

                $variant_combination = explode(",", $variant['variant_combination']) ?? [];
                $variant_ids = explode(",", $variant['variant_ids']) ?? [];
                $variant_skucode = $variant['product_variant_skucode'] ?? 'sku' . rand(1, 100000);


                if ($request->file("variants.$index.product_variant_images")) {
                    $multipleImages = $request->file("variants.$index.product_variant_images");


                    foreach ($multipleImages as $index => $image) {
                        $filename = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move($directory, $filename);

                        $relativePath = 'upload/products/' . $filename;
                        $variant_images[] = $relativePath;

                        if ($image->getClientOriginalName() == $variantThumbnailImage) {
                            $variantThumbnailImage = $relativePath;
                        }
                    }
                }


                if ($variantThumbnailImage == null && !empty($variant_images)) {
                    $variantThumbnailImage = $variant_images[0];
                }
                $product_variant = ProductVariant::updateOrCreate(
                    ['id' => $variant_id],
                    [
                        'product_id' => $product->id,
                        'variant_combination' => $variant_combination,
                        'variant_ids' => $variant_ids,
                        'product_variant_skucode' => $variant_skucode,
                        'product_variant_youtube_link' => $variant['product_variant_youtube_link'] ?? null,
                        'product_variant_mrp' => $variant['product_variant_mrp'] ?? 0,
                        'product_variant_price' => $variant['product_variant_price'] ?? 0,
                        'product_variant_discount' => $variant['product_variant_discount'] ?? 0,
                        'product_variant_stock' => $variant['product_variant_stock'] ?? 0,
                        'product_variant_images' => $variant_images,
                        'product_variant_thumbnail_image' => $variantThumbnailImage,
                    ]
                );

                $allProductVariants[] = $product_variant;
            }

            $existingIds = collect($allProductVariants)->pluck('id')->filter();

            ProductVariant::where('product_id', $product->id)
                ->when($existingIds->isNotEmpty(), fn($q) => $q->whereNotIn('id', $existingIds))
                ->get()
                ->each(function ($variant) {
                    collect($variant->product_variant_images)->each(function ($image) {
                        $path = public_path($image);
                        if (File::exists($path))
                            File::delete($path);
                    });
                    $variant->delete();
                });

        }

        $responseData = $product
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Product has been saved successfully.']
            : ['success' => false, 'Status' => 400, 'Message' => 'The Product could not be saved.'];

        return response()->json($responseData);
    }
    #=====================================================================================================


    #=====================================================================================================
    #Product bulkAction Function
    public function bulkAction(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');


        $affected = Product::whereIN('id', $ids);

        if ($action == "delete") {
            $products = $affected->get();
            foreach ($products as $product) {
                collect($product->product_images)->each(function ($image) {
                    $path = public_path($image);
                    if (File::exists($path))
                        File::delete($path);
                });

                // Delete variant images
                $product->ProductVariants->each(function ($variant) {
                    collect($variant->product_variant_images)->each(function ($image) {
                        $path = public_path($image);
                        if (File::exists($path))
                            File::delete($path);
                    });
                });
            }
        }
        $affected = $action == "delete" ? $affected->delete() : $affected->update(['status' => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }
    #=====================================================================================================

    #=====================================================================================================
    #Product data Delete Function
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['Status' => 404, 'message' => 'Product Data does not Delete']);
        }

        // Delete product images
        collect($product->product_images)->each(function ($image) {
            $path = public_path($image);
            if (File::exists($path))
                File::delete($path);
        });

        // Delete variant images
        $product->ProductVariants->each(function ($variant) {
            collect($variant->product_variant_images)->each(function ($image) {
                $path = public_path($image);
                if (File::exists($path))
                    File::delete($path);
            });
        });

        $product->delete();

        return response()->json(['Status' => 200, 'message' => 'Product Data Delete successfully']);
    }
    #=====================================================================================================

    #=====================================================================================================
    #form redirect Function
    public function productform($slug = null)
    {
        $product = Product::with('ProductVariants')
            ->where('product_slug', '=', $slug)
            ->first();

        $product_id = $product->id ?? null;

        $permission = $product_id != null ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        $productvariants = ProductVariant::where('product_id', $product_id)->get();

        $brands = Brand::select('id', 'brand_name', 'brand_slug')
            ->where('status', 'active')
            ->get();

        $product_category = Categorie::select('id', 'categorie_name', 'categorie_slug')
            ->where('status', 'active')
            ->get();

        $variants = Variant::select('id', 'variant_name', 'variant_value')
            ->whereNull('variant_parent_id')
            ->whereIn('id', Variant::whereNotNull('variant_parent_id')->pluck('variant_parent_id'))
            ->where('status', 'active')
            ->get();

        $all_products = Product::select('id', 'product_name', 'product_slug')
            ->where('id', '!=', $product_id)
            ->where('status', 'active')
            ->get();

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],
            ['link' => route('product.index'), 'name' => ucwords("Product List")],
            ['name' => $slug ? ucwords("Edit Product") : ucwords("Add Product")],
        ];
        $file['title'] = ucwords("Product Form");



        return view('product.productform', $file, compact('product_category', 'all_products', 'variants', 'brands', 'product', 'productvariants'));
    }
    #=====================================================================================================

    public function product_columns()
    {
        $columns = Schema::getColumnListing('products'); // return all the products table column name
        unset($columns[0]);

        $response = $columns ?
            ['status' => 200, 'message' => 'The product found successfully.', 'data' => $columns] :
            ['status' => 404, 'message' => 'The Product not found.', 'date' => []];
        return response()->json($response);
    }

    public function exportData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'slug' => 'required',
            'export_type' => 'required|in:csv,excel,pdf',
            'fields' => 'required|array|min:1',
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        // $slug = $request->slug;
        $type = $request->export_type;
        $selectedFields = $request->fields;
        $filename = "Products";

        $thead = $selectedFields;

        $query = DB::table('products')->select($selectedFields)->orderByDesc('id');
        $data = $query->get();

        if ($data->isEmpty())
            return response()->json(['status' => 400, 'message' => 'No data found.']);

        foreach ($data as $key => $row) {
            $row = (array) $row;

            // Handle relational fields
            foreach ($row as $rowkey => $rowval) {

                if ($rowkey === 'product_thumbnail_image') {
                    $row[$rowkey] = asset(File::exists(public_path($rowval)) ? $rowval : 'upload/no-image.png');

                } else if ($rowkey === 'category_id') {
                    $row[$rowkey] = DB::table('module_category')->where('id', $rowval)->value('category_name') ?? null;
                } else {
                    $row[$rowkey] = !empty($rowval) ? ($rowkey === 'hobbies' || $rowkey === 'country' ? implode(',', json_decode($rowval)) : $rowval) : null;
                }
            }

            $data[$key] = $row;
        }

        $exportMethods = [
            'csv' => 'exportCSV',
            'excel' => 'exportExcel',
            'pdf' => 'exportPDF'
        ];

        return isset($exportMethods[$type])
            ? $this->{$exportMethods[$type]}($data, $thead, $filename)
            : response()->json(['status' => 400, 'message' => 'Invalid export type']);
    }

    public function exportCSV($data, $thead, $filemodule)
    {
        $filename = "export_" . $filemodule . now()->format('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        return response()->stream(function () use ($data, $thead) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $thead);

            foreach ($data as $item) {
                fputcsv($handle, (array) $item);
            }

            fclose($handle);
        }, 200, $headers);
    }

    // Export to Excel
    public function exportExcel($data, $thead, $filename)
    {

        $filename = "export_" . $filename . now()->format('Y-m-d_H-i-s') . ".xlsx";

        return Excel::download(new BlogExport($data, $thead), $filename);
    }

    public function exportPDF($data, $thead, $filename)
    {

        PDF::setOption('isHtml5ParserEnabled', true);
        PDF::setOption('isPhpEnabled', true);
        $filename = "export_" . $filename . now()->format('Y-m-d_H-i-s') . ".pdf";
        $pdf = PDF::setOptions(['isPhpEnabled' => true])->loadView('exports.pdf', ['data' => $data, 'thead' => $thead]);
        $htmlContent = view('exports.pdf', ['data' => $data, 'thead' => $thead])->render();
        return $pdf->download($filename);

    }


    #=====================================================================================================
    #get variant data Function
    public function variant_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids.*' => 'required|exists:variants,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $ids = $request->input('ids');
        if (empty($ids) || !is_array($ids)) {
            return response()->json(['status' => 400, 'message' => 'Invalid or empty variant IDs provided.']);
        }
        $variant = Variant::select('id', 'variant_name', 'variant_parent_id')
            ->WhereIn('id', $ids)
            ->whereNull('variant_parent_id')
            ->with([
                'children' => function ($query) {
                    $query->select('id', 'variant_name', 'variant_parent_id');
                }
            ])
            ->get()
            ->toarray();
        return response()->json([
            'status' => $variant ? 200 : 400,
            'message' => $variant ? 'Variants found successfully.' : 'No variants found.',
            'data' => $variant ? $variant : [],
        ]);
    }
    #=====================================================================================================


    #=====================================================================================================
    #remove image Function
    public function removeImage(Request $request)
    {
        $id = $request->input('id');
        $variant_id = $request->input('variant_id', 0);
        $image = $request->input('image');

        if (empty($id) || empty($image)) {
            return response()->json(['status' => 400, 'message' => 'Invalid request.']);
        }


        $model = $variant_id == 0 ? Product::class : ProductVariant::class;
        $product = $model::find($variant_id == 0 ? $id : $variant_id);

        $img_field = $variant_id == 0 ? 'product_images' : 'product_variant_images';
        $thumbnail_field = $variant_id == 0 ? 'product_thumbnail_image' : 'product_variant_thumbnail_image';

        if ($product && $product->{$img_field}) {
            $product->{$img_field} = array_values(array_filter($product->{$img_field}, fn($img) => $img !== $image));

            if ($product->{$thumbnail_field} === $image) {
                $product->{$thumbnail_field} = null;
            }

            $product->save();

            if (File::exists(public_path($image))) {
                File::delete(public_path($image));
            }
        }

        return response()->json(['status' => $product ? 200 : 400, 'message' => $product ? 'Image deleted successfully.' : 'Image not found or could not be deleted.']);
    }
    #=====================================================================================================



}
