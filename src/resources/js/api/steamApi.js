window.onload = function(){
    const postData = new FormData;
    postData.set('steam_id', document.getElementById('steamId').value); 

    fetch('/api/getNews', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
        body: postData
    })
        .then(response => response.json())
        .then(response => {
            if(response.length) {
                // News情報が取得できた場合
                const news = JSON.parse(response)['appnews']['newsitems'];
                const newsCont = document.getElementById('newsCont');
                const fetches = [];
                const translatedData = [];
                for (let i = 0 ; i < news.length ; i++) {
                    // 翻訳用fetchの作成
                    fetches.push(
                        translationFetch(translatedData, 'title' + i, encodeURIComponent(news[i]['title']))
                        ,translationFetch(translatedData, 'content' + i, encodeURIComponent(omittedText(news[i]['contents'])))
                    );
                }

                Promise.all(fetches).then(function() {
                    // 翻訳fetchを実行後、各News情報のHTML組み立て
                    let newsItems = '';
                    for (let i = 0 ; i < news.length ; i++){
                        newsItems += '<div class="flex flex-col border rounded-lg gap-3 p-4 md:p-6 m-2 w-96">'
                                + '<div>'
                                + '<span class="block text-sm md:text-base font-bold">' 
                                + translatedData['title' + i]
                                + '</span>'
                                + '</div>'
                                + '<p class="text-gray-600 break-words">'
                                + translatedData['content' + i]
                                + '</p>'
                                + '<a href="'
                                +  news[i]['url']
                                + '" target="_blank" class="text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center w-40">'
                                + 'Read more'
                                + '<svg class="-mr-1 ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>'
                                + '</a>'
                                + '</div>';
                    }
                    newsCont.innerHTML = newsItems;
                });
            } else {
                // News情報が取得できなかった場合
                newsCont.innerHTML = '<div class="p-6 text-xl h-40">ニュースを取得できませんでした</div>';
            }
        })
        .catch(error => {
            // エラー時
            newsCont.innerHTML = '<div class="p-6 text-xl h-40">ニュースを取得できませんでした</div>';
        });
}

function omittedText(string) {
    // HTMLタグは不要なため削除
    string = string.replace(/(<([^>]+)>)/gi, '');
    const MAX_LENGTH = 100;

    // 文字数がMAX_LENGTHより大きい場合、それ以上は削除し末尾に...を付け足して返す。
    if (string.length > MAX_LENGTH) {
        return string.substr(0, MAX_LENGTH) + '...';
    }
    //　文字数がオーバーしていなければそのまま返す
    return string;
}

function translationFetch(translatedData, key, text) {
    const postDataForTranslate = new FormData;
    postDataForTranslate.set('text', text);
    return fetch('/api/translate', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
        body: postDataForTranslate
    })
        .then(response => response.json())
        .then(response => {
            translatedData[key] = JSON.parse(response).translations[0].text;
        })
        .catch(error => {
            // エラー時
            console.log(error);
        });
}