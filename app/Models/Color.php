<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;

class Color extends Model
{
    protected $fillable = ['name', 'hex_code'];

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
