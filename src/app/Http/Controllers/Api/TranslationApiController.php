<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TranslationApiTranslateRequest;

class TranslationApiController extends Controller
{
    /**
     * ゲームニュースの翻訳
     *
     * @param TranslationApiTranslateRequest $request
     * @return view
     */
    public function translate(TranslationApiTranslateRequest $request)
    {
        $apiKey = 'f114d13f-f882-aebe-2dee-0ef57f830218:fx';
        $url = "https://api-free.deepl.com/v2/translate" . "?auth_key=" . $apiKey . "&text=" . $request->input('text') . "&source_lang=EN&target_lang=JA";
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