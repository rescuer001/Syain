

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
}

input, select, textarea {
	background-color: #FFFFFF;
}

option.example2 {
	background-color: #FF0000;
}

a.tooltip:hover {
	background: #ffffff;
	text-decoration: none;
}

a.tooltip span {
	display: none;
	padding: 2px 3px;
	margin-left: 8px;
}

a.tooltip:hover span {
	display: inline;
	position: absolute;
	background: #ffffff;
	border: 1px solid #cccccc;
	color: #6c6c6c;
}
</style>

<title>PC管理簿</title>

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

// クリックされた番号からデータの取り出し
$sql = "SELECT * FROM t_pc where no='";
$sql = $sql . $_GET ['P1'];
$sql = $sql . "';";

if ($result = mysql_query ( $sql )) {
	if ($row = mysql_fetch_array ( $result )) {

		$S1 = $row ['no'];
		$S2 = $row ['maker'];
		$S3 = $row ['keijyou'];
		$S4 = $row ['buy'];
		$S5 = $row ['ex_os'];
		$S6 = $row ['office'];
		$S7 = $row ['virus'];
		$S8 = $row ['simei'];
		$S9 = $row ['basyo'];
		$S10 = $row ['kasidasi'];
		$S11 = $row ['hennkyaku'];
		$S12 = $row ['oldsimei'];
		$S13 = $row ['oldbasyo'];
		$S14 = $row ['oldkasidasi'];
		$S15 = $row ['oldhennkyaku'];
	}
}

// 初期化
$OS = null;
$sct = null;

// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 形状プルダウンセレクト
$optionDEV = "<option value=\"$S3\" selected>$S3</option>";
$optionMKR = "<option value=\"$S2\" selected>$S2</option>";
$optionOSS = "<option value=\"$S5\" selected>$S5</option>";
$optionOFI = "<option value=\"$S6\" selected>$S6</option>";
$optionVIR = "<option value=\"$S7\" selected>$S7</option>";
$optionNAM = "<option value=\"$S8\" selected>$S8</option>";

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
	// 日付の読み込み
	$S4 = date ( 'Y-m-d' );
	// 選択済み用変数
	$sct = "selected";	
	// 番号の最大値取得
	$sql = "SELECT MAX(no) FROM t_pc;";
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
	$Smax =  $PC.$Smax;
	
	 
	// プルダウン初期化
	$optionDEV = null;
	$optionMKR = null;
	$optionOSS = null;
	$optionOFI = null;
	$optionVIR = null;
	$optionNAM = null;

	// 入力チェック変数化
	$CK = "onclick=\"return check()\"";

}

?>

<center>
	<font size="4">PC管理簿</font>
</center>
<form method="post" action="PC_DETAIL_DO.php" name="PC_DETAIL"> 
	<button type="button" onClick="location.href='PC_index.php'">メニュー</button>
	<button type="button" onClick="location.href='PC_ICHIRAN.php'">一覧</button>
	<button type="submit" name="update_or_insert" <?php echo $CK ?>>更新</button>
	<button type="submit" name="delete"  onClick="set_value('DEL') " >削除</button>
	
	<table border="1" cellspacing="0" cellpadding="5"
			bordercolor="#000000"  width="600" style="border-collapse: collapse">
		<tr>
			<td width="100" align="left">PC番号</td>
			<td>
			<?php
			     if ($_GET ['P2'] == 1) {
					echo '<input type="hidden" value="INS" name="INS_UPD">';
				}else{
					echo '<input type="hidden" value="UPD" name="INS_UPD">';
				}

				if ($_GET ['P2'] == 1) {
					echo '<input type="text" name="bangou" maxlength="5" size="10" placeholder="000" value="' . $Smax .'" '.   '>';
				}else{
					echo '<input type="text" name="bangou" maxlength="3" size="10" placeholder="000" value="' . $S1 . '" ' . $ronly . $gray .  '>';
				}
			?>
			<br></td>
		</tr>

		<tr>
			<td align="left">メーカー</td>
			<td><select name="maker">
				<option value="Fujitsu" <?php echo $sct; ?>>Fujitsu</option>
				<option value="NEC">NEC</option>
				<option value="HP">HP</option>
				<option value="MITSUBISHI">MITSUBISHI</option>
				<option value="EPSON">EPSON</option>
				<option value="DELL">DELL</option>
				<option value="GALLERIA">GALLERIA</option>
				<option value="brother">brother</option>
				<option value="東芝">東芝</option>
				<option value="lenovo">lenovo</option>
				<option value="apple">apple</option>-
				<option value="欠番">欠番</option>
			<?php echo $optionMKR; ?>
			</select></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" size="18" value="' . $S2 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>			
			<td align="left">形状</td>
			<td><select name="keijyou">
				<option value="Desktop" <?php echo $sct; ?>>Desktop</option>
				<option value="note">note</option>
				<option value="printer">printer</option>
			<?php echo $optionDEV; ?>
			</select><br></td>
			<?php
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" size="18" value="' . $S3 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">購入日</td>
			<td><input type="text" name="date" maxlength="10" size="10"
				value="<?php echo $S4; ?>"></td>
                



			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" size="18" value="' . $S4 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">OS</td>
			<td><select name="SEL_OS">
			<option value="OS000">OS000</option>
				<?php
				echo $optionOSS;
				$sql = "SELECT no from t_os;";
				$res = mysql_query($sql);						
					while ($row = mysql_fetch_assoc($res)) {
						echo "<option>{$row['no']}</option>";
					}
				?>
			</select>
			<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="OLD_SEL_OS" size="18" value="' . $S5 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">OFFICE</td>
			<td><select name="office">
			<option value="OF000">OF000</option>
				<?php
				echo $optionOFI;
				$sql = "SELECT bangou from t_office;";
				$res = mysql_query($sql);
					while ($row = mysql_fetch_assoc($res)) {
						echo "<option>{$row['bangou']}</option>";
					}
				?>
			</select>
			<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="OLD_SEL_OF" size="18" value="' . $S6 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">ウイルス</td>
			<td><select name="virus">
			<option value="VU000">VU000</option>
				<?php
				echo $optionVIR;
				$sql = "SELECT number from t_virus;";
				$res = mysql_query($sql);
					while ($row = mysql_fetch_assoc($res)) {
						echo "<option>{$row['number']}</option>";
					}
				?>
		    

			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="OLD_SEL_VU" size="18" value="' . $S7 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
        </tr>

		<tr>

		    <?php
			echo '<tr><td>氏名</td><td>';
				$sql = "SELECT simei FROM t_syain;";
				echo '<select name="shimei" >';
				echo $optionNAM;
				$res = mysql_query($sql);
					while ($row = mysql_fetch_assoc($res)) {
						echo "<option>{$row['simei']}</option>";
					}

				?>
			</select>
			<br></td>	
	        <?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name=OLD_shimei size="18" value="' . $S8 . '" ' . $ronly . $gray .  '></td>';

				}
			?>
		</tr>

		<tr>
			<td align="left">場所</td>
			<td><input type="text" name="basho" maxlength="10" size="10"
				value="<?php echo $S9; ?>"></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name=OLD_basho size="18" value="' . $S9 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">貸出日</td>
			<td><input type="text" name="kashi" maxlength="10" size="10"
				value="<?php echo $S10; ?>"></td>

				

			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name=OLD_kashi size="18" value="' . $S10 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>

		<tr>
			<td align="left">返却日</td>
			<td><input type="text" name="henkyaku" maxlength="10" size="10"
				value="<?php echo $S11; ?>"></td>
				


			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name=OLD_henkyaku size="18" value="' . $S11 . '" ' . $ronly . $gray .  '></td>';
				}
			?>
		</tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="5" bordercolor="#000000"  width="357" style="border-collapse: collapse">
		<tr><button type="button" name="owner_upd" onclick="check2()">所有者更新</button></tr>
		<tr><td align="left">(旧)氏名</td><td><input type="text" name=kyu_shimei size="18" value="<?php echo $S12 . '" ' . $ronly . $gray; ?>"></td></tr>
		<tr><td align="left">(旧)場所</td><td><input type="text" name=kyu_basho size="18" value="<?php echo $S13 . '" ' . $ronly . $gray; ?>"></td></tr>
		<tr><td align="left">(旧)貸出日</td><td><input type="text" name=kyu_kashi size="18" value="<?php echo $S14 . '" ' . $ronly . $gray; ?>"></td></tr>
		<tr><td align="left">(旧)返却日</td><td><input type="text" name=kyu_henkyaku size="18" value="<?php echo $S15 . '" ' . $ronly . $gray; ?>"></td></tr>
	</table>
	</p>
</form>

<?php
$sw_os = 0;
$sw_of = 0;
$sw_vi = 0;


//if (isset ( $_POST ["000"] )) {
$sql = "SELECT pc FROM t_os where no =";
$sql = $sql . $_POST ['SEL_OS'];
$result = mysql_query ( $sql );
$os_pc = current ( mysql_fetch_row ( $result ) );
if ($os_pc != "" ) {
	$mon = "OS";
}

$sql = "SELECT pcno FROM t_office where bangou =";
$sql = $sql . $_POST ['office'];
$result = mysql_query ( $sql );
$of_pc = current ( mysql_fetch_row ( $result ) );
if ($of_pc != "" ) {
	$mon = "OFFICE";
}

$sql = "SELECT torokumei FROM t_virus where number =";
$sql = $sql . $_POST ['virus'];
$result = mysql_query ( $sql );
$vi_pc = current ( mysql_fetch_row ( $result ) );
if ($vi_pc != "" ) {
	$mon = "ウイルス";
}


echo($_POST ['SEL_OS']);
$con = mysql_close ( $con );
if (! $con) {
	exit ( 'データベースの接続を閉じられませんでした。' );
}
?>
</font>
<script type="text/javascript" language="javascript">
<!--
function check(){
	alert("1つ目のチェック");

	m = document.PC_DETAIL.bangou.value;
	l = document.PC_DETAIL.bangou.value.length;

	if(m.match( /^P(?=C)/ ) ){
		alert("先頭は「PC」です");
		if(m.match( /PC[0-9]{3}/ ) ){
			alert("番号は半角数字の「PC---」で入力してるね");
		}else{
			alert("番号は半角数字の「PC---」で入力してください");
			return false;			
		}
	}else{
		alert("先頭が「PC」でない");
		return false;
	}

	if(l != 5){ alert("番号は「PC---」の5文字で入力してください");
		return false; // 送信を中止
	}
}
function check2() {
	alert("2つ目のチェック");
	document.PC_DETAIL.kyu_shimei.value = document.PC_DETAIL.shimei.value;
	document.PC_DETAIL.kyu_basho.value = document.PC_DETAIL.basho.value;
	document.PC_DETAIL.kyu_kashi.value = document.PC_DETAIL.kashi.value;
	document.PC_DETAIL.kyu_henkyaku.value = document.PC_DETAIL.henkyaku.value;
}
function set_value(s_val){
	document.PC_DETAIL.INS_UPD.value = s_val;

}

// -->
</script>
</body>
</html>
