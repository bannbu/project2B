<?php
session_start();
require "tool.php";
sessionProtect($_SESSION["userID"]);

?>
<!DOCTYPE html>
<html>
<head>
  <title>コメント一覧</title>
  <meta charset="utf-8" />
  <!-- <link rel="stylesheet" href="./CSS/board.css"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="./CSS/boardMobile.css" rel="stylesheet" type="text/css" media="screen and (max-width:480px)" >
  <link href="./CSS/board.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" >
  <script src="./JS/jquery-2.1.3.js"></script>
  <script src="./JS/board.js"></script>
</head>
<script>

$(function(){
  //シフトキーを押しながらエンターで投稿
  $(".inputForm").keypress(function(e){
    if(e.shiftKey){
      console.log("shift");
      if(e.which == 13){
        sendComment();
        return false;
      }
    }
  });
});

  </script>
<body>
<header>
  <nav class="navFlex" name="top">
    <!-- <a href="#">マイページ</a>
    <a href="board.php">タイムライン</a> -->
    <?php
    echo "<span>ログイン中:".$_SESSION["userID"]."</span>";
      ?>
  </nav>
</header>

<div class="wrapper">
  <div class="timeLineWrapper">
    <div class="typeText">
      <ul>
        <li>
          <textarea class="inputForm" name="typeBoard" placeholder="ここに入力" ></textarea>
        </li>
        <li>
          <input type="button" class="sendText" onclick="sendComment()" value="送信"/>
        </li>
      </ul>
    <div class="showError">
    </div>
    </div>
    <!-- <div id="notice">

    </div> -->
    <div id="contentArea">
<?php
    $timeLineData = searchTimeLine();
    foreach ($timeLineData as $r) {
        if($r['content_id'] != null){
          $num = commentCount($r["content_id"]);
          // var_dump($num);
          echo '<div class="content">';
            echo '<input type="hidden" name ="content_id" value = '. $r["content_id"] .'>';
            echo '<div class="accountInfo">';
              echo  'レスNo：'.$r["content_id"].' 投稿日時：'.$r["date"].' 学生番号：'.$r["personalData"];
              echo "<hr>";
            echo '</div>';
            echo '<div class="textContent">';
              echo $r["contentData"];
            echo '</div>';
            echo '<div class="goReplyPage">';
              echo '<input type="button" class="link btn" onclick="linkToReplyPage('.$r["content_id"].')" value = "返信画面へ移動">';
              echo '<input type="button"  class="link btn replyDisplay'.$r["content_id"].'" name="'.$r["content_id"].'" onclick="showReply('.$r["content_id"].','.$num["count"].')" value="'.$num["count"].'件の返信">';
              echo '<div class="add'.$r["content_id"].'">';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }else{
          $data = searchReturnOne($r["return_id"]);
          foreach ($data as $r) {
            echo '<div class="shareBoard">';
            echo "<span><b>共有されたコメント</b></span>";
              echo '<div class="accountInfo">';
                echo  '投稿日時：'.$r["date"].' 学生番号：'.$r["personalData"];
              echo '</div>';
              echo '<hr>';
              echo '<div class="textContent">';
                echo $r["returnContent"];
              echo '</div>';
              echo '<div class="goReplyPage">';
                echo '<a href="replyBoard.php?content_id='.$r["textContent_id"].'">元の投稿を表示</a>';
              echo '</div>';
            echo '</div>';
          }
      }
    }
?>
    </div>
  </div>
</div>
<div class="back">
  <a href="#top">一番上に戻る</a>
</div>

<footer>
  <form action="logout.php" method="post">
    <input type="submit" value="ログアウト" />
  </form>
  <span>プロジェクト演習２</span>
</footer>
</body>
</html>
