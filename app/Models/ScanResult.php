<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class ScanResult extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    public $timestamps = false;
    protected $guarded = ['id'];
}
