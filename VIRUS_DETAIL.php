

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

<title>VIRUS詳細</title>


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
$sql = "SELECT * FROM t_virus where number='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "';";


if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
		$S1 = $row ['number'];
	    $S2 = $row ['hinmei'];
	    $S3 = $row ['cereal'];
	    $S4 = $row ['torokumei'];
	    $S5 = $row ['kanribo'];
	    $S6 = $row ['url'];
	    $S7 = $row ['bikou'];
	}
}



// 初期化
$sct = null;
$error_sw　= null;
$error_msg　= null;


// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
	// 日付の読み込み
	//$S4 = date ( 'Y-m-d' );
	// 選択済み用変数
	$sct = "selected";
	// 新規作成時はグレーアウトしないため初期化
//	$ronly = null;
//	$gray = null;
// 番号の最大値取得
	$sql = "SELECT MAX(number) FROM t_virus;";
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
	$Smax =  $VU.$Smax;
	$optionOS = null;
	$optionDEV = null;
	// 入力チェック変数化
	$CK = "onclick=\"return check()\"";
}

?>
<center><font size="4">VIRUS詳細</font></center>

<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='PC_index.php'">メニュー</button>
<button type="button" onClick="location.href='VIRUS_ICHIRAN.php'">一覧</button>
<button type="submit" name ="update_or_insert"  <?php  echo $CK; ?>>更新</button>
<button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000"  width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="number" maxlength="5" size="10" placeholder="VU000" value="' . $Smax .'" '. '>';
}else{
	echo '<input type="text" name="number" maxlength="5" size="10" placeholder="VU000" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}

//echo '<input type="text" name="no" maxlength="3" size="3" placeholder="000" value="' . $Smax . '" ' . $ronly . $gray .  '>';
?>
<br>

</td>
</tr>

<tr>
<td align="left">品名</td>
<td>
<?php
echo '<input name="hinmei"  class="txtmode1"  size="60" maxlength="60" value="' . $S2 . '" ' . '>';
?>
<br>

</td>
</tr>

<tr>
<td align="left">シリアル番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
   echo '<input pattern="^[0-9A-Za-z-]+$" name="cereal" class="txtmode2" size="40" maxlength="40" required value="' . $S3 . '" ' . '>';
}else{
   echo '<input pattern="^[0-9A-Za-z-]+$" name="cereal" class="txtmode2" size="40" maxlength="40" required value="' . $S3 . '" ' . $ronly . $gray . '>';
     }
?>
</td>
</tr>

<tr>
<td align="left">PC番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
   echo '<input name="torokumei"  class="txtmode1" size="7" maxlength="7" placeholder="PC000" value="PC000"' . $ronly . $gray .  '>';
}else{
   echo '<input name="torokumei"  class="txtmode1" size="7" maxlength="7" placeholder="PC000" value="' . $S4 . '" ' . $ronly . $gray . '>';
     }
?>

</td>
</tr>

<tr>
<td align="left">URL</td>
<td>
<?php
   echo '<input name="url" name="url" class="txtmode1" cols="60" rows="4" size="30" maxlength="60" placeholder="https://www." value="' . $S6 . '" ' . '>';
?>

</td>
</tr>

<tr>
<td align="left">備考</td>
<td><textarea name="bikou" maxlength="100" size="100" style="width:350px;height:100px;" placeholder="備考欄です。自由に書いてください。" value="<?php echo $S7; ?>">
<?php echo $S7 ?></textarea><br></td>
</tr>

</table></p>



<?php


if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
		// sakusei
		$sql = "INSERT INTO t_virus( number, hinmei, cereal, torokumei, kanribo, url, bikou)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['number'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['hinmei'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['cereal'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['torokumei'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kanribo'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['url'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['bikou'];
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
			if ($result) {
				header ( "Location: VIRUS_ICHIRAN.php" );
				echo ("<p>情報を作成しました。</p>");
			} else {
				echo ("<p>情報の作成に失敗しました</p>");
			}
		}
	} else {
		// kousinn
		$sql = "UPDATE t_virus SET ";

		$sql = $sql . "number='";
		$sql = $sql . $_POST ['number'];
		$sql = $sql . "',";
		$sql = $sql . "hinmei='";
		$sql = $sql . $_POST ['hinmei'];
		$sql = $sql . "',";
		$sql = $sql . "cereal='";
		$sql = $sql . $_POST ['cereal'];
		$sql = $sql . "',";
		$sql = $sql . "torokumei='";
		$sql = $sql . $_POST ['torokumei'];
		$sql = $sql . "',";
		$sql = $sql . "kanribo='";
		$sql = $sql . $_POST ['kanribo'];
		$sql = $sql . "',";
		$sql = $sql . "url='";
		$sql = $sql . $_POST ['url'];
		$sql = $sql . "',";
		$sql = $sql . "bikou='";
		$sql = $sql . $_POST ['bikou'];
		$sql = $sql . "'";
		$sql = $sql . " WHERE ";
		$sql = $sql . "number = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>情報を更新しました。</p>");
			header ( "Location: VIRUS_ICHIRAN.php" );
		} else {
			echo ("<p>情報の更新に失敗しました</p>");
		}
	}

} else if (isset ( $_POST ["delete"] )) {
	if ($S4 != "PC000") {		
		$errmsg = ("このウイルス番号は使用中です");
		echo <<<EOM
		<script type="text/javascript">
			alert('$errmsg')
		</script>
EOM;
		exit();
		
	} else {
		$sql = "DELETE FROM t_virus WHERE ";
		$sql = $sql . "number = '";
		$sql = $sql . $S1;
		$sql = $sql . "';";
		$result = mysql_query ( $sql );
		if ($result) {
			echo ("<p>削除に成功しました</p>");
			header ( "Location: VIRUS_ICHIRAN.php" );
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



<script type="text/javascript" language="javascript">
<!--

function check(){
	l = document.forms.ichiran.bangou.value.length;
	m = document.forms.ichiran.bangou.value;

	if(m.match( /[^0-9.,-]+/ ) ){
		alert("半角数字で入力して下さい。");
		return false;
	}
	if(l != 3){ alert("番号は半角英数字の3桁で入力してください");
		return false; // 送信を中止
	}

}
//var del = <?php //echo json_encode($_GET ['P4']); ?>;
// -->
</script>	

</form>
</body>
</html>
