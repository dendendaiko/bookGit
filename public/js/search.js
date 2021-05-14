//絞り込み機能設定
//ajax通信

$('.search #search_on').on('click', function() {

    // 絞り込み単語を取得
    let request = $('#search_name').val();

    // フォームが空のとき
    if(!request) {
        alert("検索する単語をいれてください");
        return false;

    }

    $.ajax ({
        type:'GET',
        url:'localhost/book/list/' + request,
        data:{
            'search_name': request,
        },
        cache: false,
        dataType:'json',
        timeout:3000

    })
    .done (function (data) {
        alert("通信に成功しました");

    })

    .fail(function(jqXHR,textStatus,errorThrown){
        alert("ファイルの取得に失敗しました。");
        console.log("ajax通信に失敗しました");
        console.log(jqXHR.status);
        console.log(textStatus);
        console.log(errorThrown);
    })

})
