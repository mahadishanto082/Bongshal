<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'slug',
        'parent_id',
        'name',
        'description',
        'image',
        'status',
        'feature',
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products ()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->orderBy('sort', 'ASC');
    }


}
