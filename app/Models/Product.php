<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'type',
        'slug',
        'category_id',
        'brand_id',
        'merchant_id',
        'code',
        'name',
        'buy_price',
        'price',
        'discount_type',
        'discount_value',
        'stock',
        'point',
        'shipping_in_dhaka',
        'shipping_out_dhaka',
        'writer_id',
        'first_release',
        'language',
        'size',
        'color',
        'fabrics',
        'weight',
        'warranty',
        'description',
        'delivery_info',
        'image',
        'status',
        'feature',
        'sort',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class, 'writer_id', 'id');
    }
}
