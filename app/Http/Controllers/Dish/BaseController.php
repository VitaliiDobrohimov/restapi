<?php

namespace App\Http\Controllers\Dish;

use App\Http\Controllers\Controller;
use App\Services\Dishes\DishImage;

class BaseController extends Controller
{
 public  $service;
 public function __construct(DishImage $service)
 {
        $this->service =$service;
 }
}
