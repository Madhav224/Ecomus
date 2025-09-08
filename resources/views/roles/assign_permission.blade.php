@php($ajaxformsubmit = true)
@extends('layouts/contentLayoutMaster')

@section('title', $title)


@section('vendor-style')
@endsection

@section('content')
    @if (Auth::user()->hasRole(['admin']) ||
            (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.permission.read')))
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ ucfirst($role->name) }} Permissions</h4>
            </div>
            <div class="card-body table-responsive">
                <form id="permissions-form" action="{{ route('store.role.permissions') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $role->id }}">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check form-check-primary">
                                        <input type="checkbox" id="all-permissions"
                                            class="form-check-input master-checkbox">
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Read</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Export</th>
                                <th>Import</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($permissions = [['read', ''], ['create', 'action_add'], ['edit', 'action_update'], ['delete', 'action_delete'], ['view', 'action_view'], ['status', 'action_status'], ['export', 'export_btn'], ['import', 'import_btn']])


                            @php($customPermission = getCustomModule())

                            <?php
                            $permissionedit = Auth::user()->hasRole('admin') || (Auth::user()->hasRole('staff') && Auth::user()->can(Auth::user()->staff_role_id . '.permission.edit'));
                            ?>

                            @foreach ($customPermission as $index => $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-primary">
                                            <input type="checkbox" class="form-check-input row-checkbox">
                                        </div>
                                    </td>
                                    <td id="{{ $item['name'] }}" name="{{ $item['name'] }}" class="text-capitalize h5">
                                        {{ ucfirst($item['name']) }}</td>

                                    @foreach ($permissions as $permission)
                                        <?php
                                        $disable = !in_array($permission[0], $item['permission']) || !$permissionedit ? 'disabled' : '';
                                        $permissionName = trim($role->id) . '.' . trim($item['slug']) . '.' . trim($permission[0]);

                                        $permissionName = preg_replace('/\s+/', '', $permissionName);

                                        $permissionExists = Spatie\Permission\Models\Permission::where('name', $permissionName)->exists();
                                        $hasPermission = $permissionExists && $mainrole->hasPermissionTo($permissionName);
                                        ?>
                                        <td>
                                            <div class="form-check form-check-primary form-switch">
                                                <input type="checkbox" id="{{ $item['slug'] }}-{{ $permission[0] }}"
                                                    name="permissions[]" class="form-check-input permission-checkbox"
                                                    style="width:33px; height:17px; margin-top: 5px;"
                                                    value="{{ $permissionName }}" {{ $disable }}
                                                    {{ $hasPermission ? 'checked' : '' }}>
                                            </div>
                                            <input type="hidden" name="all_permissions[]" value="{{ $permissionName }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach


                            @foreach ($module as $index => $item)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-primary">
                                            <input type="checkbox" class="form-check-input row-checkbox">
                                        </div>
                                    </td>
                                    <td id="{{ $item->module_slug }}" name="{{ $item->module_slug }}"
                                        class="text-capitalize h5">
                                        {{ ucfirst($item->module_name) }}</td>

                                    @foreach ($permissions as $permission)
                                        <?php
                                        $disable = (!empty($permission[1]) && $item->{$permission[1]} == 0) || !$permissionedit ? 'disabled' : '';

                                        $permissionName = $role->id . '.' . $item->module_slug . '.' . $permission[0];

                                        $permissionExists = Spatie\Permission\Models\Permission::where('name', $permissionName)->exists();
                                        $hasPermission = $permissionExists && $mainrole->hasPermissionTo($permissionName);
                                        ?>
                                        <td>
                                            <div class="form-check form-check-primary form-switch">
                                                <input type="checkbox" id="{{ $item->module_slug }}-{{ $permission[0] }}"
                                                    name="permissions[]" class="form-check-input permission-checkbox"
                                                    style="width:33px; height:17px; margin-top: 5px;"
                                                    value="{{ $permissionName }}" {{ $disable }}
                                                    {{ $hasPermission ? 'checked' : '' }}>
                                            </div>
                                            <input type="hidden" name="all_permissions[]" value="{{ $permissionName }}">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
            </div>
        </div>
        @if ($permissionedit)
            <div class="card border-none  text-end">
                <div class="card-footer border-0 p-1">

                    <a href="{{ route('role.index') }}" class="btn btn-secondary"><i data-feather='skip-back'></i>
                        Close</a>

                    <button type="submit" class="btn btn-primary">Save Permissions</button>
                </div>
            </div>
        @endif
        </form>
    @endif
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {

            // Master checkbox (selects all rows and permissions)
            $('.master-checkbox').change(function() {
                var isChecked = $(this).prop('checked');
                $('.row-checkbox, .permission-checkbox:not(:disabled)').prop('checked', isChecked);
            });

            // Row checkbox (selects all permissions in that row)
            $('tbody').on('change', '.row-checkbox', function() {
                var $row = $(this).closest('tr');
                var isChecked = $(this).prop('checked');
                $row.find('.permission-checkbox:not(:disabled)').prop('checked', isChecked);
                updateMasterCheckbox();
            });

            // Permission checkbox (updates row and master checkboxes)
            $('tbody').on('change', '.permission-checkbox', function() {
                var $row = $(this).closest('tr');
                updateRowCheckbox($row);
                updateMasterCheckbox();
            });

            // Initialize checkboxes on page load
            $('tbody tr').each(function() {
                updateRowCheckbox($(this));
            });
            updateMasterCheckbox();

            // Helper functions
            function updateRowCheckbox($row) {
                var allChecked = $row.find('.permission-checkbox:not(:disabled)').length ===
                    $row.find('.permission-checkbox:not(:disabled):checked').length;
                $row.find('.row-checkbox').prop('checked', allChecked);
            }

            function updateMasterCheckbox() {
                var allChecked = $('.permission-checkbox:not(:disabled)').length ===
                    $('.permission-checkbox:not(:disabled):checked').length;
                $('.master-checkbox').prop('checked', allChecked);
            }
        });
    </script>
@endsection
