<?php

namespace App\Http\Controllers\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReportFilter extends AbstractFilter
{
    public const TOTAL_COST = 'total_cost';
    public const TOTAL_ORDERS = 'total_orders';
    public const CREATED_AT = 'created_at';


    protected function getCallbacks(): array
    {
        return [
            self::TOTAL_COST => [$this, 'total_cost'],
            self::TOTAL_ORDERS => [$this, 'total_orders'],
            self::CREATED_AT => [$this, 'created_at'],
        ];
    }

    public function total_cost(Builder $builder, $value)
    {
        $builder->where('total_cost', 'like', "%{$value}%");
    }

    public function total_orders(Builder $builder, $value)
    {
        $builder->where('total_orders', 'like', "%{$value}%");
    }

    public function created_at(Builder $builder, $value)
    {
        $builder->where('created_at','like', "%{$value}%");
    }
}
