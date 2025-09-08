<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductReviewController extends Controller
{
    private $module_slug = 'productreview';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);


        if ($request->ajax()) {
            $Data = ProductReview::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Product Name',
                'User Name',
                'Star',
                'Review Title',
                'Review description',
                'UpdateDate'
            ];
            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);

            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('review_title', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {


                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';

                // $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-ReviewModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('product_reviews') . '/' . encrypt_to($data->id) . '" >
                //         <span class="avatar-content">
                //             <i data-feather=\'edit\' class="avatar-icon"></i>
                //         </span>
                //     </a>' : '';

                // $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger ms-25 delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'delete/productreview/' . encrypt_to($data->id) . '">
                //     <span class="avatar-content">
                //         <span class="avatar-content">
                //             <i data-feather=\'trash-2\' class="avatar-icon"></i>
                //         </span>
                //     </a>' : '';


                $actionButtons .= $statuspermission ? '<div class="datatable-switch ms-25 form-check form-switch form-check-primary d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('product_reviews') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';

                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->product->product_name ?? '--';
                $row[] = $data->user_id ?? '--';
                // $row[] = $data->stars ?? '--';
                $row[] = '<div class="full-star-ratings" data-rateyo-read-only="true" data-rateyo-rating="' . floatval($data->stars) . '" data-rateyo-full-star="true"></div>';
                $row[] = $data->review_title ?? '--';
                $row[] = $data->review_description ?? '--';
                $row[] = $data->updated_at ?? '--';
                $tbody_data[$key] = $row;
            }



            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }


        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Product Review list")],
        ];
        $file['title'] = ucwords("Product Review list");

        $product = Product::where('status', 'active')
            ->orderByDesc('id')
            ->get(['id', 'product_name'])
            ->map(fn($item) => ['value' => $item->id, 'label' => ucfirst($item->product_name)])
            ->toArray();

        $file['ReviewDataFilterData'] = [
            'name' => 'Product Review',
            'action' => route('productreview.index'),
            'bulk_action_url' => 'productreview',
            // 'bulk_delete' => $deletepermission,
            'bulk_delete' => false,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['ReviewFormData'] = [
            'name' => 'Product_review',
            'action' => route('productreview.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Product Review',
            'btnGrid' => 4,
            'no_submit' => false,
            'fieldData' => [
                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'stars',
                    'label' => '',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'placeholder' => 'stars',
                    'value' => '0',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'id',
                    'label' => '',
                    'placeholder' => 'id',
                    'value' => '0',
                    'grid' => '6',
                ],
                [
                    'tag' => 'select',
                    'name' => 'product_id',
                    'label' => 'Product Name',
                    'element_extra_classes' => '',
                    'element_extra_attributes' => '',
                    'data' => $product,
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'name' => 'user_id',
                    'label' => 'User Name',
                    'placeholder' => 'User Name',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'review_title',
                    'label' => 'Review Title',
                    'placeholder' => 'Review Title',
                    'value' => '',
                    'grid' => '12',
                ],
                [
                    'tag' => 'textarea',
                    'type' => '',
                    'name' => 'review_description',
                    'label' => 'Review Description',
                    'value' => '',
                    'grid' => '12',
                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'review_images',
                    'label' => 'Review Images',
                    'placeholder' => 'Review Images',
                    'value' => '',
                    'is_multiple' => true,
                    'element_extra_attributes' => 'multiple accept="image/webp,image/png,image/jpg,image/jpeg"',
                    'grid' => '12',
                ],
            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary open-my-model" mymodel="ReviewModel"><i
                    data-feather="plus"></i>&nbsp;Add
                Product Review</a>'
            : '';

        return view('productreview.index', $file);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            // 'user_id' => 'required|exists:users,id',
            'user_id' => 'required',
            'review_title' => 'required',
            'review_description' => 'required',
            'stars' => 'required|integer|between:1,5',
            'review_images' => 'nullable|array',
            'review_images.*' => 'image|mimes:jpg,png,jpeg,webp|max:500',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if (collect($errors->keys())->contains(fn($e) => str_starts_with($e, 'review_images.'))) {
                $errors->add('review_images', 'Invalid image(s). Only JPG, PNG, JPEG, WEBP (max 500KB).');
            }

            return response()->json(['errors' => $errors], 422);
        }

        $review  = ProductReview::find($id);
        $images = $review?->review_images ?? [];

        $directory = public_path('upload/productreview');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if ($request->hasFile('review_images')) {
            $multipleImages = $request->file('review_images');


            foreach ($multipleImages as $index => $image) {
                $filename = rand() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $filename);

                $images[] = 'upload/productreview/' . $filename;
            }
        }

        $blog = ProductReview::updateOrCreate(
            ['id' => $id],
            [
                'product_id' => $request->input('product_id'),
                'stars' => $request->input('stars'),
                'user_id' => $request->input('user_id'),
                'review_title' => $request->input('review_title'),
                'review_description' => $request->input('review_description'),
                'review_images' => $images,
            ]
        );
        $responseData = $blog
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Blog has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Blog could not be saved.'];

        return response()->json($responseData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $review = ProductReview::find($id);

        if (!empty($review->review_images)) {
            foreach ($review->review_images as $image) {
                if ($image && File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }

        $review->delete();
        $responseData = $review
            ? ['Status' => 200, 'message' => 'Data Delete succesfully']
            : ['Status' => 404, 'message' => 'Data does not Delete'];
        return response()->json($responseData);
    }


    #----------------------------------------------------------------------------------------------------------------------------
    #Bulk Action function
    public function bulkAction(Request $request)
    {


        $ids = $request->input('ids');
        $action = $request->input('action');

        $affected = ProductReview::whereIN('id', $ids);

        if ($action == "delete") {
            $reviews = $affected->get();
            foreach ($reviews as $review) {
                if ($review && !empty($review->review_images)) {
                    foreach ($review->review_images as $img) {
                        if ($img && File::exists(public_path($img))) {
                            File::delete(public_path($img));
                        }
                    }
                }
            }
        }
        $affected = $action == "delete" ? $affected->delete() : $affected->update(['status' => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }
    #----------------------------------------------------------------------------------------------------------------------------

}
