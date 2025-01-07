<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'endDate', 'alpha2Code', 'alpha3Code', 'numericCode', 'name', 'flag', 'currency', 'phonePrefix'
    ];

    public function states(): HasMany
    {
        return $this->hasMany(
            \App\Models\State::class,
            'by_country_id'
        );
    }
}
