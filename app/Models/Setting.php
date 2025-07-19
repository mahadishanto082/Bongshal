<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'title',
        'address',
        'email',
        'email_2',
        'mobile',
        'mobile_2',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'twitter',
        'logo',
        'shipping_in_dhaka',
        'shipping_out_dhaka',
    ];
}
