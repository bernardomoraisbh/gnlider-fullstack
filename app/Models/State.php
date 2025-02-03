<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $fillable = [
        'end_date',
        'name',
        'abbreviation',
        'phone_prefix',
        'country_id'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\Country::class, 'by_country_id');
    }
}
