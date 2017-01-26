$(function(){
  // getComment();
  setInterval(getComment,10000);
});

function getComment(){
var id =  $('#contentArea > .content:eq(0) > input:hidden').attr("value");
console.log(id);

$.ajax({
  type:"POST",
  url: "searchNewComment.php",
  data: 'content_id='+ id,
  success: function(data){
    $('#contentArea').prepend(data);
    console.log(data);
  }
});

}

//コメント一覧での返信表示
function showReply(num,point){//コメントID、返信件数
  if(point === 0){
    //返信件数が0なら何もしない
  }else{//返信件数が1以上なら表示
  if($('.replyDisplay'+num).val() == "閉じる"){//ボタンの値が”閉じる”なら返信一覧を消す
    $('.add'+num).empty();
    $('.replyDisplay'+num).val(point+'件の返信');
    console.log("クローズ！！");
  }else{//ボタンの値が"閉じる"でなかった場合はajax起動
  $.ajax({
    type: "POST",//GET形式で送信
    url: "toolAct.php",//送り先、tool.phpを呼び出して、返信を取得する
    data:'data='+num,//dataという名前でnumの値を送信
                     //送り先で$_GET["data"]で取得可能
    success: function(html){//処理に成功した場合、echoで出力したhtml要素が返ってくる
      $('.add'+num).append(html);//空のdivにhtml要素をぶちこむ
      $('.replyDisplay'+num).val('閉じる');//ボタンの値を"閉じる"に変更
        }
      });
    }
  }
}
//コメント一覧返信表示終了

//コメント送信関数
function sendComment(){
    var str = $(".inputForm").val();//テキストエリアの値を取得
    if(!str.match(/\S/g)){//空白だった場合の処理
      $(".inputForm").val("");
      $(".showError").html("<span>空白での投稿はできません</span>");//エラーメッセージを、事前に用意しておいた空のdivに表示する
    }else{//文字が入力されていた場合の処理
      $(".sendText").attr('disabled',true);//二重投稿防止のためにボタンを無効化する
      $.ajax({
        type:"POST",//POST形式で送信
        url: "CommentController.php",//CommentController.phpに送信
        data:'typeBoard='+str,//$_POST["typeBoard"]で取得可能
        success: function(html){//処理に成功した場合、echoで出力したhtml要素が返ってくる
          $('.showError').append(html);//ページを更新するスクリプトが返ってきて、ページを更新する。
        }
      });
    }
  }
//コメント送信関数終了

function linkToReplyPage(id){
  window.location.href = "replyBoard.php?content_id=" + id;
}
