<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'size_id', 'color_id', 'stock', 'price', 'discount', 'sku'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
