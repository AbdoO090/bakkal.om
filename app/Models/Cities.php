<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'id',
        'state_id',
        'Status',
        'charge'
    ];

    public function state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }
}
