<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $data = [
            'games'    => Game::orderBy('id', 'DESC')->get(),
            'user_id' => Auth::id()
        ];
        return view('home.index', $data);
    }

    public function save(Request $request)
    {
        $res = Report::create([
            'memo'      => $request->input('memo'),
            'game_id'   => $request->input('game_id'),
            'user_id'   => $request->input('user_id'),
            'status_id' => $request->input('user_id'),
            'start_at'  => $request->input('start_at'),
            'end_at'    => $request->input('end_at'),
        ]);
        return json_encode($res);
    }
}