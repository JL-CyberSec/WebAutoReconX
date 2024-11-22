<?php

namespace App\Models;

use App\Enums\NmapTiming;
use App\Enums\ScanType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Filament\Forms;

class Scan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nmap_timing',
        'pentesting_id',
        'ip'
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

    public function getNameNmapTimingAttribute(): string
    {
        return NmapTiming::toArray()[$this->nmap_timing];
    }

    public function pentesting(): BelongsTo
    {
        return $this->belongsTo(Pentesting::class);
    }

    public static function getForm(?int $pentestingId = null): array
    {
        return [
            Forms\Components\Select::make('pentesting_id')
                ->relationship('pentesting', 'title')
                ->createOptionForm(Pentesting::getForm())
                ->editOptionForm(Pentesting::getForm())
                ->required()
                ->disabled(!empty($pentestingId))
                ->default($pentestingId),
            Forms\Components\Select::make('nmap_timing')
                ->options(NmapTiming::toArray())
                ->required(),
        ];
    }
}
