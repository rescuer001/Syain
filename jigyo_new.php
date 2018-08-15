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

<title>事業部テーブル新規</title>

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
$con = mysql_connect ( 'localhost', 'root', 'sakamoto' );
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
//更新したい事業番号からデータの取り出し
$sql = "SELECT * FROM jigyo_m where jigyo_no='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
if ($row = mysql_fetch_array ( $result )) { 
	$S1 = $row ['jigyo_no'];
		$S2 = $row ['jigyo_cd'];
		$S3 = $row ['jigyo_nm'];
	
	}
}

// 初期化
$sct = null;


// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
	// 選択済み用変数
	$sct = "selected";
	// 新規作成時はグレーアウトしないため初期化
//	$ronly = null;
//	$gray = null;
// 番号の最大値取得
	$sql = "SELECT MAX(jigyo_no) FROM jigyo_m;";
	
		
}

?>
<center><font size="4">事業部詳細</font></center>
<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='index.php'">メニュー</button><button type="button" onClick="location.href='jigyo_ichiran.php'">一覧</button><button type="submit" onclick="return check()" name ="update_or_insert"   <?php  echo $CK; ?>>更新</button><button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">事業部NO</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" pattern="[0-9]*" name="jigyo_no" maxlength="5" size="5" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" pattern="[0-9]*" name="jigyo_no" maxlength="5" size="5" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}

?>
<br>
</td>
</tr>

<tr>
<td align="left">事業部CD</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" pattern="[0-9]*" name="jigyo_cd" maxlength="5" size="20" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" pattern="[0-9]*" name="jigyo_cd" maxlength="5" size="20" value="' . $S2 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>


<tr>
<td align="left">事業部名</td>
<td>
<?php
echo '<input type="text" name="jigyo_nm" maxlength="40" size="40" placeholder="第一インフラエンジニア"' . $S3 .'" '. '>';
?>
</td>
</tr>



</table></p>



<?php

if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
	#Duplicate
		$sql = "SELECT count(*) as wk_num FROM jigyo_m where jigyo_no='";		
		$sql = $sql . $_POST ['jigyo_no'];
		$sql = $sql . "';";
		$res = mysql_query ( $sql );
		$row = mysql_fetch_assoc($res);
		 if ($row['wk_num'] == 1) {
			exit ( "入力された事業部NOは使用済みです。");
			} 
			   
	
      $sql = "SELECT count(*) as wk_num FROM jigyo_m where jigyo_cd='";		
		$sql = $sql . $_POST ['jigyo_cd'];
		$sql = $sql . "';";
		$res = mysql_query ( $sql );
		$row = mysql_fetch_assoc($res);
		 if ($row['wk_num'] == 1) {
			exit ( "入力された事業部CDは使用済みです。");
			} 
			
	    #updatecheck
	    $sql = "SELECT count(*) as wk_num FROM jigyo_m where jigyo_no='";		
		$sql = $sql . $_POST ['jigyo_nm'];
		$sql = $sql . "';";
		$res = mysql_query ( $sql );
		$row = mysql_fetch_assoc($res);
		 if ($row['wk_num'] == 1) {
			exit ( "更新しますか？。");
			} 
			   			   
		#sakusei
		
		$sql = "INSERT INTO jigyo_m (jigyo_no,jigyo_cd ,jigyo_nm)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['jigyo_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['jigyo_cd'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['jigyo_nm'];
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: jigyo_ichiran.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
				
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE jigyo_m SET ";
		
		$sql = $sql . "jigyo_no='";
		$sql = $sql . $_POST ['jigyo_no'];
		$sql = $sql . "',";
		$sql = $sql . "jigyo_cd='";
		$sql = $sql . $_POST ['jigyo_cd'];
		$sql = $sql . "',";
		$sql = $sql . "jigyo_nm='";
		$sql = $sql . $_POST ['jigyo_nm'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE ";
		$sql = $sql . " jigyo_no ='";
        $sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: jigyo_ichiran.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
			
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	
		
        $sql = "DELETE FROM jigyo_m WHERE ";
		$sql = $sql . "jigyo_no = '";
    $sql = $sql . $S1;
    $sql = $sql . "';";
   $result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: jigyo_ichiran.php" );
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
<script type ="text/javascript" language="javascript">
<!--
function check(){
	a = document.ichiran.jigyo_no.value //formタグ内にあるinputタグのvalue(name属性を取る)
	n = document.ichiran.jigyo_no.value.length;
	if(n < 5){ alert("数字の5桁で入力してください");
		return false; //送信を中止
	}
	if(a.match( /[^0-9.,-]+/ ) ){
	alert("半角数字で入力してください");
	return false;
	}
}
// -->
</script>

</form>
</body>
</html>










