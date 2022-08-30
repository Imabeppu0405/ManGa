<?php

namespace App\Http\Controllers;

use App\Models\Report;
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

    public function save(Request $request)
    {
        Report::updateOrCreate(['id' => $request->input('report_id')], [
            'memo'      => $request->input('memo'),
            'game_id'   => $request->input('game_id'),
            'user_id'   => $request->input('user_id'),
            'status_id' => $request->input('status_id'),
            'start_at'  => $request->input('start_at'),
            'end_at'    => $request->input('end_at'),
        ]);

        return back();
    }
}