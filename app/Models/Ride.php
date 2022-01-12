<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ride extends Model
{
    use HasFactory;

    protected $table = 'rides';
    protected $fillable = [
        'resident_id',
        'company_id',
        'pickup_address_id',
        'drop_off_address_id',
        'distance',
        'pickup_date'
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function pickupAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'id');
    }

    public function dropOffAddress(): HasOne
    {
        return $this->hasOne(Address::class, 'id');
    }
}
