<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    private $module_slug = 'blogs';

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
            $Data = Blog::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);


            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Title',
                'Desc',
                'Image',
                'Category',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);

            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);


            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->search . "%");
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
                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-BlogModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('blogs') . '/' . encrypt_to($data->id) . '" >
                <span class="avatar-content">
                <i data-feather=\'edit\' class="avatar-icon"></i>
                </span>
                </a>' : '';



                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status ms-25 bg-light-danger delete_record" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'blog/' . encrypt_to($data->id) . '">
                <span class="avatar-content">
                <span class="avatar-content">
                <i data-feather=\'trash-2\' class="avatar-icon"></i>
                </span>
                </a>' : '';


                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary ms-25 d-inline-block align-middle"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('blogs') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                <label class="form-check-label" for="StatusSwitch' . $key . '">
                <span class="switch-icon-left"><i data-feather="check"></i></span>
                <span class="switch-icon-right"><i data-feather="x"></i></span>
                </label>
                </div>' : '';

                // dd($data->categories);


                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;

                $row[] = $data->title ?? '--';
                $row[] = $data->description ?? '--';
                $row[] = "<a href='$image_url' data-lightbox='$data->id' data-title='image preview' class='show_img_a'><img src='$image_url' class='rounded ' alt='image' style='width: 50px;height: 50px;'></a>";
                $categoryIds = $data->categories ?? [];
                $categoryNames = Categorie::whereIn('id', $categoryIds)
                    ->pluck('categorie_name')
                    ->toArray();
                // $row[] = implode(",", $data->categories) ?? '--';
                $row[] = !empty($categoryNames) ? implode(", ", $categoryNames) : '--';
                $row[] = $data->updated_at ?? '--';

                $tbody_data[$key] = $row;
            }
            $tbody->setCollection(new Collection($tbody_data));


            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $product_category
            = Categorie::orderByDesc('id')
                ->get(['id', 'categorie_name'])
                ->map(
                    fn($item) =>
                    [
                        'value' => $item->id,
                        'label' => $item->categorie_name
                    ]
                )->toArray();

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Blog list")],
        ];
        $file['title'] = ucwords("Blog list");

        $file['BlogDataFilterData'] = [
            'name' => 'blog',
            'action' => route('blog.index'),
            'bulk_action_url' => 'blog',
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['BlogFormData'] = [
            'name' => 'blog_form',
            'action' => route('blog.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Blog',
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
                    'name' => 'title',
                    'label' => 'Title',
                    'placeholder' => 'Title',
                    'value' => '',
                    'grid' => '6',
                ],
                [
                    'tag' => 'select2',
                    'type' => '',
                    'name' => 'categories',
                    'label' => 'categories',
                    'placeholder' => 'categories',
                    'data' => $product_category,
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
                    'type' => 'text',
                    'name' => 'description',
                    'label' => 'description',
                    'placeholder' => 'description',
                    'value' => '',
                    'grid' => '12',

                ]

            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary  open-my-model" mymodel="BlogModel"><i
                        data-feather="plus"></i>&nbsp;Add
                    Blog</a>'
            : '';

        return view('blog.index', $file);
    }


    public function store(Request $request)
    {
        $id = $request->input('id');

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            // 'categories' => 'required',
            'categories' => 'required|array',
            'image' => (($request->id ?? 0) > 0 ? 'nullable' : 'required') . '|mimes:jpeg,webp,jpg,png,gif',
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $filePath = null;
        $brand = Blog::find($id);

        // $finalLink = ($request->link_type == "product" ? $request->link[0] : ($request->link_type == "category" ? $request->link[1] : $request->link[1]));



        if ($brand) {
            $filePath = $brand->image;
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $directory = 'upload/blog';
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $filePath = $directory . '/' . $filename;

            if ($id != 0 || $id != null) {

                if ($brand && $brand->image && File::exists(public_path($brand->image))) {
                    File::delete(public_path($brand->image));
                }
            }
            $file->move(public_path($directory), $filename);
        }

        $brand = Blog::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => $filePath,
                // 'categories' => json_encode($request->input('categories'))
                'categories' => $request->input('categories'),

            ]
        );
        $responseData = $brand
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Blog been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Blog could not be saved.'];

        return response()->json($responseData);
    }

    public function bulkAction(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');

        $affected = Blog::whereIN('id', $ids);

        if ($action == "delete") {
            $blogs = Blog::whereIN('id', $ids)->get();

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $blog = Blog::find($id);
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
//
