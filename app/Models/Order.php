<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sub_total',
        'discount',
        'total_shipping_charge',
        'total',
        'total_returned',
        'final_total',
        'status',
        'user_id',
        'ref_agent_id',
    ];

    /**
     * Get the order details for the order.
     */
    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the shippingAddress associated with the order.
     */
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('address_type', 'shipping');
    }

    /**
     * Get the billingAddress associated with the order.
     */
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('address_type', 'billing');
    }

    public function refAgent()
    {
        return $this->belongsTo(User::class, 'ref_agent_id', 'id');
    }
}
