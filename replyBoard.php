<?php
require "tool.php";
session_start();
sessionProtect($_SESSION["userID"]);
?>

<!DOCTYPE html>
<html>
<head>
  <title>返信ページ</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="./CSS/replyBoardMobile.css" rel="stylesheet" type="text/css" media="screen and (max-width:480px)" >
  <link href="./CSS/replyBoard.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px)" >
  <script src="./JS/replyBoard.js"></script>
  <script src="./JS/jquery-2.1.3.js"></script>
  <script>
  $(function(){
    $(".inputForm").keypress(function(e){
      if(e.shiftKey){
        console.log("shift");
        if(e.which == 13){
          var id = $("[name = content_id]").val();
          // console.log(id);
          sendReply(id);
          return false;
        }
      }
    });
  });
  </script>
</head>
<body>
<header>
  <nav class="navFlex">
    <!-- <a href="#">マイページ</a>
    <a href="board.php">タイムライン</a> -->
    <?php
    echo "<span>ログイン中:".$_SESSION["userID"]."</span>";
      ?>
  </nav>
</header>
<div id="wrapper">
  <div class="timeLineWrapper">
    <div class="content">
        <div class="accountInfo">
      <?php
          $data = titleView($_GET["content_id"]);
          if($data !== null){
          foreach ($data as $r) {
            echo 'レスNo:'.$r["content_id"].'　投稿日時：'.$r["date"].'　学生番号：'.$r["personalData"];
          ?>
        </div>
          <hr>
        <div class="textContent">
          <?php
          echo $r["contentData"];
        }//foreach文を閉じる
      }
      ?>
        </div>

  <?php
      // require "tool.php";
      $data = searchReturnComment($_GET["content_id"]);
      if($data !== null){
      $i = 1;

      foreach ($data as $r) {
        echo '<div class="reply">';
          echo '<div class="accountInfo">';
            echo  '返信No：'.$i.' 投稿日時：'.$r["date"].' 学生番号：'.$r["personalData"];
          echo '</div>';
          echo '<hr>';
          echo '<div class="textContent">';
            echo $r["returnContent"];
          echo '</div>';
          echo '<div class="share">';
            echo '<form action="ReTweetController.php" method="post">';
              echo '<input type="hidden" name="returnCommentID" value='.$r["returnContent_id"].' />';
              echo '<input type="hidden" name="returnContentID" value='.$_GET["content_id"].' />';
              echo '<input type="submit" class="shareButton" value="このコメントを共有する" />';
            echo '</form>';
          echo '</div>';
        echo '</div>';
        $i++;
      }
    }

  ?>
    </div>
    <div class="typeText">
      <input type="hidden" name="content_id" value="<?php echo($_GET['content_id']); ?>">
        <ul>
          <li>
            <textarea class="inputForm" name="rTypeBoard" placeholder="ここに返信を入力"></textarea>
          </li>
          <li>
            <input type="button" class="sendText" onclick='sendReply(<?php echo $_GET["content_id"]; ?>)' value="送信"/>
          </li>
        </ul>
        <div class="showError">
        </div>
  </div>
  <a href="board.php">コメント一覧に戻る</a>
</div>
</div>
</body>
</html>
