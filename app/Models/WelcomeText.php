<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelcomeText extends Model
{
    use HasFactory;

    protected $table = 'welcome_texts';

    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    public function getStatusAttribute($value)
    {
        return $value === 'Active' ? 'Active' : 'Inactive';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value === 'Active' ? 'Active' : 'Inactive';
    }
}
