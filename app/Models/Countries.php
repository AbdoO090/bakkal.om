<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name_en',
        'name_ar',
        'id',
        'phone_code',
        'capital',
        'currency',
        'currency_code',
        'continent',
        'continent_code'
    ];
}
