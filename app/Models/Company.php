<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'company_name',
        'email',
        'phone_number',
        'address_id'
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'id');
    }

    public function rides(): HasMany
    {
        return $this->hasMany(Ride::class, 'id');
    }
}
