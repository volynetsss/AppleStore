<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'email',
        'country',
        'city',
        'address',
        'pincode',
        'message',
        'tracking_no',
        'status',
    ];
}
