<?php

namespace App\Models;

use App\Enums\NmapTiming;
use App\Enums\ScanType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'nmap_timing',
        'pentesting_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pentesting_id' => 'integer',
    ];

    public function getNameTypeAttribute(): string
    {
        return ScanType::toArray()[$this->type];
    }

    public function getNameNmapTimingAttribute($value): string
    {
        return NmapTiming::toArray()[$this->nmap_timing];
    }

    public function getNamePentestingAttribute(): string
    {
        return $this->pentesting->title;
    }

    public function pentesting(): BelongsTo
    {
        return $this->belongsTo(Pentesting::class);
    }
}
