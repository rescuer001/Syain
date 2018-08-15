<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>

<style>
table {
	border-collapse: collapse;
	border: 1px solid #000000; /* 外枠 */
	table-layout: fixed;
	font-size: 11pt;
}

table tr, table td {
	border-style: groove; /* 線種 */
	border-width: 1px; /* 線の太さ */
	border-color: #000000; /* 線色 */
	font-weight: 500;

title {
	background: gray ;
}


</style>

<title>住所テーブル一覧</title>


</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
	<a href="index.php"><img src="logo72.png" alt="写真" width="100px"
		align="left"></a>
	<br clear="left">
	<br>
	
		<font size="2" face="メイリオ">
<?php
// データベース接続
$con = mysql_connect ('localhost', 'root', 'sakamoto' );
if (! $con) {
	exit ( 'データベースに接続できませんでした。' );
}
$result = mysql_select_db ( 'db_syain', $con );
if (! $result) {
	exit ( 'データベースを選択できませんでした。' );
}
$result = mysql_query ( 'SET NAMES utf8', $con );
if (! $result) {
	exit ( '文字コードを指定できませんでした。' );
}
//更新したい郵便番号からデータの取り出し
$sql = "SELECT * FROM addr_m where post_cd='";
$sql = $sql . $_GET ['p1'];
$sql = $sql . "';";

if ($result = mysql_query ( $sql )) {
if ($row = mysql_fetch_array ( $result )) {
        $S1 = $row ['post_cd'];
	    $S2 = $row ['addr1_nm'];
	    $S3 = $row ['addr2_nm'];
	   }
}

// 初期化
$sct = null;
$error_sw = null;
$error_msg = null;

// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
// 選択済み用変数
	$sct = "selected";
// 番号の最大値取得
	$sql = "SELECT MAX(post_cd) FROM addr_m;";

}
    
?>
<center><font size="4">住所テーブル一覧</font></center>
<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='index.php'">メニュー</button>
<button type="button" onClick="location.href='addr_ichiran.php'">一覧</button>
<button type="submit" name ="update_or_insert" <?php  echo $CK; ?>>更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3" bordercolor="#000000" width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">郵便番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
    echo '<input type="text" name="post_cd" maxlength="40" size="40" placeholder="郵便番号を入力してください" value="" >';
}else{
    echo '<input type="text" name="post_cd" maxlength="40" size="40" placeholder="郵便番号を入力してください" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">住所</td>
<td>
<?php
echo '<input type="text" name="addr1_nm" maxlength="40" size="40" value= "' . $S2 .'" '. '>';
?>
<br>

</td>
</tr>

<tr>
<td align="left">補助住所</td>
<td>
<?php
echo '<input type="text" name="addr2_nm" maxlength="40" size="40" value= "' . $S3 .'" '. '>';
?>
<br>
</td>
</tr>

</table></p>



<?php

if (isset ( $_POST ["update_or_insert"] )) {
        if ($_GET ['P2'] == 1) {
		$sql = "INSERT INTO addr_m( post_cd, addr1_nm, addr2_nm)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['post_cd'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['addr1_nm'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['addr2_nm'];
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
		    if ($result) {
		        header ( "Location: addr_ichiran.php" );
		        echo ("<p>情報を作成しました。</p>");
		    } else {
		       echo ("<p>情報の作成に失敗しました</p>");
		    }
		}
	} else {
	    // kousinn
	    $sql = "UPDATE addr_m SET ";	    
	    
	    $sql = $sql . "post_cd='";
	    $sql = $sql . $_POST ['post_cd'];
	    $sql = $sql . "',";
	    $sql = $sql . "addr1_nm='";
	    $sql = $sql . $_POST ['addr1_nm'];
	    $sql = $sql . "',";
	    $sql = $sql . "addr2_nm='";
	    $sql = $sql . $_POST ['addr2_nm'];
	    $sql = $sql . "'";
	    $sql = $sql . " WHERE ";
	    $sql = $sql . "post_cd = '";
	    $sql = $sql . $S1;
	    $sql = $sql . "';";
	    $result = mysql_query ( $sql );
	    if ($result) {
	        echo ("<p>情報を更新しました。</p>");
	        header ( "Location: addr_ichiran.php" );
	    } else {
	        echo ("<p>情報の更新に失敗しました</p>");
	    }
	}
	

} else if (isset ( $_POST ["delete"] )) {

   $sql = "DELETE FROM addr_m WHERE ";
    $sql = $sql . "post_cd = '";
    $sql = $sql . $S1;
    $sql = $sql . "';";
   $result = mysql_query ( $sql );
    if ($result) {
        echo ("<p>削除に成功しました</p>");
        header ( "Location: addr_ichiran.php" );
  } else {
        echo ("<p>情報の削除に失敗しました</p>");
      }
   }




  
$con = mysql_close ( $con );
if (! $con) {
    exit ( 'データベースの接続を閉じられませんでした。' );
}
?>

</font>



<script type="text/javascript" language="javascript">
<!--
}
function check(){
	l = document.ichiran.post_cd.value.length;
	m = document.forms.ichiran.post_cd.value;
	if(l != 7){alert("半角数字の7桁で入力して下さい。");
		return false; //送信を中止
}	
//var del = <?php //echo json_encode($_GET ['P4']); ?>;
//-->
</script>

</form>
</body>
</html>