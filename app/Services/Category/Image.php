<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Filters\UserFilter;
use App\Http\Requests\Category\StoreRequest;
use App\Models\User;

class Image extends Controller
{

    public function store($validator)
    {
        $validator['image'] = Storage::put('/CategoryImage',$validator['image']);
    }

    public function update($validator,$category)
    {

        Storage::delete($category['image']);
    }

    public function destroy($category)
    {
        Storage::delete($category['image']);
    }
}
