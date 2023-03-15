<?php

namespace App\Filters;

class ProductFilter extends QueryFilter
{
    public function rules(): array
    {
        return ['search' => 'filled'];
    }

    public function Search($query, $value)
    {
        return $query->where('name', 'like', "%{$value}%");
    }
}
