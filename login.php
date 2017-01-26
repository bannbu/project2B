<?php
session_start();
	$userID = $_POST["userID"];
	$password = $_POST["password"];

	require "tool.php";

	$judge = loginJudge($password,$userID); //ログイン判定呼び出し


	if($judge){
	  unset($_POST["password"]);
		$password = null;
		$_SESSION["userID"] = $userID;
    echo("<script>window.location.href = 'board.php';</script>");

	}else{
		// header("Location:login.html"); //失敗
    echo("ログインに失敗しました");
	}

?>
