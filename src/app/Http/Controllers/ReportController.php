<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\ReportDeleteRequest;
use App\Http\Requests\Report\ReportSaveRequest;
use App\Repositories\ReportRepository;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->ReportRepository = $reportRepository;
    }
    /**
     * アカウント画面の表示
     *
     * @return view
     */
    public function index()
    {
        $reports = $this->ReportRepository->getListByUserId(Auth::id());

        // status_idによって分類する
        $favorite_reports = $reports->where('status_id', 1);
        $stack_reports    = $reports->where('status_id', 2);
        $clear_reports    = $reports->where('status_id', 3);

        $data = [
            'favorite_reports' => $favorite_reports,
            'stack_reports'    => $stack_reports,
            'clear_reports'    => $clear_reports,
            'favorite_counts'  => $favorite_reports->count(),
            'stack_counts'     => $stack_reports->count(),
            'clear_counts'     => $clear_reports->count(),
        ];
        return view('account.index', $data);
    }

    /**
     * ゲーム記録を登録・編集する
     *
     * @param ReportSaveRequest $request
     * @return void
     */
    public function save(ReportSaveRequest $request)
    {
        $this->ReportRepository->updateOrCreate('id', $request->input('report_id'), [
            'memo'      => $request->input('memo'),
            'game_id'   => $request->input('game_id'),
            'user_id'   => Auth::id(),
            'status_id' => $request->input('status_id'),
            'start_at'  => $request->input('start_at'),
            'end_at'    => $request->input('end_at'),
        ]);

        return back();
    }

    /**
     * ゲーム記録を論理削除する
     *
     * @param ReportDeleteRequest $request
     * @return void
     */
    public function delete(ReportDeleteRequest $request)
    {
        $id = $request->input('id');
        $this->ReportRepository->delete('id', $id);
        return back();
    }
}
