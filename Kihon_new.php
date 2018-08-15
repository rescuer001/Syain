<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>


<title>基本情報テーブル一覧</title>


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
//更新したい基本情報からデータの取り出し
$sql = "SELECT * FROM syain_t where syain_code='";
$sql = $sql . $_GET ['p1'];
$sql = $sql . "';";

if ($result = mysql_query ( $sql )) {
    if ($row = mysql_fetch_array ( $result )) {
        $S1 = $row ['syain_code'];
        $S2 = $row ['name'];
	    $S3 = $row ['furigana'];
	    $S4 = $row ['birth_day'];
	    $S5 = $row ['age'];
	    $S6 = $row ['in_day'];
	    $S7 = $row ['insei_day'];
	    $S8 = $row ['kinzoku_nen'];
	    $S9 = $row ['kinzoku_nisu'];
	    $S10 = $row ['post_cd'];
	    $S11 = $row ['division_cd'];
	    $S12 = $row ['syoku_no'];
	    $S13 = $row ['syoku_nm'];
	    $S14 = $row ['kihon_kin'];
	    $S15 = $row ['yaku_no'];
	    $S16 = $row ['wari_no'];
	    $S17 = $row ['wari_ninzu'];
	    $S18 = $row ['kinrou_su'];
	    $S19 = $row ['nenkin_su'];
	    $S20 = $row ['jyutaku_kin'];
	    $S21 = $row ['taisyoku_kbun'];
	    $S22 = $row ['taisyoku_day'];
	    $S23 = $row ['addr1_nm'];
	    $S24 = $row ['addr2_nm'];
	}
}

// 初期化
$sct = null;
$error_sw = null;
$error_msg = null;

// 編集時のグレートアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

// 形状プルダウンセレクト
$optionPOST = "<option value=\"$S10\" selected>$S10</option>";
$optionJIGYO = "<option value=\"$S11\" selected>$S11</option>";
$optionSYOKUC = "<option value=\"$S12\" selected>$S12</option>";
$optionSYOKUNM = "<option value=\"$S13\" selected>$S13</option>";
$optionYAKUNO = "<option value=\"$S15\" selected>$S15</option>";
$optionWARINO = "<option value=\"$S16\" selected>$S16</option>";

// プルダウン初期化
$optionPOST = null;
$optionJIGYO = null;
$optionSYOKUC = null;
$optionSYOKUNM = null;
$optionYAKUNO = null;
$optionWARINO = null;

// 新規作成時の設定
if ($_GET ['P2'] == 1) {
// 選択済み用変数
	$sct = "selected";
// 番号の最大値取得
	$sql = "SELECT MAX(syain_cd) FROM syain_t;";

}
    
?>
<center><font size="4">基本情報テーブル一覧</font></center>
<form  action=""  name="ichiran"  id="ichiran" method="post" >
<button type="button" onClick="location.href='index.php'">メニュー</button><button type="button" onClick="location.href='Kihon_ichiran.php'">一覧</button><button type="submit" onclick="return check()" name ="update_or_insert" <?php  echo $CK; ?>>更新</button><button type="submit" name ="delete" >削除</button>

<table border="1" cellspacing="0" cellpadding="3" bordercolor="#000000" width="600" style="border-collapse: collapse">
<tr><td width="100" align="left">社員番号</td>
<td>
<?php
if ($_GET ['P2'] == 1) {
    echo '<input type="text" pattern="[0-9]*" name="syain_code" maxlength="40" size="40" placeholder="社員番号を入力してください" value="" >';
}else{
    echo '<input type="text" pattern="[0-9]*" name="syain_code" maxlength="40" size="40" placeholder="社員番号を入力してください" value="' . $S1 . '" ' . $ronly . $gray .  '>';
}
?>
<br>
</td>
</tr>

<tr>
<td align="left">氏名</td>
<td>
<?php
echo '<input type="text" name="name" maxlength="40" size="40" value= "' . $S2 .'" '. '>';
?>
<br>

</td>
</tr>

<tr>
<td align="left">フリガナ</td>
<td>
<?php
echo '<input type="text" name="furigana" maxlength="40" size="40" value= "' . $S3 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">生年月日</td>
<td>
<?php
echo '<input type="text" name="birth_day" maxlength="40" size="40" value= "' . $S4 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">年齢</td>
<td>
<?php
echo '<input type="text" name="age" maxlength="40" size="40" value= "' . $S5 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">入社日</td>
<td>
<?php
echo '<input type="text" name="in_day" maxlength="40" size="40" value= "' . $S6 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">正社員雇用日</td>
<td>
<?php
echo '<input type="text" name="insei_day" maxlength="40" size="40" value= "' . $S7 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">勤続年数</td>
<td>
<?php
echo '<input type="text" name="kinzoku_nen" maxlength="40" size="40" value= "' . $S8 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">勤続日数</td>
<td>
<?php
echo '<input type="text" name="kinzoku_nisu" maxlength="40" size="40" value= "' . $S9 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">郵便番号</td>
<td><select name="post_cd">
<?php
echo $optionPOST;
$sql = "SELECT post_cd from addr_m ORDER BY post_cd;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['post_cd']}</option>";
}
?>
</select>
<br></td>
<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="post_cd" size="40" onKeyUp= value="' . $S10 . '" ' . $ronly . $gray .  '>
<input type="text" name="addr1_nm" size="40" value="' . $S23 .'" '. '><input type="text" name="addr2_nm" size="40" value="' . $S24 .'" '. '></td>';
				}
?>
</tr>


<tr>
<td align="left">事業部名</td>
<td><select name="jigyo_nm">
<?php
echo $optionJIGYO;
$sql = "SELECT jigyo_nm from jigyo_m ORDER BY jigyo_cd;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['jigyo_nm']}</option>";
}
?>
</select>
<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="jigyo_nm" size="40" value="' . $S11 . '" ' . $ronly . $gray .  '></td>';
				}
			?>

</tr>

<tr>
<td align="left">職位ナンバー</td>
<td><select name="syoku_no">
<?php
echo $optionSYOKUC;
$sql = "SELECT syoku_no from syoku_m ORDER BY syoku_no;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['syoku_no']}</option>";
}
?>
</select>
<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="syoku_no" size="40" value="' . $S12 . '" ' . $ronly . $gray .  '></td>';
				}
			?>

</tr>

<tr>
<td align="left">職位名</td>
<td><select name="syoku_nm">
<?php
echo $optionSYOKUNM;
$sql = "SELECT syoku_nm from syoku_m ORDER BY syoku_nm;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['syoku_nm']}</option>";
}
?>
</select>
<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="syoku_nm" size="40" value="' . $S13 . '" ' . $ronly . $gray .  '></td>';
				}
			?>

</tr>

<tr>
<td align="left">基本給</td>
<td>
<?php
echo '<input type="text" name="kihon_kin" maxlength="40" size="40" value= "' . $S14 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">役職ナンバー</td>
<td><select name="yaku_no">
<?php
echo $optionYAKUNO;
$sql = "SELECT yaku_no from yaku_m ORDER BY yaku_no;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['yaku_no']}</option>";
}
?>
</select>
<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="yaku_no" size="40" value="' . $S15 . '" ' . $ronly . $gray .  '></td>';
				}
			?>

</tr>

<tr>
<td align="left">役割ナンバー</td>
<td><select name="wari_no">
<?php
echo $optionWARINO;
$sql = "SELECT wari_no from wari_m ORDER BY wari_no;";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    echo "<option>{$row['wari_no']}</option>";
}
?>
</select>
<br></td>
			<?php 
				if ($_GET ['P2'] != 1) {
					echo '<td><input type="text" name="wari_no" size="40" value="' . $S16 . '" ' . $ronly . $gray .  '></td>';
				}
			?>

</tr>

<tr>
<td align="left">部下人数(チーフ)</td>
<td>
<?php
echo '<input type="text" name="wari_ninzu" maxlength="40" size="40" value= "' . $S17 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">勤労福祉口数</td>
<td>
<?php
echo '<input type="text" name="kinrou_su" maxlength="40" size="40" value= "' . $S18 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">関東IT年金口数</td>
<td>
<?php
echo '<input type="text" name="nenkin_su" maxlength="40" size="40" value= "' . $S19 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">住宅手当</td>
<td>
<?php
echo '<input type="text" name="jyutaku_kin" maxlength="40" size="40" value= "' . $S20 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">退職区分</td>
<td>
<?php
echo '<input type="text" name="taisyoku_kbun" maxlength="40" size="40" value= "' . $S21 .'" '. '>';
?>
<br>
</td>
</tr>

<tr>
<td align="left">退職日</td>
<td>
<?php
echo '<input type="text" name="taisyoku_day" maxlength="40" size="40" value= "' . $S22 .'" '. '>';
?>
<br>
</td>
</tr>

</table>

<?php
if (isset ( $_POST ["update_or_insert"] )) {
        if ($_GET ['P2'] == 1) {
            
            #Duplicate
            $sql = "SELECT count(*) as wk_num FROM syain_t where syain_code='";
            $sql = $sql . $_POST ['syain_code'];
            $sql = $sql . "';";
            $res = mysql_query ( $sql );
            $row = mysql_fetch_assoc($res);
            if ($row['wk_num'] == 1) {
                exit ( "入力された社員番号は使用済みです。");
            }

                
		$sql = "INSERT INTO syain_t(syain_code, name, furigana, birth_day, age, in_day, insei_day, kinzoku_nen, kinzoku_nisu, post_cd, division_cd, syoku_no,syoku_nm, kihon_kin, yaku_no, wari_no, wari_ninzu, kinrou_su, nenkin_su, jyutaku_kin, taisyoku_kbun, taisyoku_day)";
		$sql = $sql . " VALUES('";
		$sql = $sql . $_POST ['syain_code'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['name'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['furigana'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['birth_day'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['age'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['in_day'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['insei_day'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kinzoku_nen'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kinzoku_nisu'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['post_cd'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['division_cd'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['syoku_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['syoku_nm'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kihon_kin'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['yaku_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['wari_no'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['wari_ninzu'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['kinrou_su'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['nenkin_su'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['jyutaku_kin'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['taisyoku_kbun'];
		$sql = $sql . "','";
		$sql = $sql . $_POST ['taisyoku_day'];
		$sql = $sql . "');";
		$result = mysql_query ( $sql );
		if ($_POST) {
		    if ($result) {
		        header ( "Location: Kihon_ichiran.php" );
		        echo ("<p>情報を作成しました。</p>");
		    } else {
		       echo ("<p>情報の作成に失敗しました</p>");
		    }
		}
	} else {
	    // kousinn
	    $sql = "UPDATE syain_t SET ";
	    
	    $sql = $sql . "syain_code='";
	    $sql = $sql . $_POST ['syain_code'];
	    $sql = $sql . "',";
	    $sql = $sql . "name='";
	    $sql = $sql . $_POST ['name'];
	    $sql = $sql . "',";
	    $sql = $sql . "furigana='";
	    $sql = $sql . $_POST ['furigana'];
	    $sql = $sql . "',";
	    $sql = $sql . "birth_day='";
	    $sql = $sql . $_POST ['birth_day'];
	    $sql = $sql . "',";
	    $sql = $sql . "age='";
	    $sql = $sql . $_POST ['age'];
	    $sql = $sql . "',";
	    $sql = $sql . "in_day='";
	    $sql = $sql . $_POST ['in_day'];
	    $sql = $sql . "',";
	    $sql = $sql . "insei_day='";
	    $sql = $sql . $_POST ['insei_day'];
	    $sql = $sql . "',";
	    $sql = $sql . "kinzoku_nen='";
	    $sql = $sql . $_POST ['kinzoku_nen'];
	    $sql = $sql . "',";
	    $sql = $sql . "kinzoku_nisu='";
	    $sql = $sql . $_POST ['kinzoku_nisu'];
	    $sql = $sql . "',";
	    $sql = $sql . "post_cd='";
	    $sql = $sql . $_POST ['post_cd'];
	    $sql = $sql . "',";
	    $sql = $sql . "division_cd='";
	    $sql = $sql . $_POST ['division_cd'];
	    $sql = $sql . "',";
	    $sql = $sql . "syoku_no='";
	    $sql = $sql . $_POST ['syoku_no'];
	    $sql = $sql . "',";
	    $sql = $sql . "syoku_nm='";
	    $sql = $sql . $_POST ['syoku_nm'];
	    $sql = $sql . "',";
	    $sql = $sql . "kihon_kin='";
	    $sql = $sql . $_POST ['kihon_kin'];
	    $sql = $sql . "',";
	    $sql = $sql . "yaku_no='";
	    $sql = $sql . $_POST ['yaku_no'];
	    $sql = $sql . "',";
	    $sql = $sql . "wari_no='";
	    $sql = $sql . $_POST ['wari_no'];
	    $sql = $sql . "',";
	    $sql = $sql . "wari_ninzu='";
	    $sql = $sql . $_POST ['wari_ninzu'];
	    $sql = $sql . "',";
	    $sql = $sql . "kinrou_su='";
	    $sql = $sql . $_POST ['kinrou_su'];
	    $sql = $sql . "',";
	    $sql = $sql . "nenkin_su='";
	    $sql = $sql . $_POST ['nenkin_su'];
	    $sql = $sql . "',";
	    $sql = $sql . "jyutaku_kin='";
	    $sql = $sql . $_POST ['jyutaku_kin'];
	    $sql = $sql . "',";
	    $sql = $sql . "taisyoku_kbun='";
	    $sql = $sql . $_POST ['taisyoku_kbun'];
	    $sql = $sql . "',";
	    $sql = $sql . "taisyoku_day='";
	    $sql = $sql . $_POST ['taisyoku_day'];
	    $sql = $sql . "'";
	    $sql = $sql . " WHERE ";
	    $sql = $sql . "syain_code = '";
	    $sql = $sql . $S1;
	    $sql = $sql . "';";
	    $result = mysql_query ( $sql );
	    if ($result) {
	        echo ("<p>情報を更新しました。</p>");
	        header ( "Location: Kihon_ichiran.php" );
	    } else {
	        echo ("<p>情報の更新に失敗しました</p>");
	    }
	}
	

} else if (isset ( $_POST ["delete"] )) {

   $sql = "DELETE FROM syain_t WHERE ";
    $sql = $sql . "syain_code = '";
    $sql = $sql . $S1;
    $sql = $sql . "';";
   $result = mysql_query ( $sql );
    if ($result) {
        echo ("<p>削除に成功しました。</p>");
        header ( "Location: Kihon_ichiran.php" );
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
	a = document.ichiran.syain_code.value.//formタグ内にあるinputタグのvalue(name属性を取る)
	n = document.forms.ichiran.syain_code.value.length;
	if(n != 7){alert("半角数字の7桁で入力してください。");
		return false; //送信を中止
}	
if(a.match( /[^0-9.,-]+/ ) ){
	alert("半角数字で入力してください");
	return false;
	}
//var del = <?php //echo json_encode($_GET ['P4']); ?>;
//-->
</script>

</form>
</body>
</html>