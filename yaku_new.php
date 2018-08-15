

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
</script>


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
$sql = "SELECT * FROM yaku_m where yaku_no='";
$sql = $sql . $_GET ['p1'];
$sql = $sql . "';";



if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {
	$S1  = $row['yaku_no'];
	$S2  = $row['yaku_nm'];
	$S3  = $row['yaku_kin'];
	$S4  = $row['kinrou_su'];
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

}

?>
<center><font size="4">役職詳細</font></center>

<form  action=""  name="ichiran"  id="ichiran" method="post" ><button type="button" onClick="location.href='index.php'" style="WIDTH: 100px; margin-left: 0px; margin-right: 0px;">メニュー</button><button type="button" onClick="location.href='yaku_ichiran.php'"style="WIDTH: 100px; margin-left: 0px; margin-right: 0px;">一覧</button><button type="submit" onclick="return check()"style="WIDTH: 100px; margin-left: 0px; margin-right: 0px;" name ="update_or_insert"  <?php  echo $CK; ?>>更新</button><button type="submit" style="WIDTH: 100px; margin-left: 0px; margin-right: 0px;" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000	"  width="250" style="border-collapse: collapse">
<tr><td width="100" align="left">役職番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
	echo '<input type="text" name="yaku_no" maxlength="5" size="5" placeholder="00000" value="">';
}else{
	echo '<input type="text" name="yaku_no" maxlength="5" size="5" placeholder="00000" value="' . $S1 . '" ' . $ronly . $gray .  '>';
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
<input type="text" name="yaku_kin" maxlength="5" size="5"  value="<?php echo $S3; ?>" align="right">
</td>
</tr>
<tr>
<td align="left">勤労福祉口数</td>
<td>
<input type="text" name="kinrou_su" maxlength="5" size="5"  value="<?php echo $S4; ?>" align="right">
</select>

</td>
</tr>


</table></p>



<?php



    if (isset ( $_POST ["update_or_insert"] )) {
	if ($_GET ['P2'] == 1) {
	    $sql = "SELECT count(*) as wk_num FROM yaku_m where yaku_no='";
	    $sql = $sql .$_POST['yaku_no'];
        $sql = $sql . "';";
        $res = mysql_query ( $sql );
        $row = mysql_fetch_assoc($res);

        if ($row['wk_num'] == 1 ){
            exit ( "入力された役職NOは使用済みです" );
        }

		$sql = "INSERT INTO yaku_m (yaku_no ,yaku_nm ,yaku_kin , kinrou_su)";
		$sql = $sql . "VALUES('";
		$sql = $sql . $_POST['yaku_no'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['yaku_nm'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['yaku_kin'] ;
		$sql = $sql . "','";
		$sql = $sql . $_POST['kinrou_su'] ;
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
		$sql = $sql . " yaku_kin ='";
		$sql = $sql . $_POST['yaku_kin'];
		$sql = $sql . "',";
		$sql = $sql . " kinrou_su ='";
		$sql = $sql . $_POST['kinrou_su'];
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
<script type ="text/javascript" language="javascript">
<!--
function check(){

	a = document.ichiran.yaku_no.value //formタグ内にあるinputタグのvalue(name属性を取る)
	n = document.ichiran.yaku_no.value.length;
	if(n < 5){
		alert("数字の5桁で入力してください");
		return false; //送信を中止
	}

	if(a.match( /[^0-9.,-]+/ ) ){
		alert("半角数字で入力してください");
		return false;
	}

	if(isZenkaku( document.ichiran.yaku_nm.value) ==false){
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
