<?php

namespace App\Http\Controllers;

use App\Models\Nex_Market;
use App\Models\Nex_script;
use App\Models\Nex_script_expire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HelperController extends Controller
{


    #bulk Actions..
    public function bulkAction(Request $request)
    {
        if (!$request->route('table_name'))
            return faildResponse(['Message' => 'Provided All Information!']);

        $table = decrypt_to(urlencode($request->route('table_name')));



        $ids = $request->input('ids');
        $action = $request->input(key: 'action');
        $column_name = $request->route('column_name') ? decrypt_to(urlencode($request->route('column_name'))) : 'status';

        if (!Schema::hasTable($table))
            return faildResponse(['Message' => 'Invalid Table!']);

        if (!Schema::hasColumn($table, $column_name))
            return faildResponse(['Message' => 'Invalid Columan!']);


        $affected = DB::table($table)
            ->whereIN('id', $ids);

        $affected = $action == "delete" ? $affected->delete() : $affected->update([$column_name => $action]);

        return $affected
            ? successResponse(['Message' => $action == "delete" ? 'All chosen records have been successfully deleted.' : 'The status of all selected records has been successfully changed to ' . $action . '.'])
            : faildResponse(['Message' => 'Bulk Action Failed!']);
    }
    #----------------------------------------------------------------


    public function changeStatus(Request $request)
    {

        if (!$request->route('table_name') || !$request->route('id'))
            return faildResponse(['Message' => 'Provided All Information!']);

        $table = decrypt_to(urlencode($request->route('table_name')));
        $id = decrypt_to(urlencode($request->route('id')));


        $status_column_name = $request->route('status_column_name') ? decrypt_to(urlencode($request->route('status_column_name'))) : $table . '_status';

        if (!Schema::hasTable($table))
            return faildResponse(['Message' => 'Invalid Table!']);

        if (!Schema::hasColumn($table, $status_column_name))
            return faildResponse(['Message' => 'Invalid Columan!']);

        $users = DB::table($table)->where('id', $id)->first();
        if (empty($users))
            return faildResponse(['Message' => 'Invalid Id Of Table!']);

        $status = $users->{$status_column_name} == 'deactive' ? 'active' : 'deactive';

        $affected = DB::table($table)->where('id', $id)->update([$status_column_name => $status]);

        if ($affected)
            return successResponse(['Message' => 'Status Update Successfully!']);

        return faildResponse(['Message' => 'Something went wrong!']);
    }
    #----------------------------------------------------------------

    #----------------------------------------------------------------
    #helper function to delete record
    public function deleteRecord(Request $request)
    {
        if (!$request->route('table_name') || !$request->route('id'))
            return faildResponse(['Message' => 'Provided All Information!']);

        $table = decrypt_to(urlencode($request->route('table_name')));
        $id = decrypt_to(urlencode($request->route('id')));

        if (!Schema::hasTable($table))
            return faildResponse(['Message' => 'Invalid Table!']);

        $affected = DB::table($table)->where('id', $id)->delete();

        if ($affected)
            ;
        return successResponse(['Message' => 'Record Deleted Successfully!']);

        return faildResponse(['Message' => 'Something went wrong!']);
    }
    #----------------------------------------------------------------

    #----------------------------------------------------------------
    #helper function to get record
    public function getRecord(Request $request)
    {

        if (!$request->route('table_name') || !$request->route('id'))
            return faildResponse(['Message' => 'Provided All Information!']);

        $table = decrypt_to(urlencode($request->route('table_name')));
        $id = decrypt_to(urlencode($request->route('id')));

        if (!Schema::hasTable($table))
            return faildResponse(['Message' => 'Invalid Table!']);

        $data = DB::table($table)->where('id', $id)->first();

        if ($data)
            ;
        return successResponse(['Message' => 'Record Fetched Successfully!', 'Data' => $data]);

        return faildResponse(['Message' => 'Something went wrong!']);
    }
    #----------------------------------------------------------------

    #----------------------------------------------------------------
    #function to delete the images

    public function deleteImageFromHelper(Request $request)
    {

        $table = $request->table;
        $id = $request->id;
        $image = $request->image;
        $column = $request->column;

        // dd($table, $id, $image, $column);

        // Call your helper function
        $result = deleteImage($table, $id, $image, $column);

        return response()->json($result);
    }

}

