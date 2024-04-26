<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'country_id',
        'Status'
    ];

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
}
