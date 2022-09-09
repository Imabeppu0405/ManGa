<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameSearchRequest;
use App\Http\Requests\Game\MstGameDeleteRequest;
use App\Http\Requests\Game\MstGameSaveRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * home画面の表示
     *
     * @param GameSearchRequest $request
     * @return view
     */
    public function index(GameSearchRequest $request)
    {
        // 検索条件の取得
        $title         = $request->input('title');
        $category_id   = $request->input('category_id');
        $hardware_type = $request->input('hardware_type');

        $query = Game::query();

        // 一覧取得のベースのクエリを作成
        $query->leftJoin('reports', function ($join) {
                $join->on('games.id', '=', 'reports.game_id')
                    ->where('reports.user_id', '=', Auth::id());
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

        $games = $query->select('games.*', 'reports.status_id')->get();

        // sql(title=オ, category_id=2でAuth::id=1の人が検索した場合のSQL)
        // SELECT g.*, r.id FROM games as g
        //     LEFT JOIN reports as r 
        //         ON g.id = r.id 
        //         AND r.user_id = 1 
        //     WHERE g.title LIKE '%オ%'
        //         AND g.category_id LIKE 2 
        //     ORDER BY r.status_id, g.id DESC;

        $data = [
            'games'        => $games,
            'search_param' => [
                'title'         => $title,
                'category_id'   => $category_id,
                'hardware_type' => $hardware_type
            ]
        ];
        return view('home.index', $data);
    }

    /**
     * ゲーム管理画面の表示
     *
     * @return view
     */
    public function mstIndex()
    {
        $games = DB::table('games')
            ->orderBy('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();
        $data = [
            'games' => $games,
        ];
        return view('mst.game.index', $data);
    }

    /**
     * ゲーム管理画面にて、ゲームを登録・編集する
     *
     * @param MstGameSaveRequest $request
     * @return void
     */
    public function save(MstGameSaveRequest $request)
    {
        Game::updateOrCreate(['id' => $request->input('id')], [
            'title'         => $request->input('title'),
            'link'          => $request->input('link'),
            'hardware_type' => $request->input('hardware_type'),
            'category_id'   => $request->input('category_id'),
        ]);

        return back();
    }

    /**
     * ゲーム管理画面にて、ゲームを論理削除する
     *
     * @param MstGameDeleteRequest $request
     * @return void
     */
    public function delete(MstGameDeleteRequest $request)
    {
        $id = $request->input('id');
        Game::where('id', $id)->delete();
        return back();
    }
}