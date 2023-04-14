<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BuyerScope implements Scope
{
    
    // lo que hace es modificar la consulta del modelo y agregarle consultas adicionales
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('transactions');
    }
}