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

<title>職位テーブル新規</title>

</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
	<a href="index.php"><img src="logo72.png" alt="写真^" width="100px"
		align="left"></a>
	<br clear="left">
	<br>


	<font size="2" face="メイリオ">

<?php
// データベース接続
$con = mysql_connect ( 'localhost', 'root', 'sakamoto' );
if (! $con) {
	exit ( 'データベースに接続できませんでした' );
}
$result = mysql_select_db ( 'db_syain', $con );
if (! $result) {
	exit ( 'データベースを選択できませんでした' );
}
$result = mysql_query ( 'SET NAMES utf8', $con );
if (! $result) {
	exit ( '文字コードを指定できませんでした' );
}
//更新したい職位番号からデータの取り出し
mysql_query("begin") ;
$sql = "SELECT * FROM syoku_m where syoku_no='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "' for update; ";

echo $sql;
if ($result = mysql_query ( $sql )) {
    if ($row = mysql_fetch_array ( $result )) {
	    $S1 = $row ['syoku_no'];
        $S2 = $row ['syoku_nm'];
		$S3 = $row ['kihon_kin'];

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
	$sql = "SELECT MAX(syoku_no) FROM syoku_m;";


}

?>
<center><font size="4">職位テーブル詳細</font></center>
<form  action=""  name="ichiran"  id="ichiran" method="post">
<button type="button" onClick ="location.href='index.php'">メニュー</button><button type="button" onClick ="location.href='syoku_ichiran.php'">一覧</button><button type="submit" onclick ="return check()" name ="update_or_insert" <?php echo $CK; ?>>更新</button><button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">職位NO</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
    echo '<input type="text" pattern="[0-9]*" name="syoku_no" maxlength="5" size="5" value="'. $Smax .'" '. '>';
}else{
    echo '<input type="text" pattern="[0-9]*" name="syoku_no" maxlength="5" size="5" value="' . $S1 . '" '. $ronly . $gray .  '>';
}

?>
<br>
</td>
</tr>

<tr>
<td align="left">職位名</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
   echo '<input type="text" name="syoku_nm" maxlength="5" size="5" value="' . $Smax. '" '  .  '>';
 }else{
   echo '<input type="text" name="syoku_nm" maxlength="5" size="5" value="' . $S2 . '" '  .  '>';
 }
?>
<br>
</td>
</tr>


<tr>
<td align="left">基本給</td>
<td>
<?php
echo '<input type="text" name="kihon_kin" maxlength="15" size="8" value="' . $S3 . '" '  .  '>';
?>
</td>
</tr>



</table></p>



<?php

if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {

	    #chofuku
	    $sql = "SELECT count(*) as sk_no FROM syoku_m where syoku_no='";
	    $sql = $sql . $_POST ['syoku_no'];
	    $sql = $sql . "';";
	    $res = mysql_query ( $sql );
	    $row = mysql_fetch_assoc($res);

	    if ($row['sk_no'] == 1) {
	        exit ("入力された職位NOは既に使用済です。");
	     }

	    #sakusei
		$sql = "INSERT INTO syoku_m ( syoku_no, syoku_nm, kihon_kin)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['syoku_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['syoku_nm'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kihon_kin'];
        $sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
			    mysql_query("commit");
			    header ( "Location: syoku_ichiran.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
			    mysql_query("rollback");
			    echo ("<p>情報の作成に失敗しました。</p>");
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE syoku_m SET ";

		$sql = $sql . "syoku_no ='";
		$sql = $sql . $_POST ['syoku_no'];
		$sql = $sql . "',";
		$sql = $sql . "syoku_nm='";
		$sql = $sql . $_POST ['syoku_nm'];
		$sql = $sql . "',";
		$sql = $sql . "kihon_kin='";
		$sql = $sql . $_POST ['kihon_kin'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE ";
		$sql = $sql . " syoku_no ='";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
		    mysql_query("commit");
	    header ( "Location: syoku_ichiran.php" );
			echo ("<p>情報を更新しました。</p>");
		} else {
		    mysql_query("rollback");
		    echo ("<p>情報の更新に失敗しました。</p>");

		}
	}


} else if (isset ( $_POST ["delete"] )) {


    $sql = "DELETE FROM syoku_m WHERE ";
	$sql = $sql . "syoku_no = '";
	$sql = $sql . $S1;
	$sql = $sql . "';";
	$result = mysql_query ( $sql );
	if ($result) {
	    mysql_query("commit");
		echo ("<p>削除に成功しました。</p>");
		header ( "Location: syoku_ichiran.php" );
	} else {
	    mysql_query("rollback");
		echo ("<p>情報の削除に失敗しました。</p>");
	}
}


mysql_query("rollback");
$con = mysql_close ( $con );
if (! $con) {
	exit ( 'データベースの接続を閉じられませんでした。' );
}
?>

</font>

<script type ="text/javascript" language="javascript">
<!--
function check(){
	a = document.ichiran.syoku_no.value //formタグ内にあるinputタグのvalue(name属性を取る)
	n = document.ichiran.syoku_no.value.length;
	if(n < 5){ alert("数字の5桁で入力してください");
		return false; //送信を中止
	}
	if(a.match( /[^0-9.,-]+/ ) ){
	alert("半角数字で入力してください");
	return false;
	}

	if(isZenkaku( document.ichiran.syoku_nm.value) ==false){
		alert("全角で入力してください");
		return false; //送信を中止
	}
}
function isZenkaku(str) {
    return (String(str).match(/[\x01-\x7E\uFF65-\uFF9F]/)) ? false : true;
}
// -->

</script>

</form>
</body>
</html>