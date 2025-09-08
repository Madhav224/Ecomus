<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\CategorieImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{

    private $module_slug = 'categories';

    #----------------------------------------------------------------------------------------------------------------------------
    #Fetch All Records for Datatable and redirect to blade page
    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);

        if ($request->ajax()) {
            $Data = Categorie::orderByDesc('id');


            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);



            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Name',
                'Slug',
                'Description',
                'Parent Categories',
                'Mobile Images',
                'Desktop Images',
                'Banner Images',
                'UpdateDate'
            ];

            if ($deletepermission == false && $statuspermission == false)
                unset($thead[0]);


            if ($deletepermission == false && $statuspermission == false && $editpermission == false)
                unset($thead[1]);

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('categorie_name', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {
                $im=$data->images->first();

                $mobile_images = ($img = $data->images()->where('categorie_image_type', 'mobile')->first()) && ($paths = json_decode($img->categorie_image_path, true)) ? $paths : ['upload/no-image.png'];

                $categorie_mobile_images = '';

                foreach ($mobile_images as $img_key => $img_mobile) {
                    $img_path = asset((!empty($img_mobile) && file_exists(public_path($img_mobile))) ? $img_mobile : "upload/no-image.png");
                    $countdiv = count($mobile_images) > 1 ? '<span class="preview_btn " >+' . count($mobile_images) - 1 . '</span>' : '';
                    if ($img_key == 0) {
                        $categorie_mobile_images =
                            '<div style="position:relative;" ><a href="' . $img_path . '" data-lightbox="mobile' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>' . $countdiv . "</div>";
                    } else {
                        $categorie_mobile_images .= '<div class="d-none">
                            <a href="' . $img_path . '" data-lightbox="mobile' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>
                            </div>';
                    }
                }

                $categorie_desktop_images = '';
                $desktop_images = ($img = $data->images()->where('categorie_image_type', 'desktop')->first()) && ($paths = json_decode($img->categorie_image_path, true)) ? $paths : ['upload/no-image.png'];



                foreach ($desktop_images as $img_key => $img_desktop) {
                    $img_path = asset((!empty($img_desktop) && file_exists(public_path($img_desktop))) ? $img_desktop : "upload/no-image.png");
                    $countdiv = count($desktop_images) > 1 ? '<span class="preview_btn " >+' . count($desktop_images) - 1 . '</span>' : '';
                    if ($img_key == 0) {
                        $categorie_desktop_images =
                            '<div style="position:relative;" ><a href="' . $img_path . '" data-lightbox="desktop' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>' . $countdiv . "</div>";
                    } else {
                        $categorie_desktop_images .= '<div class="d-none">
                            <a href="' . $img_path . '" data-lightbox="desktop' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>
                            </div>';
                    }
                }


                $categorie_banner_images = '';
                $banner_images = ($img = $data->images()->where('categorie_image_type', 'banner')->first()) && ($paths = json_decode($img->categorie_image_path, true)) ? $paths : ['upload/no-image.png'];


                foreach ($banner_images as $img_key => $img_banner) {
                    $img_path = asset((!empty($img_banner) && file_exists(public_path($img_banner))) ? $img_banner : "upload/no-image.png");
                    $countdiv = count($banner_images) > 1 ? '<span class="preview_btn " >+' . count($banner_images) - 1 . '</span>' : '';
                    if ($img_key == 0) {
                        $categorie_banner_images =
                            '<div style="position:relative;" ><a href="' . $img_path . '" data-lightbox="banner' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>' . $countdiv . "</div>";
                    } else {
                        $categorie_banner_images .= '<div class="d-none">
                            <a href="' . $img_path . '" data-lightbox="banner' . $data->id . '" data-title="Mobile Preview" class="show_img_a"><img src="' . $img_path . '" class="rounded categories_show_img" alt="Image" /></a>
                            </div>';
                    }
                }
                $show_parent = $data->categorie_parent_id !== null
                    ? '<a href="#" data-pid="' . $data->categorie_parent_id . '" class="category_sorting">' . optional(Categorie::find($data->categorie_parent_id))->categorie_name . '</a>'
                    : '--';

                $row = [];

                // Checkbox (conditional)
                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                // Action buttons (if any)
                $actionButtons = '';

                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-CategoriesModel ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . 'categories/' . encrypt_to($data->id) . '" >
                                        <span class="avatar-content">
                                            <i data-feather=\'edit\' class="avatar-icon"></i>
                                        </span>
                        </a>' : '';

                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . 'categories/' . encrypt_to($data->id) . '">

                                <span class="avatar-content">
                                    <i data-feather=\'trash-2\' class="avatar-icon"></i>
                                </span>
                    </a>' : '';



                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle ms-25" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                            <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('categories') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                            <label class="form-check-label" for="StatusSwitch' . $key . '">
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                                <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                        </div>' : '';

                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;


                $row[] = $data->categorie_name ?? '--';
                $row[] = $data->categorie_slug ?? '--';
                $row[] = $data->categorie_description ?? '--';
                $row[] = $show_parent;
                $row[] = $categorie_mobile_images;
                $row[] = $categorie_desktop_images;
                $row[] = $categorie_banner_images;
                $row[] = $data->updated_at ?? '--';
                $tbody_data[$key] = $row;

            }


            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }




        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Categories list")],
        ];
        $file['title'] = ucwords("Categories list");


        $file['CategoriesDataFilterData'] = [
            'name' => 'categories',
            'action' => route('categories.index'),
            'bulk_action_url' => 'categories',
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $parent_categories = Categorie::orderByDesc('id')
            ->get(['id', 'categorie_name'])
            ->map(fn($item) => ['value' => $item->id, 'label' => $item->categorie_name])
            ->toArray();

        $file['CategoriesFormData'] = [
            'name' => 'categorie_form',
            'action' => route('categorie.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Categorie',
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
                    'name' => 'categorie_name',
                    'label' => 'Categorie Name',
                    'placeholder' => 'Categorie Name',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'categorie_slug',
                    'label' => 'Categorie Slug',
                    'placeholder' => 'Categorie Slug',
                    'value' => '',
                    'grid' => '6',

                ],
                [
                    'tag' => 'select',
                    'name' => 'categorie_parent_id',
                    'label' => 'Parent Categorie',
                    'element_extra_classes' => 'select2',
                    'element_extra_attributes' => '',
                    'data' => $parent_categories,
                    'grid' => '12',
                ],
                [
                    'tag' => 'textarea',
                    'type' => '',
                    'name' => 'categorie_description',
                    'label' => 'Categorie Description',
                    'element_extra_classes' => 'quill-editor',
                    'outer_div_classes' => '',
                    'placeholder' => 'Categorie Description',
                    'value' => '',
                    'grid' => '12',
                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'categorie_banner_image',
                    'label' => 'Banner Image',
                    'placeholder' => 'Banner Image',
                    'value' => '',
                    'is_multiple' => true,
                    'element_extra_attributes' => 'multiple accept="image/webp,image/png,image/jpg,image/jpeg"',
                    'grid' => '12',
                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'categorie_desktop_image',
                    'label' => 'Desktop Image',
                    'placeholder' => 'Desktop Image',
                    'value' => '',
                    'is_multiple' => true,
                    'element_extra_attributes' => 'multiple accept="image/webp,image/png,image/jpg,image/jpeg"',
                    'grid' => '6',
                ],
                [
                    'tag' => 'input',
                    'type' => 'file',
                    'name' => 'categorie_mobile_image',
                    'label' => 'Mobile Image',
                    'placeholder' => 'Mobile Image',
                    'value' => '',
                    'is_multiple' => true,
                    'element_extra_attributes' => 'multiple accept="image/webp,image/png,image/jpg,image/jpeg"',
                    'grid' => '6',
                ],
            ],
        ];

        return view('categories.index', $file);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------
    #store blog Data(Insert or Update)
    public function store(Request $request)
    {
        $id = $request->input('id');
        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'categorie_name' => 'required|unique:categories,categorie_name,' . $id,
            'categorie_slug' => 'unique:categories,categorie_slug,' . $id,
            'categorie_banner_image.*' => (($id ?? 0) > 0 ? 'nullable' : 'required') . '|mimes:jpg,png,jpeg,webp|max:500',
            'categorie_desktop_image.*' => (($id ?? 0) > 0 ? 'nullable' : 'required') . '|mimes:jpg,png,jpeg,webp|max:500',
            'categorie_mobile_image.*' => (($id ?? 0) > 0 ? 'nullable' : 'required') . '|mimes:jpg,png,jpeg,webp|max:500',
        ]);





        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $categories = Categorie::with('images')->find($id);

        $directory = 'upload/categories';
        // Create the directory if it doesn't exist
        if (!File::exists(public_path($directory))) {
            File::makeDirectory(public_path($directory), 0755, true);
        }

        $banner_allpath = $this->handleUploadedFiles($request->file('categorie_banner_image'), $directory);
        $desktop_allpath = $this->handleUploadedFiles($request->file('categorie_desktop_image'), $directory);
        $mobile_allpath = $this->handleUploadedFiles($request->file('categorie_mobile_image'), $directory);

        if ($id > 0) {
            $banner_allpath = $this->mergeOldImages($categories, 'banner', $banner_allpath);
            $desktop_allpath = $this->mergeOldImages($categories, 'desktop', $desktop_allpath);
            $mobile_allpath = $this->mergeOldImages($categories, 'mobile', $mobile_allpath);
        }


        $categories = Categorie::updateOrCreate(
            ['id' => $id],
            [
                'categorie_name' => $request->input('categorie_name'),
                'categorie_slug' => Str::slug(!empty($request->input('categorie_slug')) ? $request->input('categorie_slug') : $request->input('categorie_name')),
                'categorie_description' => $request->input('categorie_description', null),
                'categorie_parent_id' => $request->input('categorie_parent_id', null),
            ]
        );

        $categories->images()->updateOrCreate(
            ['categorie_image_type' => 'banner'],
            ['categorie_image_path' => json_encode($banner_allpath)]
        );
        $categories->images()->updateOrCreate(
            ['categorie_image_type' => 'desktop'],
            ['categorie_image_path' => json_encode($desktop_allpath)]
        );
        $categories->images()->updateOrCreate(
            ['categorie_image_type' => 'mobile'],
            ['categorie_image_path' => json_encode($mobile_allpath)]
        );

        $responseData = $categories
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Categories has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Categories could not be saved.'];

        return response()->json($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------
    #Destroy Blog Data Function
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to($id);

        $Categorie = Categorie::with('images')->find($id);

        if ($Categorie->images) {

            foreach ($Categorie->images as $image) {

                $imagespath = json_decode($image->categorie_image_path);
                if (!empty($imagespath)) {

                    foreach ($imagespath as $img) {
                        if ($img && File::exists(public_path($img))) {
                            File::delete(public_path($img));
                        }
                    }
                }
            }
        }


        $Categorie->delete();
        $responseData = $Categorie
            ? ['Status' => 200, 'message' => 'Data Delete succesfully']
            : ['Status' => 404, 'message' => 'Data does not Delete'];
        return response()->json($responseData);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------
    #Fetch Sigle Record for edit
    public function getRecord()
    {
        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit')) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $id = decrypt_to(request()->id);
        $blog = Categorie::with('images')->find($id);

        if (!$blog) {

            return response()->json(['success' => false, 'Status' => 404, 'Message' => 'The Category not found.']);
        }
        $blog->hobbies = json_decode($blog->hobbies);
        $blog->table = encrypt_to('categories');
        // dd($blog);
        return response()->json(['success' => true, 'Status' => 200, 'Message' => 'The Category found successfully.', 'Data' => $blog]);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------
    #Bulk Action function
    public function bulkAction(Request $request)
    {


        $ids = $request->input('ids');
        $action = $request->input('action');

        // dd($ids,$action);

        $affected = Categorie::whereIN('id', $ids);

        if ($action == "delete") {
            $categories = CategorieImage::whereIN('categorie_id', $ids)->get();
            foreach ($categories as $cate) {

                if ($cate && !empty($cate->categorie_image_path)) {

                    $images = json_decode($cate->categorie_image_path);

                    foreach ($images as $img) {
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



    #----------------------------------------------------------------------------------------------------------------------------
    #function to handle file upload
    private function handleUploadedFiles($files, $directory)
    {
        $allPaths = [];
        $files = is_array($files) ? $files : [$files];

        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $filename = rand() . '.' . $file->getClientOriginalExtension();
                $filePath = $directory . '/' . $filename;
                $file->move(public_path($directory), $filename);
                $allPaths[] = $filePath;
            }
        }

        return $allPaths;
    }
    #----------------------------------------------------------------------------------------------------------------------------


    #----------------------------------------------------------------------------------------------------------------------------
    #function to merge old images with new images
    private function mergeOldImages($categorie, $type, $newPaths)
    {
        $image = $categorie->images()->where('categorie_image_type', $type)->first();
        if (!empty($image?->categorie_image_path)) {
            $oldPaths = json_decode($image->categorie_image_path);
            return array_merge($oldPaths, $newPaths);
        }
        return $newPaths;
    }
    #----------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------------------------------------
    #shorting oprder
    public function sortData(Request $request)
    {

        $parent_id = $request->input('parent_id');

        // dd($parent_id);


        $category = Categorie::when($parent_id == '0', function ($query) {
            return $query->whereNull('categorie_parent_id');
        }, function ($query) use ($parent_id) {
            return $query->where('categorie_parent_id', $parent_id);
        })
            ->orderBy('categorie_sort_order')
            ->get();



        // dd($category);

        // dd($sidebar);
        $responseText = $category && $category->isNotEmpty() ?
            ['status' => 200, 'message' => 'Category Data Found Succesfully..', 'data' => $category]
            :
            ['status' => 404, 'message' => 'Category data not found for sorting', 'data' => []];

        return response()->json($responseText);
    }
    #----------------------------------------------------------------------------------------------------------------------------

    public function update_sortData(Request $request)
    {
        $SidebarData = $request->json()->all();


        $error = "";
        foreach ($SidebarData['data'] as $data) {
            $sidebar = Categorie::find($data['id']);
            if ($sidebar) {
                $sidebar->categorie_sort_order = $data['position'];
                $sidebar->save();
            } else {
                $error = "error";
            }
        }

        $responsetext = empty($error) ? ['status' => 200, 'message' => 'Category sorting updated successfully'] : ['status' => 500, 'message' => 'Failed to update sorting !'];


        return response()->json($responsetext);
    }
}
