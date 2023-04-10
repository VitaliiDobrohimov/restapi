<?php

namespace App\Http\Controllers\Filters;

use Illuminate\Database\Eloquent\Builder;

class DishesFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const COMPOSITION = 'composition';
    public const COST = 'cost';
    public const CALORIES = 'calories';


    protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::COMPOSITION => [$this, 'composition'],
            self::COST => [$this, 'cost'],
            self::CALORIES => [$this, 'calories'],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function composition(Builder $builder, $value)
    {
        $builder->where('composition', 'like', "%{$value}%");
    }

    public function cost(Builder $builder, $value)
    {
        $builder->where('cost', $value);
    }
    public function calories(Builder $builder, $value)
    {
        $builder->where('calories', $value);
    }
}
