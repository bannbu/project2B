<?php
require "tool.php";

$content_id = $_POST["content_id"];//現在のboard.phpにある最新のcontent_idをPOSTで受信

$id = checkNewComment();//DB上の最新のcontent_idを取得 *新規関数

$count = $id["content_id"] - $content_id;//DB上の最新から、board.php上の最新のcontent_idを引く。1以上なら新規投稿あり。

// echo "<span>".$count."件の新着投稿があります</span>";//

$users = array();//初期化
// if($count >= 1){
//   $newComment = addNewComment($id["content_id"]);
//   while ($row = $newComment->fetch(PDO::FETCH_ASSOC)) {
//           $users[] = array(
//               'content_id'=> $row->content_id
//               ,'date' => $row->date
//               ,'personalData' => $row->personalData
//               ,'contentData' => $row->contentData
//               );
//           // $users = array_merge($users,array('num'=>commentCount($users[$i]["content_id"])));
//       }
//     header('Content-Type: application/json');
//     echo json_encode($users);
//     exit();
// }
/*
この下のhtmlで返す方法だと、何も帰ってこない模様
*/

// echo $id["content_id"];
if($count >= 1){
  $content = addNewComment($id["content_id"]);
  foreach ($content as $r) {
  $num = commentCount($r["content_id"]);
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
        // echo '<a href="replyBoard.php?content_id='.$r["content_id"].'">返信画面へ移動する</a>';
        echo '<input type="button" class="link" onclick="linkToReplyPage('.$r["content_id"].')" value = "返信画面へ移動する">';
        echo '<input type="button"  class="link replyDisplay'.$r["content_id"].'" name="'.$r["content_id"].'" onclick="showReply('.$r["content_id"].','.$num["count"].')" value="'.$num["count"].'件の返信">';
        echo '<div class="add'.$r["content_id"].'">';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
}else{
  echo "<span>".$count."件の新着投稿があります</span>";
}

 ?>
