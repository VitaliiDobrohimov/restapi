<?php

namespace App\Http\Controllers\Reports;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;


use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use App\Policies\ReportPolicy;


class ShowController extends Controller
{
    public function __invoke($id){
        $this->authorize('view', ReportPolicy::class);
        $report = Report::find($id);
        if ($report){
            return response()->json([
                'status' => 200,
                'report' => $report,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Нет отчета под таким номером'
            ],404);
        }
    }



}
