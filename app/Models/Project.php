<?php

namespace App\Models;

use Filament\Forms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * Get all of the pentestings for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pentestings(): HasMany
    {
        return $this->hasMany(Pentesting::class);
    }

    public function getCountPentestingsAttribute(): int
    {
        return $this->pentestings()->count();
    }

    public static function getForm(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),
        ];
    }
}
