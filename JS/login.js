//ログイン処理
function loginCheck(){
  var id = $("#uid").val();//ID、パスワード取得
  var pass = $("#pss").val();
  console.log(id);
  console.log(pass);

  if(id !== "" && pass !== ""){
    console.log("ok");
    $("#uid").css("border","solid 1px black");
    $("#idError").text("");
    $("#pss").css("border","solid 1px black");
    $("#passError").text("");
    $('.showError').text("");
    $.ajax({
      type: "POST",
      url: "login.php",
      data:{
        'userID': id,
        'password': pass
        }
      }).done(function (html){
        $('.showError').append(html);
    }).fail(function(html){
      $('.showError').append("dame");
    });
  }else{
    $('.showError').text("");
      if(id === ""){
        $("#uid").css("border","solid 1px rgb(237, 174, 66)");
        $("#idError").text("IDを入力してください");
      }else{
        $("#uid").css("border","solid 1px black");
        $("#idError").text("");
      }
      if(pass === ""){
        $("#pss").css("border","solid 1px rgb(237, 174, 66)");
        $("#passError").text("パスワードを入力してください");
      }else{
        $("#pss").css("border","solid 1px black");
        $("#passError").text("");
      }
  }
}
