<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliver_id',
        'name',
        'phone',
        'address',
        'gender',
    ];
}
