<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Maker;
use App\Models\ProductVariant;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    protected $fillable = ['name', 'description', 'maker_id', 'category_id', 'is_active', 'is_featured'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
