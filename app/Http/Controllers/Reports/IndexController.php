<?php

namespace App\Http\Controllers\Reports;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Filters\ReportFilter;
use App\Http\Requests\Reports\IndexRequest;
use App\Models\Order;
use App\Http\Controllers\Filters\OrderFilter;
use App\Models\Report;
use App\Models\User;
use App\Policies\ReportPolicy;


class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $this->authorize('view', auth()->user());
        $data = $request->validated();
        $filter = app()->make(ReportFilter::class,['queryParams'=>array_filter($data)]);
        $data = Report::filter($filter);
        if (isset($request['orderBy'])&& isset($request['sort'])) {
            return $data->orderBy($request['orderBy'], $request['sort'])->get();
        }
        elseif (isset($request['orderBy'])&& !isset($request['sort'])){
            return $data->orderBy($request['orderBy'], 'asc')->get();
        }
        if ($data)
            return $data->get();
        else {
            return response()->json([
                'status' => 404,
                'message' => 'Ошибка'
            ], 404);
        }

    }
}

