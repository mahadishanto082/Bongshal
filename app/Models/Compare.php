<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with User (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
