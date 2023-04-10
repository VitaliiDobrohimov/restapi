<?php

namespace App\Http\Controllers\Filters;
use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $builder);
}
