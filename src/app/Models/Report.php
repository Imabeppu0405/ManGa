<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = "reports";

    protected $fillable = [
        'memo',
        'game_id',
        'user_id',
        'status_id',
        'start_at',
        'end_at'
    ];

    /**
     * ゲームに紐づく記録を取得
     */
    public function games()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
