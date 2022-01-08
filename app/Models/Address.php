<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $fillable = [
        'street_name',
        'house_number',
        'zipcode',
        'city'
    ];

    public static function getExistingAddress(string $houseNumber, string $zipcode): ?self
    {
        return self::where('house_number',$houseNumber)->where('zipcode', $zipcode)->get()->first();
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'address_id');
    }

    public function pickupAddress(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'pickup_address_id');
    }

    public function dropOffAddress(): BelongsTo
    {
        return $this->belongsTo(Ride::class, 'drop_off_address_id');
    }
}
