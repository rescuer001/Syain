

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

<title>OFFICE詳細</title>


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
$con = mysql_connect ( 'localhost', 'pc_user', 'pcpass' );
if (! $con) {
	exit ( 'データベースに接続できませんでした。' );
}
$result = mysql_select_db ( 'db_pc', $con );
if (! $result) {
	exit ( 'データベースを選択できませんでした。' );
}
$result = mysql_query ( 'SET NAMES utf8', $con );
if (! $result) {
	exit ( '文字コードを指定できませんでした。' );
}
//更新したいOF番号からデータの取り出し
$sql = "SELECT * FROM t_office where bangou='";
$sql = $sql . $_GET ['p1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
	$S1  = $row['bangou'];
	$S2  = $row['key1'];
	$S3  = $row['media'];
	$S4  = $row['syurui'];
	$S5  = $row['word'];
	$S6  = $row['excel'];
	$S7  = $row['outlook'];
	$S8  = $row['pp'];
	$S9  = $row['onenote'];
	$S10 = $row['access'];
	$S11 = $row['uid'];
	$S12 = $row['pass'];
	$S13 = $row['kounyuubi'];
	$S14 = $row['pcno'];
	$S15 = $row['simei'];
	$S16 = $row['basyo'];
	$S17 = $row['kasidasi'];
	$S18 = $row['hennkyaku'];
	$S19 = $row['url'];
	$S20 = $row['bikou'];
	}
}



// 初期化
$sct = null;

// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
	// 日付の読み込み
	$S13 = date ( 'Y-m-d' );
	// 選択済み用変数
	$sct = "selected";
	// 新規作成時はグレーアウトしないため初期化
//	$ronly = null;
//	$gray = null;
// 番号の最大値取得
	$sql = "SELECT MAX(bangou) FROM t_office;";
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
<center><font size="4">OFFICE詳細</font></center>

<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='PC_index.php'">メニュー</button>
<button type="button" onClick="location.href='OFFICE_ICHIRAN.php'">一覧</button>
<button type="submit" name ="update_or_insert"  <?php  echo $CK; ?>>更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="bangou" maxlength="5" size="10" placeholder="OF000" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" name="bangou" maxlength="5" size="10" placeholder="OF000" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">キー</td>
<td>
<?php
echo '<input name="key1" maxlength="40" size="40" placeholder="00000-00000-00000-00" value="' . $S2 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">メディア</td>
<td>
<input type="text" name="media" maxlength="10" size="10"  value="<?php echo $S3; ?>">
</td>
</tr>

<tr>
<td align="left">形状</td>
<td>
<input type="text" name="syurui" maxlength="10" size="10"  value="<?php echo $S4; ?>">
</select>
</td>
</tr>

<tr>
<td align="left">購入日</td>
<td>
<input type="text" name="kounyuubi" maxlength="10" size="10"  value="<?php echo $S13; ?>">
</td>
</tr>



<tr><td align="left">PC番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	
echo '<input type="text" name="pcno" maxlength="5" size="5" placeholder="PC000" value="PC000"' . $ronly . $gray . '>';
}else{
echo '<input type="text" name="pcno" maxlength="5" size="5" placeholder="PC000" value="' . $S14 . '" '.$ronly . $gray .  '>';

}

?>
<br>
</td>
</tr>

<tr>
<td align="left">URL</td>
<td>
<input type="text" name="url" size="40"  value="<?php echo $S19; ?>">
<br>
</td>
</tr>

<tr>
<td align="left">UID</td>
<td>
<input type="text" name="uid" size="40"  value="<?php echo $S11; ?>">
<br>
</td>
</tr>

<tr><td width="100" align="left">パスワード</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="pass" value="' . $S12 .'" '. '>';
}else{
	echo '<input type="text" name="pass" value="' . $S12 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">備考</td>
<td><textarea name="bikou" maxlength="100" size="100" style="width:350px;height:100px;" placeholder="備考欄です。自由に書いてください。" value="<?php echo $S20; ?>">
<?php echo $S20 ?></textarea>
<br>
</td>
</tr>

</table></p>



<?php

if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
		$sql = "INSERT INTO t_office ( bangou, key1, media, syurui, word, excel, outlook, pp, onenote, access, uid, pass, kounyuubi, pcno, simei, basyo, kasidasi, hennkyaku, url, bikou)";
		$sql = $sql . "VALUES('";
		$sql = $sql . $_POST['bangou'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['key1'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['media'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['syurui'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['word'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['excel'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['outlook'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['pp'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['onenote'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['access'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['uid'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['pass'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['kounyuubi'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['pcno'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['simei'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['basyo'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['kasidasi'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['hennkyaku'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['url'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['bikou'] ;
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: OFFICE_ICHIRAN.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE t_office SET";

		$sql = $sql . " bangou ='";
		$sql = $sql . $_POST['bangou'];
		$sql = $sql . "',";
		$sql = $sql . " key1 ='";
		$sql = $sql . $_POST['key1'];
		$sql = $sql . "',";
		$sql = $sql . " media ='";
		$sql = $sql . $_POST['media'];
		$sql = $sql . "',";
		$sql = $sql . " syurui ='";
		$sql = $sql . $_POST['syurui'];
		$sql = $sql . "',";
		$sql = $sql . " word ='";
		$sql = $sql . $_POST['word'];
		$sql = $sql . "',";
		$sql = $sql . " excel ='";
		$sql = $sql . $_POST['excel'];
		$sql = $sql . "',";
		$sql = $sql . " outlook ='";
		$sql = $sql . $_POST['outlook'];
		$sql = $sql . "',";
		$sql = $sql . " pp ='";
		$sql = $sql . $_POST['pp'];
		$sql = $sql . "',";
		$sql = $sql . " onenote ='";
		$sql = $sql . $_POST['onenote'];
		$sql = $sql . "',";
		$sql = $sql . " access ='";
		$sql = $sql . $_POST['access'];
		$sql = $sql . "',";
		$sql = $sql . " uid ='";
		$sql = $sql . $_POST['uid'];
		$sql = $sql . "',";
		$sql = $sql . " pass ='";
		$sql = $sql . $_POST['pass'];
		$sql = $sql . "',";
		$sql = $sql . " kounyuubi ='";
		$sql = $sql . $_POST['kounyuubi'];
		$sql = $sql . "',";
		$sql = $sql . " pcno ='";
		$sql = $sql . $_POST['pcno'];
		$sql = $sql . "',";
		$sql = $sql . " simei ='";
		$sql = $sql . $_POST['simei'];
		$sql = $sql . "',";
		$sql = $sql . " basyo ='";
		$sql = $sql . $_POST['basyo'];
		$sql = $sql . "',";
		$sql = $sql . " kasidasi ='";
		$sql = $sql . $_POST['kasidasi'];
		$sql = $sql . "',";
		$sql = $sql . " hennkyaku ='";
		$sql = $sql . $_POST['hennkyaku'];
		$sql = $sql . "',";
		$sql = $sql . " url ='";
		$sql = $sql . $_POST['url'];
		$sql = $sql . "',";
		$sql = $sql . " bikou ='";
		$sql = $sql . $_POST['bikou'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE bangou ='";
		$sql = $sql . $S1;
		$sql = $sql . "';";
        $result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: OFFICE_ICHIRAN.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	if ($S14 != "PC000") {
		$errmsg = ("このOFFICE番号は使用中です");
		echo <<<EOM
		<script type="text/javascript">
			alert('$errmsg')
		</script>
EOM;
		exit();
	} else {
		$sql = "DELETE FROM t_office WHERE ";
		$sql = $sql . "bangou = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: OFFICE_ICHIRAN.php" );
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
