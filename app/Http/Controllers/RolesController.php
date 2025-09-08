<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\StaffRole;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use Illuminate\Support\Str;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasRole(['admin', 'staff'])) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        if ((Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.role.read'))) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        $deleterole = Auth::user()->hasRole('admin') ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.role.delete'));
        $updaterole = Auth::user()->hasRole('admin') ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.role.edit'));

        $readpermission = Auth::user()->hasRole('admin') ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.permission.read'));

        if ($request->ajax()) {
            $Data = StaffRole::orderByDesc('id');
            $thead = array_filter([
                ($deleterole || $updaterole) ? 'Action' : null,
                'Roles Name',
                'CreatedDate',
                'UpdateDate',
                'Assign Permission'
            ]);

            if (!empty($request->search)) {
                $Data->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%");
                });
            }


            $limit = $request->limit ? $request->limit : 5;

            $tbody = $Data->paginate($limit);


            $tbody_data = $tbody->items();

            foreach ($tbody_data as $key => $data) {
                $row = [
                    ($updaterole || $deleterole) ? (
                        ($updaterole ?
                            '<a href="javascript:void(0);" class="avatar avatar-status bg-light-primary openmodal-RoleModel" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" recordof="' . encrypt_to('staff_roles') . '/' . encrypt_to($data->id) . '">
                                    <span class="avatar-content"><i data-feather="edit" class="avatar-icon"></i></span>
                             </a>' : '') . ' ' .
                        ($deleterole ?
                            '<a href="javascript:void(0);" class="avatar avatar-status bg-light-danger delete_record" data-bs-toggle="tooltip"          data-bs-placement="bottom" title="Delete" deleteto="' . 'delete/staff_roles/' . encrypt_to($data->id) . '">
                                    <span class="avatar-content"><i data-feather="trash-2" class="avatar-icon"></i></span>
                                </a>' : '')
                    ) : '',
                    $data->name ?? '--',
                    $data->created_at ?? '--',
                    $data->updated_at ?? '--',
                    '<a href="' . ($readpermission ? route('assign.permission', ['id' => encrypt_to($data->id)]) : 'javascript:void(0)') . '" class="btn btn-sm ' . ($readpermission ? 'btn-primary' : 'btn-secondary') . '  assign_permission" data-id="' . $data->id . '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . ($readpermission ? 'Assign Permission' : 'permission denied') . '" >
                        <i data-feather="key" ></i> Assign
                    </a>'
                ];

                $tbody_data[$key] = array_filter($row); // Remove empty elements
            }

            $tbody->setCollection(new Collection($tbody_data));

            return view('datatable.datatable', compact('tbody', 'thead'))->render();
        }

        $file['breadcrumbs'] = [
            ['link' => "/", 'name' => "Home"],
            ['name' => ucwords("Roles list")],
        ];
        $file['title'] = ucwords("Roles list");


        $file['RolesDataFilterData'] = [
            'name' => 'role',
            'action' => route('role.index'),
            'bulk_action_url' => encrypt_to('staff_roles'),
            'bulk_delete' => false,
            'bulk_status' => false,
            'btnGrid' => 2,
            'no_submit' => 1,
            'fieldData' => [],
        ];

        $file['RolesFormData'] = [
            'name' => 'role_form',
            'action' => route('role.store'),
            'method' => 'post',
            'submit' => '<i data-feather="save"></i> Save Roles',
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
                    'name' => 'name',
                    'label' => 'Roles Name',
                    'placeholder' => 'Roles Name',
                    'value' => '',
                    'grid' => '12',

                ],
                [
                    'tag' => 'input',  // Changed from select to hidden input
                    'type' => 'hidden',
                    'name' => 'role_id',
                    'value' => 9,  // Hardcoded value
                ],
            ],
        ];

        $file['breadcrumbButton']['button'] = (Auth::user()->hasRole('admin') ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.role.create')))
            ? '<a href="#" class="btn btn-primary open-my-model" mymodel="RoleModel"><i
                        data-feather="plus"></i>Add Roles</a>'
            : '';

        return view('roles.roles', $file);
    }

    #store roles Data(Insert or Update)
    public function store(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:staff_roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $permission = $id > 0 ? 'edit' : 'create';
        if (Auth::user()->hasRole(['staff']) && !Auth::user()->can(Auth::user()->staff_role_id . '.role.' . $permission)) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);
        }

        $role = Role::findByName('staff');
        $role_id = $role->id;

        $role = StaffRole::updateOrCreate(
            ['id' => $id],
            [
                'name' => Str::slug($request->input('name'), '_'),
                'role_id' => $role_id
            ]

        );

        $responseData = $role
            ? ['success' => true, 'Status' => 200, 'Message' => 'The Role has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'The Role could not be saved.'];

        return response()->json($responseData);
    }

    public function deleteRole($id)
    {
        if (!Auth::user()->hasRole(['admin', 'staff']) || (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.role.delete')))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);



        $id = decrypt_to($id);
        $role = StaffRole::find($id);

        $users = $role->administrators;


        if ($users->count() > 0) {
            return response()->json(['success' => false, 'Status' => 403, 'Message' => 'This role is assigned to some users. Please remove the role from users before deleting it.']);
        }

        if (!$role) {
            return response()->json(['success' => false, 'Status' => 404, 'Message' => 'Role not found.']);
        }

        Permission::where('guard_name', 'admin')
            ->where('name', 'like', $id . '.%')
            ->delete();


        $role->delete();

        return response()->json(['success' => true, 'Status' => 200, 'Message' => 'Role deleted successfully.']);
    }



    public function assignPermission(Request $request, $id)
    {

        if (!Auth::user()->hasRole(['admin', 'staff'])) {
            abort(403, UNAUTH_403_MESSAGE);
        }

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.permission.read'))
            abort(403, UNAUTH_403_MESSAGE);

        $id = decrypt_to($id);
        $role = StaffRole::find($id);
        $mainrole = Role::findByName('staff');


        $title = ucwords("Permission");

        $breadcrumbs = [['link' => "/", 'name' => "Home"], ['link' => route('role.index'), 'name' => "Roles"], ['name' => $title]];
        if (!$role) {
            return response()->json(['success' => false, 'Status' => 404, 'Message' => 'Role not found.', 'Redirect' => route('role.index')]);
        }

        $module = Module::where('module_status', 'active')->get();

        return view('roles.assign_permission', compact('title', 'breadcrumbs', 'module', 'role', 'mainrole'));
    }


    public function StoreRolePermissions(Request $request)
    {

        if (!Auth::user()->hasRole(['admin', 'staff']))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);

        if (Auth::user()->hasRole('staff') && !Auth::user()->can(Auth::user()->staff_role_id . '.permission.edit'))
            return response()->json(['success' => false, 'Status' => 403, 'Message' => UNAUTH_403_MESSAGE, 'Redirect' => url()->previous()]);



        $validator = Validator::make($request->all(), [
            'permissions' => 'sometimes|array',
            'permissions.*' => 'string',
            'role_id' => 'required|exists:staff_roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'Message' => 'Validation Warning',
                'Data' => $validator->errors()->toArray()
            ], 422);
        }
        $role = Role::findByName('staff');

        $perms = collect($request->all_permissions ?? []);

        $permissionsToRevoke = Permission::whereIn('name', $perms)
            ->where('guard_name', 'admin')
            ->get();

        // Only revoke exact matching permissions
        $role->revokePermissionTo($permissionsToRevoke);

        Permission::insertOrIgnore(
            $perms->map(fn($p) => ['name' => $p, 'guard_name' => 'admin'])->all()
        );

        // Assign selected permissions
        if (!empty($request->permissions)) {
            $role->givePermissionTo($request->permissions);
        }

        return successResponse([
            'Status' => 200,
            'success' => true,
            'Message' => 'Permissions updated successfully!',
            'Data' => [],
            'Redirect' => route('role.index')
        ]);
    }
}
