//返信送信関数
  function sendReply(id){//$_GET["content_id"]を引数に持たせているだけで、動きはコメント送信関数と一緒
      var str = $(".inputForm").val();
      if(!str.match(/\S/g)){
        $(".inputForm").val("");
        $(".showError").html("<span>空白での投稿はできません</span>");
      }else{
        $(".sendText").attr('disabled',true);
        $.ajax({
          type:"POST",
          url: "returnCommentController.php",
          data:{'rTypeBoard':str, //複数の値を渡すときは｛｝を使う
                'content_id':id
              },
          success: function(html){
            $('.showError').append(html);
          }
      });
    }
  }
//返信送信関数終了
