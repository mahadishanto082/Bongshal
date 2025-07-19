<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderApproval extends Model
{
    use HasFactory;

    // Table name if not default 'order_approvals'
    // protected $table = 'order_approvals';

    // Mass assignable fields
    protected $fillable = [
        'order_id',
        'status',      // e.g., 'pending', 'approved', 'rejected'
        'approved_by', // user id who approved/rejected (optional)
        'remarks',
        'vendor_id'     // any remarks or notes (optional)
    ];

    /**
     * Relationship to Order model (assuming you have an Order model).
     */

     public function vendor()
     {
         return $this->belongsTo(User::class, 'vendor_id');
     }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship to User model for who approved/rejected
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }


}
