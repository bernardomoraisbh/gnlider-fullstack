<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends Model
{
    protected $fillable = [
        'endDate', 'name', 'abbreviation', 'phonePrefix', 'country_id'
    ];

    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\Country::class, 'by_country_id');
    }
}
