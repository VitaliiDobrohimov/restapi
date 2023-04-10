<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\Image;

class BaseController extends Controller
{
 public  $service;
 public function __construct(Image $service)
 {
        $this->service =$service;
 }
}
