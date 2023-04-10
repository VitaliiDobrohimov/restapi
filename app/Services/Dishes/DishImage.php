<?php

namespace App\Services\Dishes;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DishImage extends Controller
{

    public function store($validator)
    {
        $validator['image'] = Storage::put('/DishesImage',$validator['image']);
    }

    public function update($validator,$dish)
    {
        $validator['image'] = Storage::put('/DishesImage',$validator['image']);
        Storage::delete($dish['image']);
    }

    public function destroy($dish)
    {
        Storage::delete($dish['image']);
    }
}
