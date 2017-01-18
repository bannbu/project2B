<?php
require "tool.php";

$data = searchReturnComment($_POST["data"]);

$i = 1;
// echo var_dump($data);

foreach ($data as $r) {
  echo '<div class="reply">';
    echo '<div class="accountInfo">';
      echo  '返信No：'.$i.' 投稿日時：'.$r["date"].' 学生番号：'.$r["personalData"];
    echo '</div>';
    echo '<hr>';
    echo '<div class="textContent">';
      echo $r["returnContent"];
    echo '</div>';
  echo '</div>';
  $i++;
}
 ?>
