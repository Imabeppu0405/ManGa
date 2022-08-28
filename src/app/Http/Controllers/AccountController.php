<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')
            ->join('games', function ($join) {
                $join->on('reports.game_id', '=', 'games.id')
                    ->where('reports.user_id', '=', Auth::id());
            })
            ->orderBy('reports.id', 'DESC')
            ->get();
        $data = [
            'reports'   => $reports,
            'user_id' => Auth::id()
        ];
        return view('account.index', $data);
    }
}
