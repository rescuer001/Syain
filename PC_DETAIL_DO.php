<?php
ini_set( 'display_errors', 1 );
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
$param = $_POST["bangou"];



if ($_POST ["INS_UPD"] == "DEL"){
	$sql = "DELETE FROM t_pc WHERE ";
	$sql = $sql . "no = '";
	$sql = $sql . $param;
	$sql = $sql . "';";
	$result = mysql_query ( $sql ); 
	$sql = "UPDATE t_os SET ";
	$sql = $sql . "pc=";
	$sql = $sql . "'PC000'";
	$sql = $sql . " WHERE no = '";
	$sql = $sql . $_POST ['OLD_SEL_OS'];
	$sql = $sql . "';";
	$result = mysql_query ( $sql );

	$sql = "UPDATE t_office SET ";
	$sql = $sql . "pcno=";
	$sql = $sql . "'PC000'";
	$sql = $sql . " WHERE bangou = '";
	$sql = $sql . $_POST ['OLD_SEL_OF'];
	$sql = $sql . "';";
	$result = mysql_query ( $sql );

	$sql = "UPDATE t_virus SET ";
	$sql = $sql . "torokumei=";
	$sql = $sql . "'PC000'";
	$sql = $sql . " WHERE number = '";
	$sql = $sql . $_POST ['OLD_SEL_VU'];
	$sql = $sql . "';";
	$result = mysql_query ( $sql );
}else{
	if ($_POST ["INS_UPD"] == "UPD")  {
		$sql = "UPDATE t_pc SET ";
		$sql = $sql . "no='";
		$sql = $sql . $_POST ['bangou'];
		$sql = $sql . "',maker='";
		$sql = $sql . $_POST ['maker'];
		$sql = $sql . "',keijyou='";
		$sql = $sql . $_POST ['keijyou'];
		$sql = $sql . "',buy='";
		$sql = $sql . $_POST ['date'];
		$sql = $sql . "',ex_os='";
		$sql = $sql . $_POST ['SEL_OS'];
		$sql = $sql . "',office='";
		$sql = $sql . $_POST ['office'];
		$sql = $sql . "',virus='";
		$sql = $sql . $_POST ['virus'];
		$sql = $sql . "',simei='";
		$sql = $sql . $_POST ['shimei'];
		$sql = $sql . "',basyo='";
		$sql = $sql . $_POST ['basho'];
		$sql = $sql . "',kasidasi='";
		$sql = $sql . $_POST ['kashi'];
		$sql = $sql . "',hennkyaku='";
		$sql = $sql . $_POST ['henkyaku'];
		$sql = $sql . "',oldsimei='";
		$sql = $sql . $_POST ['OLD_shimei'];
		$sql = $sql . "',oldbasyo='";
		$sql = $sql . $_POST ['OLD_basho'];
		$sql = $sql . "',oldkasidasi='";
		$sql = $sql . $_POST ['OLD_kashi'];
		$sql = $sql . "',oldhennkyaku='";
		$sql = $sql . $_POST ['OLD_henkyaku'];
		$sql = $sql . "' WHERE no = '";
		$sql = $sql . $param;
		$sql = $sql . "';";
		echo $sql;
		$result = mysql_query ( $sql );

		if ($_POST ['SEL_OS'] != $_POST ['OLD_SEL_OS']) {
			$sql = "UPDATE t_os SET ";
			$sql = $sql . "pc='";
			$sql = $sql . $_POST ['bangou'];
			$sql = $sql . "' WHERE no = '";
			$sql = $sql . $_POST ['SEL_OS'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );

			$sql = "UPDATE t_os SET ";
			$sql = $sql . "pc=";
			$sql = $sql . "'PC000'";
			$sql = $sql . " WHERE no = '";
			$sql = $sql . $_POST ['OLD_SEL_OS'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
		if ($_POST ['office'] != $_POST ['OLD_SEL_OF']) {
			$sql = "UPDATE t_office SET ";
			$sql = $sql . "pcno='";
			$sql = $sql . $_POST ['bangou'];
			$sql = $sql . "' WHERE bangou = '";
			$sql = $sql . $_POST ['office'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );

			$sql = "UPDATE t_office SET ";
			$sql = $sql . "pcno=";
			$sql = $sql . "'PC000'";
			$sql = $sql . " WHERE bangou = '";
			$sql = $sql . $_POST ['OLD_SEL_OF'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
		if ($_POST ['virus'] != $_POST ['OLD_SEL_VU']) {
			$sql = "UPDATE t_virus SET ";
			$sql = $sql . "torokumei='";
			$sql = $sql . $_POST ['bangou'];
			$sql = $sql . "' WHERE number = '";
			$sql = $sql . $_POST ['virus'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );

			$sql = "UPDATE t_virus SET ";
			$sql = $sql . "torokumei=";
			$sql = $sql . "'PC000'";
			$sql = $sql . " WHERE number = '";
			$sql = $sql . $_POST ['OLD_SEL_VU'];
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}

		if ($_POST ['kyu_shimei'] != ""){
			$sql = "UPDATE t_pc SET ";
			$sql = $sql . "oldsimei='";
			$sql = $sql . $_POST ['kyu_shimei'];
			$sql = $sql . "' WHERE no = '";
			$sql = $sql . $param;
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
		if ($_POST ['kyu_basho'] != ""){
			$sql = "UPDATE t_pc SET ";
			$sql = $sql . "oldbasyo='";
			$sql = $sql . $_POST ['kyu_basho'];
			$sql = $sql . "' WHERE no = '";
			$sql = $sql . $param;
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
		if ($_POST ['kyu_kashi'] != ""){
			$sql = "UPDATE t_pc SET ";
			$sql = $sql . "oldkasidasi='";
			$sql = $sql . $_POST ['kyu_kashi'];
			$sql = $sql . "' WHERE no = '";
			$sql = $sql . $param;
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
		if ($_POST ['kyu_henkyaku'] != ""){
			$sql = "UPDATE t_pc SET ";
			$sql = $sql . "oldhennkyaku='";
			$sql = $sql . $_POST ['kyu_henkyaku'];
			$sql = $sql . "' WHERE no = '";
			$sql = $sql . $param;
			$sql = $sql . "';";
			$result = mysql_query ( $sql );
		}
	}else{
		//NEW PCNO CHECK
		$sql = "SELECT * FROM t_pc where no='";
		$sql = $sql . $_POST ['bangou'];
		$sql = $sql . "';";
		$result = mysql_query($sql);
		$num_rows = mysql_num_rows($result);
		if ($num_rows != 0) {
			$altmsg = "そのPC番号は使用中です";
			echo <<<EOM
			<script type="text/javascript">
			alert('$altmsg')
			</script>
EOM;

		}else{


			$sql = "INSERT INTO t_pc( no, maker, keijyou, buy, ex_os, office, virus, simei, basyo, kasidasi, hennkyaku )";
			$sql = $sql . " VALUES('";
			$sql = $sql . $_POST ['bangou'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['maker'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['keijyou'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['date'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['SEL_OS'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['office'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['virus'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['shimei'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['basho'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['kashi'];
			$sql = $sql . "','";
			$sql = $sql . $_POST ['henkyaku'];
			$sql = $sql . "');";
			$result = mysql_query ( $sql );
			if ($_POST) {
				if ($result) {
					$sql = "UPDATE t_os SET ";
					$sql = $sql . "pc = '";
					$sql = $sql . $_POST ['bangou'];
					$sql = $sql . "' where no = '";
					$sql = $sql . $_POST ['SEL_OS'];
					$sql = $sql . "';";
					$result = mysql_query ( $sql );
					$sql = "UPDATE t_office SET ";
					$sql = $sql . "pcno = '";
					$sql = $sql . $_POST ['bangou'];
					$sql = $sql . "' where bangou = '";
					$sql = $sql . $_POST ['office'];
					$sql = $sql . "';";
					$result = mysql_query ( $sql );
					$sql = "UPDATE t_virus SET ";
					$sql = $sql . "torokumei = '";
					$sql = $sql . $_POST ['bangou'];
					$sql = $sql . "' where number = '";
					$sql = $sql . $_POST ['virus'];
					$sql = $sql . "';";
					$result = mysql_query ( $sql );

					if ($_POST ['kyu_shimei'] != ""){
						$sql = "UPDATE t_pc SET ";
						$sql = $sql . "oldsimei='";
						$sql = $sql . $_POST ['kyu_shimei'];
						$sql = $sql . "' WHERE no = '";
						$sql = $sql . $param;
						$sql = $sql . "';";
						$result = mysql_query ( $sql );
					}
					if ($_POST ['kyu_basho'] != ""){
						$sql = "UPDATE t_pc SET ";
						$sql = $sql . "oldbasyo='";
						$sql = $sql . $_POST ['kyu_basho'];
						$sql = $sql . "' WHERE no = '";
						$sql = $sql . $param;
						$sql = $sql . "';";
						$result = mysql_query ( $sql );
					}
					if ($_POST ['kyu_kashi'] != ""){
						$sql = "UPDATE t_pc SET ";
						$sql = $sql . "oldkasidasi='";
						$sql = $sql . $_POST ['kyu_kashi'];
						$sql = $sql . "' WHERE no = '";
						$sql = $sql . $param;
						$sql = $sql . "';";
						$result = mysql_query ( $sql );
					}
					if ($_POST ['kyu_henkyaku'] != ""){
						$sql = "UPDATE t_pc SET ";
						$sql = $sql . "oldhennkyaku='";
						$sql = $sql . $_POST ['kyu_henkyaku'];
						$sql = $sql . "' WHERE no = '";
						$sql = $sql . $param;
						$sql = $sql . "';";
						$result = mysql_query ( $sql );
					}
				}
			}
		}
	}
}
$con = mysql_close ( $con );
if (! $con) {
	exit ( 'データベースの接続を閉じられませんでした。' );
	
}

//echo ("Location: PC_ICHIRAN.php?P1={$_POST ['INS_UPD']}");
//header("Location: PC_ICHIRAN.php?P1={$_POST ['INS_UPD']}");
?>

