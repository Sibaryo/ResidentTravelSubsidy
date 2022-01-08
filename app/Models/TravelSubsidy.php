<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelSubsidy extends Model
{
    use HasFactory;

    protected $table = 'travel_subsidies';
    protected $fillable = [
        'resident_id',
        'distance',
        'active'
    ];

    public static function getValidSubsidy(int $residentId): ?self
    {
        return self::where('resident_id', $residentId)->where('active', 1)->get()->first();
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
