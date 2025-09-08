<?php

namespace App\Http\Controllers;

use App\Models\Summaryboxes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SummaryboxesController extends Controller
{

    public function store(Request $request)
    {
        $id = $request->input('id');

        $validator = Validator::make($request->all(), [
            'box_title' => 'required',
            'aggregate_val' => 'required|in:count,sum,avg,max,min',
            'table_name' => 'required',
            'column_name' => 'required',
            'box_icon' => 'required',
            'box_theme' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);


        $summeybox = Summaryboxes::updateOrCreate(
            ['id' => $id], // Condition for update or create new module
            [
                'box_title' => $request->input('box_title'),
                'aggregate_val' => $request->input('aggregate_val'),
                'table_name' => $request->input('table_name'),
                'column_name' => $request->input('column_name'),
                'box_icon' => $request->input('box_icon'),
                'box_theme' => $request->input('box_theme')
            ]
        );

        $responseData = $summeybox
            ? ['success' => true, 'Status' => 200, 'Message' => 'The sidebar has been saved successfully.', 'Redirect' => url()->previous()]
            : ['success' => false, 'Status' => 500, 'Message' => 'Module could not be saved.'];

        return response()->json($responseData);
    }

    public function boxes_sort(Request $request)
    {
        try {
            $BoxesData = $request->json()->all();
            foreach ($BoxesData as $box) {
                $updated = Summaryboxes::where('id', $box['id'])->update(['box_sort' => $box['position']]);

                if (!$updated)
                    continue;
            }

            return response()->json(['status' => 200, 'message' => 'Order updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Failed to update order!']);
        }
    }
}
