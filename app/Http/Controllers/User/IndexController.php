<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Filters\UserFilter;
use App\Models\Traits;
use App\Models\CollectionList as ModelsCollectionList;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {

        $this->authorize('view', auth()->user());
        $data = $request->validated();
        $filter = app()->make(UserFilter::class, ['queryParams' => array_filter($data)]);
        $data = User::filter($filter);

        if (isset($request['orderBy'])&& isset($request['sort'])) {
            return $data->orderBy($request['orderBy'], $request['sort'])->get();
        }
        elseif (isset($request['orderBy'])&& !isset($request['sort'])){
            return $data->orderBy($request['orderBy'], 'asc')->get();
        }
        elseif (isset($request['name'])){
            $data->where('name','like',"%{$request['name']}%")->get();
        }
        elseif (isset($request['email'])) {
            $data->where('email', 'like', "%{$request['email']}%")->get();
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

