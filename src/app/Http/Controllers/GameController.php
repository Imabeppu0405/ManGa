<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\GameSearchRequest;
use App\Http\Requests\Game\MstGameDeleteRequest;
use App\Http\Requests\Game\MstGameSaveRequest;
use App\Repositories\GameRepository;
use App\Repositories\ReportRepository;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private GameRepository $gameRepository;
    private ReportRepository $reportRepository;

    public function __construct(GameRepository $gameRepository, ReportRepository $reportRepository)
    {
        $this->GameRepository   = $gameRepository;
        $this->ReportRepository = $reportRepository;
    }

    /**
     * home画面の表示
     *
     * @param GameSearchRequest $request
     * @return view
     */
    public function index(GameSearchRequest $request)
    {
        $title         = $request->input('title');
        $category_id   = $request->input('category_id');
        $hardware_type = $request->input('hardware_type');

        $games = $this->GameRepository->search($title, $category_id, $hardware_type, Auth::id());
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
     * ゲーム詳細画面の表示
     *
     * @param int $id
     * @return view
     */
    public function show(int $id)
    {
        $game = $this->GameRepository->getOne($id);
        $user_id = Auth::id();
        $isRepoted = $this->ReportRepository->isReported($game->id, $user_id);

        $data = [
            'game'       => $game,
            'reports'    => $this->ReportRepository->getListByGameId($id, Auth::id()),
            'isReported' => $isRepoted
        ];
        return view('show.game.index', $data);
    }

    /**
     * ゲーム管理画面の表示
     *
     * @return view
     */
    public function mstIndex()
    {
        $games = $this->GameRepository->getListWithLeft('DESC');
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
        $this->GameRepository->updateOrCreate('id', $request->input('id'), [
            'title'         => $request->input('title'),
            'link'          => $request->input('link'),
            'steam_id'      => $request->input('steam_id'),
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
        $this->GameRepository->delete('id', $id);
        return back();
    }
}