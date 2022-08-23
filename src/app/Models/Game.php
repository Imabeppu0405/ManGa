<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = "games";

    protected $fillable = [
        'title',
        'memo',
        'hardware_type',
        'status_id',
        'start_at',
        'end_at'
    ];
}
