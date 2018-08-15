 

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

<title>OSライセンス詳細</title>


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
//更新したいOS番号からデータの取り出し
$sql = "SELECT * FROM t_os where no='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
		$S1 = $row ['no'];
		$S2 = $row ['licence'];
		$S3 = $row ['os_name'];
		$S4 = $row ['buy_date'];
		$S5 = $row ['shape'];
		$S6 = $row ['pc'];
		$S7 = $row ['url'];
		$S8 = $row ['biko'];
	}
}



// 初期化
$sct = "";
$error_sw　= "";
$error_msg　= "";

// OS、形状を選択済みにする
$optionDEV = "<option value=\"$S5\" selected>$S5</option>";
$optionOS = "<option value=\"$S3\" selected>$S3</option>";

// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
	// 日付の読み込み
	$S4 = date ( 'Y-m-d' );
	// 選択済み用変数
	$sct = "selected";
	// 新規作成時はグレーアウトしないため初期化
//	$ronly = null;
//	$gray = null;
// 番号の最大値取得
	$sql = "SELECT MAX(no) FROM t_os;";
	// 数字のみ取り出し
	$result = mysql_query ( $sql );
	$Smax = current ( mysql_fetch_row ( $result ) );
	$PCnumb = substr ( $Smax, 2, 3 );
	++ $PCnumb;
	//ゼロパディング（3桁）
	$Smax = str_pad ( $PCnumb, 3, 0, STR_PAD_LEFT );
		// フォーム用
	$PC = "PC";
	$OS = "OS";
	$OF = "OF";
	$VU = "VU";
	$Smax =  $OS.$Smax;
	$optionOS = null;
	$optionDEV = null;
}

?>
<center><font size="4">OS詳細</font></center>

<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='PC_index.php'">メニュー</button>
<button type="button" onClick="location.href='OS_ICHIRAN.php'">一覧</button>
<button type="submit" name ="update_or_insert" onclick="return check()">更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="no" maxlength="5" size="10" placeholder="OS000" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" name="no" maxlength="5" size="10" placeholder="OS000" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">ライセンス</td>
<td>
<?php
echo '<input name="licence" maxlength="40" size="40" placeholder="00000-00000-00000-00000-00000" value="' . $S2 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">OS</td>
<td>
<select name="os_name">
<option value="Windows10 Pro 64-Bit">Windows10 Pro 64-Bit</option>
<option value="Windows10 Pro 32-Bit">Windows10 Pro 32-Bit</option>
<option value="Windows8 Pro 64-Bit">Windows8 Pro 64-Bit</option>
<option value="Windows8 Pro 32-Bit">Windows8 Pro 32-Bit</option>
<option value="Windows7 Pro 64-Bit">Windows7 Pro 64-Bit</option>
<option value="Windows7 Pro 32-Bit">Windows7 Pro 32-Bit</option>
<option value="Windows server 2003">Windows server 2003</option>
<option value="Windows server 2008">Windows server 2008</option>
<option value="CentOS 7">CentOS 7</option>
<option value="CentOS 5">CentOS 5</option>
<?php echo $optionOS ?>
</select>
</td>
</tr>

<tr>
<td align="left">購入日</td>
<td><input type="text" name="buy_date" maxlength="10" size="10" value="<?php echo $S4; ?>"></td>
</tr>

<tr>
<td align="left">形状</td>
<td>
<select name="shape">
<option value="CD-ROM" <?php echo $sct ?>>CD-ROM</option>
<option value="only key">only key</option>
<option value="USB">USB</option>
<option value="iso">iso</option>
<option value="PRE">PRE</option>
<?php echo $optionDEV ?>
</select></td></tr>

<tr>
<td align="left">PC番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="pc" maxlength="5" size="5" placeholder="PC000" value="PC000"' . $ronly . $gray . '>';
}else{
	echo '<input type="text" name="pc" maxlength="5" size="5" placeholder="PC000" value="' . $S6 . '" ' . $ronly . $gray . '>';
}
?>
<br>
</td>
</tr>


<tr>
<td align="left">URL</td>
<td>
<?php
echo '<input name="url" maxlength="40" size="40" placeholder="https://www." value="' . $S7 . '" '  .  '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">備考</td>
<td><textarea name="biko" maxlength="100" size="100" style="width:350px;height:100px;" placeholder="備考欄です。自由に書いてください。" ><?php echo $S8; ?>
</textarea><br></td>
</tr>

</table></p>



<?php


if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
		// sakusei
		$sql = "INSERT INTO t_os( no, licence, os_name, buy_date, shape, pc , url, biko)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['licence'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['os_name'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['buy_date'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['shape'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['pc'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['url'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['biko'];
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: OS_ICHIRAN.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE t_os SET ";

		$sql = $sql . "no='";
		$sql = $sql . $_POST ['no'];
		$sql = $sql . "',";
		$sql = $sql . "licence='";
		$sql = $sql . $_POST ['licence'];
		$sql = $sql . "',";
		$sql = $sql . "os_name='";
		$sql = $sql . $_POST ['os_name'];
		$sql = $sql . "',";
		$sql = $sql . "buy_date='";
		$sql = $sql . $_POST ['buy_date'];
		$sql = $sql . "',";
		$sql = $sql . "shape='";
		$sql = $sql . $_POST ['shape'];
		$sql = $sql . "',";
		$sql = $sql . "pc='";
		$sql = $sql . $_POST ['pc'];
		$sql = $sql . "',";
		$sql = $sql . "url='";
		$sql = $sql . $_POST ['url'];
		$sql = $sql . "',";	
		$sql = $sql . "biko='";
		$sql = $sql . $_POST ['biko'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE ";
		$sql = $sql . "no = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: OS_ICHIRAN.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	if ($S6 != "PC000") {
		$errmsg = ("このOS番号は使用中です");
		echo <<<EOM
		<script type="text/javascript">
			alert('$errmsg')
		</script>
EOM;
		exit();
		
	} else {
		$sql = "DELETE FROM t_os WHERE ";
		$sql = $sql . "no = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: OS_ICHIRAN.php" );
		} else {
			echo ("<p>情報の削除に失敗しました</p>");
		}
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

function check(){
	l = document.ichiran.no.value.length;
	m = document.ichiran.no.value;
	o = document.ichiran.buy_date.value.length;
	k = document.ichiran.buy_date.value;
	a = document.ichiran.licence.value.length;
	b = document.ichiran.licence.value;
	if(!m.match( /^O(?=S[0-9])/) ) {
		alert("番号はOS+数字3桁で入力してください");
		return false; // 送信を中止
	}else if(l != 5){
		alert("番号は半角英数字5桁で入力してください");
		return false; // 送信を中止
	}else if(m == "OS000" ){
		alert("001~999で入力してください");
		return false; // 送信を中止
	}

	if(o != 10){
		alert("”購入日”書式：0000-00-00");
		return false;
	}
	if(!k.match(/^20[0-9][0-9]-[0-1][0-9]-[0-3][0-9]$/)){
		alert("2000-01-01～2099-12-31で入力");
		return false;
	}
	if(a<1){
		alert("入力してください");
		return false;
	}
	if(!b.match(/[0-9 A-Z-]/)){
		alert("半角英数字を入力してください");
		return false;
	}

}




//var del = <?php //echo json_encode($_GET ['P4']); ?>;
// -->
</script>

</form>
</body>
</html>