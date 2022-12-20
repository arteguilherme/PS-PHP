<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    public function typeVehicle(): BelongsTo
    {
        return $this->belongsTo(TypeVehicle::class);
    }

    public function getCriadoEmAttribute($value): Carbon
    {
        return $this->attributes['criado_em'] = Carbon::parse($value);
    }
}
