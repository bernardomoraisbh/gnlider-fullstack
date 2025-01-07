<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\User::class, 'by_user_id');
    }
}
