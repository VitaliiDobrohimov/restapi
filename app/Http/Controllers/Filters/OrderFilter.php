<?php

namespace App\Http\Controllers\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends AbstractFilter
{
    public const NUMBER = 'number';
    public const TOTAL_COST = 'total_cost';
    public const DATE_CLOSED = 'date_closed';
    public const WAITER_ID = 'waiter_id';


    protected function getCallbacks(): array
    {
        return [
            self::NUMBER => [$this, 'number'],
            self::TOTAL_COST => [$this, 'total_cost'],
            self::DATE_CLOSED => [$this, 'date_closed'],
            self::WAITER_ID => [$this, 'waiter_id'],
        ];
    }

    public function number(Builder $builder, $value)
    {
        $builder->where('number', 'like', "%{$value}%");
    }

    public function total_cost(Builder $builder, $value)
    {
        $builder->where('total_cost', 'like', "%{$value}%");
    }

    public function date_closed(Builder $builder, $value)
    {
        $builder->where('date_closed', $value);
    }
    public function waiter_id(Builder $builder, $value)
    {
        $builder->where('waiter_id', $value);
    }
}
