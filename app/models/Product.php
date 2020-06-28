<?php

namespace App\models;

use App\Scopes\SellerproductScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $with = ['product_variants', 'skus', 'categories', 'subcategories', 'images'];
    public function sales()
    {
        return $this->belongsToMany(Sale::class);
        // return $this->belongsToMany('App\models\Sale')->using('App\models\ProductSale');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }



    // Product relationships
    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function product_options()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    // public function variant_values()
    // {
    //     return $this->hasMany(VariantValue::class);
    // }
    public function skus()
    {
        return $this->hasMany(Sku::class);
    }



    protected static function boot()
    {
        parent::boot();
    }
}
