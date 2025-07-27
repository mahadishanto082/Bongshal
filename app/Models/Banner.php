<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'title',
        'image',
        'status',
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    // Accessor for status label
    public function getStatusLabelAttribute()
    {
        return $this->status === 'Active' ? 'success' : 'danger';
    }
}
