

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

<title>役職詳細</title>


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
//更新したいOF番号からデータの取り出し
$sql = "SELECT * FROM yaku_m.sql where yaku_no='";
$sql = $sql . $_GET ['p1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
	$S1  = $row['yaku_no'];
	$S2  = $row['yaku_nm'];
	$S3  = $row['yaku_kin'];
	$S4  = $row['kinrou_su'];
	$S5 = $row['bikou'];
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
	$sql = "SELECT MAX(yaku_no) FROM yaku_m;";
	// 数字のみ取り出し
	$result = mysql_query ( $sql );
	$Smax = current ( mysql_fetch_row ( $result ) );
	$PCnumb = substr ( $Smax, 2, 3 );
	++ $PCnumb;
	$Smax = str_pad ( $PCnumb, 3, 0, STR_PAD_LEFT );
	// フォーム用
	$PC = "PC";
	$OS = "OS";
	$OF = "OF";
	$VU = "VU";
	$Smax =  $OF.$Smax;
	$optionOS = null;
	$optionDEV = null;
	// 入力チェック変数化
	$CK = "onclick=\"return check()\"";
}

?>
<center><font size="4">役職詳細</font></center>

<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='index.php'">メニュー</button>
<button type="button" onClick="location.href='yaku_ichiran.php'">一覧</button>
<button type="submit" name ="update_or_insert"  <?php  echo $CK; ?>>更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">役職番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="yaku_no" maxlength="5" size="10" placeholder="番号を入力" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" name="yaku_no" maxlength="5" size="10" placeholder="番号を入力" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">役職名</td>
<td>
<?php
echo '<input name="yaku_nm" maxlength="10" size="10" value="' . $S2 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">役職手当</td>
<td>
<input type="text" name="yaku_kin" maxlength="10" size="10"  value="<?php echo $S3; ?>">
</td>
</tr>

<tr>
<td align="left">勤労福祉口数</td>
<td>
<input type="text" name="kinrou_su" maxlength="10" size="10"  value="<?php echo $S4; ?>">
</select>
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
		$sql = "INSERT INTO yaku_m (yaku_no ,yaku_nm ,yaku_kin , kinrou_su, bikou)";

		$sql = $sql . "VALUES('";
		$sql = $sql . $_POST['yaku_no'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['yaku_nm'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['yaku_kin'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['kinrou_sui'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['bikou'] ;
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: yaku_ichiran.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE yaku_m SET";

		$sql = $sql . " yaku_no ='";
		$sql = $sql . $_POST['yaku_no'];
		$sql = $sql . "',";
		$sql = $sql . " yaku_nm ='";
		$sql = $sql . $_POST['yaku_nm'];
		$sql = $sql . "',";
		$sql = $sql . " ysku_kin ='";
		$sql = $sql . $_POST['yaku_kin'];
		$sql = $sql . "',";
		$sql = $sql . " kinrou_su ='";
		$sql = $sql . $_POST['kinrou_su'];
		$sql = $sql . "',";
		$sql = $sql . " bikou ='";
		$sql = $sql . $_POST['bikou'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE yaku_no ='";
		$sql = $sql . $S1;
		$sql = $sql . "';";
        $result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: yaku_ichiran.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	if ($S1 != "") {
		$errmsg = ("この役職番号は使用中です");
		echo <<<EOM
		<script type="text/javascript">
			alert('$errmsg')
		</script>
EOM;
		exit();
	} else {
		$sql = "DELETE FROM yaku_m WHERE ";
		$sql = $sql . "yaku_no = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: yaku_ichiran.php" );
		} else {
			echo ("<p>情報の削除に失敗しました</p>");
		}
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
