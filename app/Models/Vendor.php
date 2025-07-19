<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Vendor এর সকল অর্ডার প্রাপ্তির relation (hasManyThrough)
    public function orders()
    {
        return $this->hasManyThrough(Order::class, Product::class, 'vendor_id', 'product_id');
        // vendor_id is foreign key on products table
        // product_id is foreign key on orders table
    }
}
