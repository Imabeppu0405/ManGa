<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('id', 'DESC')->get();
        return view('home.index', compact('games'));
    }
}
