<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    private $module_slug = 'sliders';
    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);

        if ($request->ajax()) {
            $Data = Slider::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Title',
                'Sub Title',
                'Image',
                'Link',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);

            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('heading_text', 'LIKE', '%' . $request->search . "%");
                });
            }

            $limit = $request->limit ? $request->limit : 5;
            $tbody = $Data->paginate($limit);
            $tbody_data = $tbody->items();



            foreach ($tbody_data as $key => $data) {
                $image_url = asset((!empty($data->image) && File::exists(public_path($data->image))) ? $data->image : 'upload/no-image.png');
                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';
                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-BlogModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('sliders') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';



                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status ms-25 bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'slider/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';


                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary ms-25 d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('sliders') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';



                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->heading_text ?? '--';
                $row[] = $data->sub_heading_text ?? '--';
                $row[] = "<a href='$image_url' data-lightbox='$data->id' data-title='image preview' class='show_img_a'><img src='$image_url' class='rounded ' alt='image' style='width: 50px;height: 50px;'></a>";
                $row[] = $data->link ?? '--';
                $row[] = $data->updated_at ?? '--';

                $tbody_data[$key] = $row;
            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }


        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("slider list")],
        ];
        $file['title'] = ucwords("slider list");

        $product_data = Product::where('status', 'active')
            ->orderByDesc('id')
            ->get(['id', 'product_name', 'product_slug'])
            ->map(fn($item) => ['value' => $item->product_slug, 'label' => ucfirst($item->product_name)])
            ->toArray();

        $category = Categorie::where('status', 'active')
            ->orderByDesc('id')
            ->get(['id', 'categorie_name', 'categorie_slug'])
            ->map(fn($item) => ['value' => $item->categorie_slug, 'label' => ucfirst($item->categorie_name)])
            ->toArray();


        $file['SliderDataFilterData'] = [
            'name' => 'slider',
            'action' => route('slider.index'),
            'bulk_action_url' => 'slider',
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['SliderFormData'] = [
            'name' => 'blog_form',
            'action' => route('slider.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save slider',
            'btnGrid' => 3,
            'no_submit' => false,
            'fieldData' => [

                [
                    'tag' => 'input',
                    'type' => 'hidden',
                    'name' => 'id',
                    'label' => '',
                    'placeholder' => 'id',
                    'value' => '0',
                    'grid' => '1',
                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'heading_text',
                    'label' => 'Title',
                    'placeholder' => 'Title',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'sub_heading_text',
                    'label' => 'Sub Title',
                    'placeholder' => 'Sub Title',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'image',
                    'label' => 'Image',
                    'placeholder' => 'Image',
                    'value' => '',
                    'grid' => '12',
                ],
                [
                    'tag' => 'input',
                    'type' => 'radio',
                    'name' => 'link_type',
                    'label' => '',
                    'element_extra_classes' => 'link_type',
                    'outer_div_classes' => 'link_type_div d-flex',
                    'grid' => '12',
                    'placeholder' => '',
                    'value' => 'product',
                    'data' => [
                        ['value' => 'product', 'label' => 'Product Link'],
                        ['value' => 'category', 'label' => 'Category Link'],
                        ['value' => 'link', 'label' => 'External Link'],
                    ],
                ],
                [
                    'tag' => 'select',
                    'name' => 'link[]',
                    'label' => 'Product',
                    'element_extra_classes' => 'select2InModal',
                    'element_extra_attributes' => '',
                    'outer_div_classes' => 'product_div',
                    'data' => $product_data,
                    'grid' => '6',
                ],
                [
                    'tag' => 'select',
                    'name' => 'link[]',
                    'label' => 'Category',
                    'element_extra_classes' => 'select2InModal',
                    'element_extra_attributes' => '',
                    'outer_div_classes' => 'category_div d-none',
                    'data' => $category,
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'link[]',
                    'label' => 'External Link',
                    'placeholder' => 'link',
                    'outer_div_classes' => 'link_div d-none',
                    'value' => '',
                    'grid' => '6',
                ],
            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary  open-my-model" mymodel="BlogModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    slider</a>'
            : '';

        return view('slider.slider', $file);
    }
    public function store(Request $request)
    {
        $id = $request->input('id');

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'heading_text' => 'required',
            'sub_heading_text' => 'required',
            'link_type' => 'required|in:product,category,link',
            'image' => (($request->id ?? 0) > 0 ? 'nullable' : 'required') . '|mimes:jpeg,webp,jpg,png,gif',
            'link.0' => 'required_if:link_type,product',
            'link.1' => 'required_if:link_type,category',
            'link.2' => 'required_if:link_type,link',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $filePath = null;
        $brand = Slider::find($id);

        $finalLink = ($request->link_type == "product" ? $request->link[0] : ($request->link_type == "category" ? $request->link[1] : $request->link[1]));



        if ($brand) {
            $filePath = $brand->image;
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $directory = 'upload/slider';
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $filePath = $directory . '/' . $filename;

            if ($id != 0 || $id != null) {

                if ($brand && $brand->image && File::exists(public_path($brand->image))) {
                    File::delete(public_path($brand->image));
                }
            }
            $file->move(public_path($directory), $filename);
        }

        $brand = Slider::updateOrCreate(
            ['id' => $id],
            [
                'heading_text' => $request->input('heading_text'),
                'sub_heading_text' => $request->input('sub_heading_text'),
                'image' => $filePath,
                'link_type' => $request->link_type,
                'link' => $finalLink
            ]
        );
        $responseData = $brand
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Slider been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Slider could not be saved.'];

        return response()->json($responseData);
    }
    public function bulkAction(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');

        $affected = Slider::whereIN('id', $ids);

        if ($action == "delete") {
            $blogs = Slider::whereIN('id', $ids)->get();

            foreach ($blogs as $blog) {
                if ($blog && $blog->image && File::exists(public_path($blog->image))) {
                    File::delete(public_path($blog->image));
                }
            }
        }
        $affected = $action == "delete" ? $affected->delete() : $affected->update(['status' => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $blog = Slider::find($id);
        if ($blog && $blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }
        $blog->delete();
        $responseData = $blog
            ? ['Status' => 200, 'message' => 'Data Delete succesfully']
            : ['Status' => 404, 'message' => 'Data does not Delete'];
        return response()->json($responseData);
    }
}
