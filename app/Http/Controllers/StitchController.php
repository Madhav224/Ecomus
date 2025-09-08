<?php

namespace App\Http\Controllers;

use App\Models\Stitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class StitchController extends Controller
{

    private $module_slug = 'stitches';

    public function index(Request $request)
    {
        $deletepermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.delete'));
        $statuspermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.status'));
        $editpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.edit'));
        $createpermission = !(Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.create'));

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
            abort(403, UNAUTH_403_MESSAGE);

        if ($request->ajax()) {
            $Data = Stitch::orderByDesc('id');

            if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.read'))
                return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
            $thead = [
                '<input class="form-check-input datatable_allcheckbox" type="checkbox">',
                'Action',
                'Title',
                'price',
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






                $row = [];

                if ($deletepermission || $statuspermission) {
                    $row[] = '<input class="form-check-input datatable_checkbox" type="checkbox" value="' . $data->id . '" >';
                }

                $actionButtons = '';


                $actionButtons .= $editpermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-StitchModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('stitches
                        ') . '/' . encrypt_to($data->id) . '" >
                        <span class="avatar-content">
                            <i data-feather=\'edit\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $actionButtons .= $deletepermission ? '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record ms-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" deleteto="' . encrypt_to('stitches
') . '/' . encrypt_to($data->id) . '">
                    <span class="avatar-content">
                        <span class="avatar-content">
                            <i data-feather=\'trash-2\' class="avatar-icon"></i>
                        </span>
                    </a>' : '';

                $actionButtons .= $statuspermission ? '<div class="datatable-switch form-check form-switch form-check-primary d-inline-block align-middle ms-25"  data-bs-toggle="tooltip" data-bs-placement="top" title="Click to ' . ($data->status == 'active' ? 'Deactivate' : 'Activate') . '">
                    <input type="checkbox" class="form-check-input change_status" id="StatusSwitch' . $key . '" ' . ($data->status == 'active' ? 'checked' : '') . ' statusto="' . encrypt_to('stitches') . '/' . encrypt_to($data->id) . '/' . encrypt_to('status') . '"/>
                        <label class="form-check-label" for="StatusSwitch' . $key . '">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>' : '';

                if ($deletepermission || $statuspermission || $editpermission)
                    $row[] = $actionButtons;


                $row[] = $data->title ?? '--';
                $row[] = $data->price ?? '--';
                $row[] = $data->updated_at ?? '--';
                $tbody_data[$key] = $row;
            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }


        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],

            ['name' => ucwords("Stitch list")],
        ];
        $file['title'] = ucwords("Stitch list");


        $file['StitchDataFilterData'] = [
            'name' => 'stitch',
            'action' => route('stitches.index'),
            'bulk_action_url' => encrypt_to('stitches'),
            'bulk_delete' => $deletepermission,
            'bulk_status' => $statuspermission,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['StitchFormData'] = [
            'name' => 'stitches_form',
            'action' => route('stitches.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Stitch',
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
                    'grid' => '12',
                ],
                [
                    'tag' => 'input',
                    'type' => 'number',
                    'name' => 'price',
                    'label' => 'Price',
                    'placeholder' => 'Price',
                    'value' => '',
                    'grid' => '12',
                ]

            ],
        ];

        $file['breadcrumbButton']['button'] = $createpermission ? '<a href="#" class="btn btn-primary mb-1 open-my-model" mymodel="StitchModel"><i
                    data-feather="plus"></i>&nbsp;Add
                Stitch</a>'
            : '';

        return view('stitch.index', $file);
    }

    public function store(Request $request)
    {
        $id = $request->input('id');

        $permission = $id > 0 ? 'edit' : 'create';

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.' . $this->module_slug . '.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:stitches,title,' . $id,
            'price' => 'required|numeric|min:0'
        ]);
        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        $stitch = Stitch::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->input('title'),
                'price' => $request->input('price')
            ]
        );
        $responseData = $stitch
            ? ['success' => true, 'Status' => 200, 'Message' => 'The stitch has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The stitch could not be saved.'];

        return response()->json($responseData);
    }
}
