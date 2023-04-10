<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class Image extends Controller
{

    public function store($validator)
    {
        $validator['image'] = Storage::put('/CategoryImage',$validator['image']);
    }

    public function update($validator,$category)
    {
        $validator['image'] = Storage::put('/CategoryImage',$validator['image']);
        Storage::delete($category['image']);
    }

    public function destroy($category)
    {
        Storage::delete($category['image']);
    }
}
