<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\MstGameSaveRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
        $games = DB::table('games')
            ->leftJoin('reports', function ($join) {
                $join->on('games.id', '=', 'reports.game_id')
                    ->where('reports.user_id', '=', Auth::id());
            })
            ->orderBy('games.id', 'DESC')
            ->get([
                'games.*',
                'reports.status_id',
            ]);
        $data = [
            'games'   => $games,
            'user_id' => Auth::id()
        ];
        return view('home.index', $data);
    }

    public function mstIndex()
    {
        $games = DB::table('games')->orderBy('games.id', 'DESC')->get();
        $data = [
            'games'   => $games,
            'user_id' => Auth::id()
        ];
        return view('mst.game.index', $data);
    }

    public function save(MstGameSaveRequest $request)
    {
        Game::updateOrCreate(['id' => $request->input('id')], [
            'title'         => $request->input('title'),
            'memo'          => $request->input('memo'),
            'hardware_type' => $request->input('hardware_type'),
            'category_id'   => $request->input('category_id'),
        ]);

        return back();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        Game::where('id', $id)->delete();
        return back();
    }
}