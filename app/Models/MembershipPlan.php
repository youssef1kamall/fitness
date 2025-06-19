<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'features',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'float',
    ];
}
