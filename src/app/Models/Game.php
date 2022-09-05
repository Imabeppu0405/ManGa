<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "games";

    protected $fillable = [
        'title',
        'link',
        'hardware_type',
        'category_id',
    ];

    /**
     * ゲームに紐づく記録を取得
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'game_id', 'id');
    }
}
