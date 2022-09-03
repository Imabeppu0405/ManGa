<?php

namespace App\Http\Controllers;

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
}