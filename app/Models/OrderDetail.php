<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_unit_price',
        'product_buy_price',
        'product_size',
        'product_color',
        'product_fabrics',
        'discount',
        'product_quantity',
        'returned_quantity',
        'final_quantity',
        'sub_total',
        'total',
        'returned_amount',
        'final_total',
        'product_id',
        'order_id',
    ];

    /**
     * Get the product that owns the order detail.
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
