<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'end_date',
        'alpha2_code',
        'alpha3_code',
        'numeric_code',
        'code',
        'name',
        'flag',
        'currency',
        'phone_prefix'
    ];

    public function states(): HasMany
    {
        return $this->hasMany(
            \App\Models\State::class,
            'by_country_id'
        );
    }
}
