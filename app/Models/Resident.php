<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'residents';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address_id'
    ];

    public static function getExistingResident(string $email): ?self
    {
        return self::where('email', $email)->get()->first();
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'id');
    }

    public function rides(): HasMany
    {
        return $this->hasMany(Ride::class, 'id');
    }
}
