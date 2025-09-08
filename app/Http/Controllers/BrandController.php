<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    private $module_slug = 'brands';
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
            $Data = Brand::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Brand Name',
                'Slug',
                'Description',
                'Image',
                'Brand Path',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);

            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('brand_name', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();


            foreach ($tbody_data as $key => $data) {

                $image_url = asset((!empty($data->brand_image) && File::exists(public_path($data->brand_image))) ? $data->brand_image : 'upload/no-image.png');

                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';


                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status  bg-light-primary openmodal-BrandModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('brands') .'/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';


                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status ms-25 bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'brands/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';


                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary ms-25 d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('brands') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';


                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->brand_name ?? '--';
                $row[] = $data->brand_slug ?? '--';
                $row[] = !empty($data->brand_description) ? (strlen($data->brand_description) > 35
                    ? substr($data->brand_description, 0, 35) . '...'
                    : $data->brand_description) : '--';
                $row[] = "<a href='$image_url' data-lightbox='$data->id' data-title='image preview' class='show_img_a'><img src='$image_url' class='rounded ' alt='image' style='width: 50px;height: 50px;'></a>";
                $row[] = $data->brand_path ?? '--';
                $row[] = $data->updated_at ?? '--';

                $tbody_data[$key] = $row;

            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Brand list")],
        ];
        $file['title'] = ucwords("Brand list");


        $file['BrandDataFilterData'] = [
            'name' => 'Brand',
            'action' => route('brand.index'),
            'bulk_action_url' => 'brands',
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['BrandFormData'] = [
            'name' => 'blog_form',
            'action' => route('brand.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Brand',
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
                    'name' => 'brand_name',
                    'label' => 'Blog Name',
                    'placeholder' => 'Blog Name',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'brand_slug',
                    'label' => 'Blog Slug',
                    'placeholder' => 'Blog Slug',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'textarea',
                    'type' => '',
                    'name' => 'brand_description',
                    'label' => 'Description',
                    'element_extra_classes' => 'quill-editor',
                    'outer_div_classes' => '',
                    'placeholder' => 'Description',
                    'value' => '',
                    'grid' => '12',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'brand_path',
                    'label' => 'URL',
                    'placeholder' => 'URL',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'brand_image',
                    'label' => 'Image',
                    'placeholder' => 'Image',
                    'value' => '',
                    'grid' => '6',
                ],


            ],
        ];

        return view('brand.brand', $file);
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
            'brand_name' => 'required|string|max:255|unique:brands,brand_name,' . $id,
            'brand_slug' => 'required|string|max:255|unique:brands,brand_slug,' . $id,
            'brand_description' => 'required|string|max:255',
            'brand_path' => 'required|string|max:255',
            'brand_image' => $id ? 'nullable|mimes:jpg,png,jpeg,webp' : 'required|mimes:jpg,png,jpeg,webp',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);



        $filePath = null;
        $brand = Brand::find($id);

        if ($brand) {
            $filePath = $brand->brand_image;
        }

        if ($request->hasFile('brand_image') && $request->file('brand_image')->isValid()) {
            $file = $request->file('brand_image');
            $directory = 'upload/brand';
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $filePath = $directory . '/' . $filename;

            if ($id != 0 || $id != null) {


                if ($brand && $brand->brand_image && File::exists(public_path($brand->brand_image))) {
                    File::delete(public_path($brand->brand_image));
                }
            }
            $file->move(public_path($directory), $filename);

        }

        $brand = Brand::updateOrCreate(
            ['id' => $id],
            [
                'brand_name' => $request->input('brand_name'),
                'brand_slug' => Str::slug($request->input('brand_slug')),
                'brand_description' => $request->input('brand_description'),
                'brand_path' => $request->input('brand_path'),
                'brand_image' => $filePath
            ]
        );
        $responseData = $brand
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

        $blog = Brand::find($id);
        if ($blog && $blog->brand_image && File::exists(public_path($blog->brand_image))) {
            File::delete(public_path($blog->brand_image));
        }
        $blog->delete();
        $responseData = $blog
            ? ['Status' => 200, 'message' => 'Data Delete succesfully']
            : ['Status' => 404, 'message' => 'Data does not Delete'];
        return response()->json($responseData);
    }

    public function bulkAction(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');

        $affected = Brand::whereIN('id', $ids);

        if ($action == "delete") {
            $blogs = Brand::whereIN('id', $ids)->get();

            foreach ($blogs as $blog) {
                if ($blog && $blog->brand_image && File::exists(public_path($blog->brand_image))) {
                    File::delete(public_path($blog->brand_image));
                }
            }
        }
        $affected = $action == "delete" ? $affected->delete() : $affected->update(['status' => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }

    #shorting oprder
    public function sortData(Request $request)
    {
        $brand = Brand::orderBy('brand_sort_order')
            ->get();
        $responseText = $brand && $brand->isNotEmpty() ?
            ['status' => 200, 'message' => 'Brand Data Found Succesfully..', 'data' => $brand]
            :
            ['status' => 404, 'message' => 'Brand data not found for sorting', 'data' => []];

        return response()->json($responseText);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    public function update_sortData(Request $request)
    {
        $SidebarData = $request->json()->all();

        $error = "";
        foreach ($SidebarData['data'] as $data) {
            $sidebar = Brand::find($data['id']);
            if ($sidebar) {
                $sidebar->brand_sort_order = $data['position'];
                $sidebar->save();
            } else {
                $error = "error";
            }
        }


        $responsetext = empty($error) ? ['status' => 200, 'message' => 'Sidebar sorting updated successfully'] : ['status' => 500, 'message' => 'Failed to update sorting !'];


        return response()->json($responsetext);
    }
}
