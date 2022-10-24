window.onload = function(){
    let text = 'apple';
    const postData = new FormData;
    postData.set('text', text);

    fetch('/api/translate', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content},
        body: postData
    })
        .then(response => response.json())
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            // エラー時
            console.log(error);
        });
}