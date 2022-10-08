<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SteamApiGetNewsRequest;

class SteamApiController extends Controller
{
    /**
     * ゲームニュースの取得
     *
     * @param SteamApiGetNewsRequest $request
     * @return view
     */
    public function getNews(SteamApiGetNewsRequest $request)
    {
        $url = "https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?appid=" . $request->input('steam_id') . "&count=3";

        $option = [
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_TIMEOUT        => 3,
        ];
    
        $curl = curl_init($url);
        curl_setopt_array($curl, $option);
    
        $news  = curl_exec($curl);
        $info  = curl_getinfo($curl);
        $errNo = curl_errno($curl);
    
        // OK以外もしくは200以外の場合は空白配列を返す
        if ($errNo !== CURLE_OK || $info['http_code'] !== 200) {
            return [];
        }
    
        return json_encode($news);
    }
}