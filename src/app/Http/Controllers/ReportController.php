<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\ReportSaveRequest;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DB::table('reports')
            ->join('games', function ($join) {
                $join->on('reports.game_id', '=', 'games.id')
                    ->where('reports.user_id', '=', Auth::id());
            })
            ->orderBy('reports.id', 'DESC')
            ->select('reports.*', 'games.title', 'games.hardware_type', 'games.category_id')
            ->get();
        $favorite_reports = $reports->where('status_id', 0);
        $stack_reports    = $reports->where('status_id', 1);
        $clear_reports    = $reports->where('status_id', 2);
        
        $data = [
            'favorite_reports' => $favorite_reports,
            'stack_reports'    => $stack_reports,
            'clear_reports'    => $clear_reports,
        ];
        return view('account.index', $data);
    }

    public function save(ReportSaveRequest $request)
    {
        Report::updateOrCreate(['id' => $request->input('report_id')], [
            'memo'      => $request->input('memo'),
            'game_id'   => $request->input('game_id'),
            'user_id'   => Auth::id(),
            'status_id' => $request->input('status_id'),
            'start_at'  => $request->input('start_at'),
            'end_at'    => $request->input('end_at'),
        ]);

        return back();
    }
}
