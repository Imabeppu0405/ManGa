<?php

namespace App\Repositories;

use App\Models\Report;

class ReportRepository extends BaseRepository
{
    protected $table = 'reports';

    /**
     * targetkeyに対応する値がDBにない場合は作成、ある場合は更新する
     *
     * @param string $targetkey
     * @param mixed $targetValue
     * @param array $param
     * @return void
     */
    public function updateOrCreate(string $targetkey = 'id', mixed $targetValue, array $param) 
    {
        return Report::updateOrCreate([$targetkey => $targetValue], $param);
    }
    
    /**
     * 削除条件を指定して、論理削除を実行する
     *
     * @param string $targetkey
     * @param mixed $targetValue
     * @return void
     */
    public function delete(string $targetkey = 'id', mixed $targetValue) 
    {
        return Report::where($targetkey, $targetValue)->delete();
    }

    /**
     * ユーザーIDに基づいてゲーム記録のリストを取得する
     *
     * @param int $user_id
     * @return Collection
     */
    public function getListByUserId($user_id)
    {
        return Report::query()
            ->join('games', function ($join) use ($user_id) {
                $join->on('reports.game_id', '=', 'games.id')
                    ->where('reports.user_id', '=', $user_id);
            })
            ->orderBy('reports.id', 'DESC')
            ->select('reports.*', 'games.title', 'games.link', 'games.hardware_type', 'games.category_id')
            ->get();
    }

    /**
     * ゲームIDに基づいて特定のユーザーを除くゲーム記録のリストを取得する
     *
     * @param int $game_id
     * @return Collection
     */
    public function getListByGameId($game_id, $user_id)
    {
        return Report::query()
            ->join('users', function ($join) {
                $join->on('reports.user_id', '=', 'users.id');
            })
            ->where('game_id', '=', $game_id)
            ->where('user_id', '!=', $user_id)
            ->orderBy('id', 'DESC')
            ->select('reports.*', 'users.name')
            ->get();
    }
    
    /**
     * 該当のゲームについて、記録をそのユーザーがもっているかどうか
     *
     * @param int $game_id
     * @param int $user_id
     * @return Collection
     */
    public function isReported($game_id, $user_id)
    {
        return Report::query()
            ->where('game_id', '=', $game_id)
            ->where('user_id', '=', $user_id)
            ->exists();
    }
}