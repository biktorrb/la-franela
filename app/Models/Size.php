<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;

class Size extends Model
{
    protected $fillable = ['name', 'type'];

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
