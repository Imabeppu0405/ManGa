<?php

namespace App\Repositories;

use App\Models\Game;

class GameRepository extends BaseRepository
{
    protected $table = 'games';

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
        return Game::updateOrCreate([$targetkey => $targetValue], $param);
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
        return Game::where($targetkey, $targetValue)->delete();
    }

    /**
     * 検索条件を指定して、検索結果を取得する 
     *
     * @param string $title
     * @param int $category_id
     * @param int $hardware_type
     * @param int $user_id
     * @return Collection
     */
    public function search($title, $category_id, $hardware_type, $user_id)
    {
        $query = Game::query();

        // 一覧取得のベースのクエリを作成
        $query->leftJoin('reports', function ($join) use ($user_id) {
                $join->on('games.id', '=', 'reports.game_id')
                    ->where('reports.user_id', '=', $user_id);
            })
            ->orderBy('reports.status_id')
            ->orderBy('games.id', 'DESC');
        
        // 検索内容で絞り込む
        if($title) {
            $query->where('games.title', 'LIKE', '%'.$title.'%');
        }

        if($category_id) {
            $query->where('games.category_id', 'LIKE', $category_id);
        }

        if($hardware_type) {
            $query->where('games.hardware_type', 'LIKE', $hardware_type);
        }

        return $query->select('games.*', 'reports.status_id')->get();
    }
}