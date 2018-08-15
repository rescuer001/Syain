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
	<a href="PC_index.php"><img src="logo72.png" alt="写真" width="100px"
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
//更新したい職位番号からデータの取り出し
$sql = "SELECT * FROM syoku_m where syoku_no='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
		$S1 = $row ['syoku_no'];
		$S2 = $row ['syoku_nm'];
		$S3 = $row ['kihon_kin'];
		$S4 = $row['bikou'];
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
	// 数字のみ取り出し
	$result = mysql_query ( $sql );
	$Smax = current ( mysql_fetch_row ( $result ) );
	$PCnumb = substr ( $Smax, 2, 3 );
	++ $PCnumb;
	//ゼロパディング（3桁）
	$Smax = str_pad ( $PCnumb, 3, 0, STR_PAD_LEFT );
		
}

?>
<center><font size="4">職位テーブル新規</font></center>
<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='index.php'">メニュー</button>
<button type="button" onClick="location.href='syoku_ichiran.php'">一覧</button>
<button type="submit" name ="update_or_insert" onclick="return check()">更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">職位no</td>
<td>
<?php

if ($_GET ['P2'] == 1) {
    echo '<input type="text" name="syoku_no" maxlength="5" size="4" value="'. $Smax .'" '. '>';
}else{
    echo '<input type="text" name="syoku_no" maxlength="5" size="4" value="' . $S1 . '" '. $ronly . $gray . '>';
}

?>
<br>
</td>
</tr>

<tr>
<td align="left">職位名</td>
<td>
<?php
echo '<input type="text" name="shoku_nm" maxlength="40" size="7" value="' . $S2 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">基本給</td>
<td>
<?php
echo '<input type="text" name="kihon_kin" maxlength="40" size="10" value="' . $S2 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">備考</td>
<td><textarea name="bikou" maxlength="100" size="100" style="width:350px;height:100px;" placeholder="備考欄です。自由に書いてください。" value="<?php echo $S5; ?>">
<?php echo $S5?></textarea>
<br>
</td>
</tr>

</table></p>




<?php

if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
		
		$sql = "INSERT INTO syoku_m ( syoku_no, syoku_nm, kihon_kin, bikou)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['syoku_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['syoku_nm'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kihon_kin'];
		$sql = $sql . "','";
		$sql = $sql . $_POST['bikou'] ;
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: syoku_ichiran.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
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
		$sql = $sql . "',";
		$sql = $sql . "bikou='";
		$sql = $sql . $_POST ['bikou'];
		$sql = $sql . "',";
		$sql = $sql . " WHERE ";
        $sql = $sql . " syoku_no ='";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: syoku_ichiran.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	if ($S6 != "00000")
		$errmsg = ("この職位番号は使用中です");
		echo <<<EOM
		<script type="text/javascript">
			alert('$errmsg')
		</script>
EOM;
		exit();

	} else {
		$sql = "DELETE FROM syoku_m WHERE ";
		$sql = $sql . "syoku_no = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: syoku_ichiran.php" );
		} else {
			echo ("<p>情報の削除に失敗しました</p>");
		}
	}


if ($_GET ['P3'] == 1) {
    echo "<br>情報の登録に成功しました";
}
if ($_GET ['P4'] == 1) {
    
    echo $_POST ['action2'];
    echo "<br>情報の削除に成功しました";
}
if ($_GET ['P5'] == 1) {
    echo "<br>情報の更新に成功しました";
}

$con = mysql_close ( $con );
if (! $con) {
	exit ( 'データベースの接続を閉じられませんでした。' );
}
?>

</font>

</form>
</body>
</html>