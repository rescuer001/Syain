<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>

<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
  <!-- jQuery -->
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

<style>
table {

   border-collapse: collapse;
   border: 1px solid #000000; /* 外枠 */
   table-layout: fixed;
   font-size:8pt;
}
table tr, table td{
   border-style: solid dotted;/* 線種 */
   border-width: 1px; /* 線の太さ */
   border-color: #000000; /* 線色 */
   font-weight: normal;
}

div.形状 { overflow: hidden; }
div.URL { overflow: hidden; }
</style>

<img src="logo72.png" alt="写真" width="100px" align="left">
<br>
<center>
<TITLE>役割テーブル一覧</TITLE>
</br>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">役割テーブル一覧
<form action="wari_ichiran.php" method="post" onSubmit="return check()" name="mainForm" >
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " >
 <input type="button"  value="新規" onClick="location.href='wari_new.php?P2=1'"
style="WIDTH: 100px; margin-left: 0px; margin-right: 0px; ">
 </Div>
 </font>

<?php
//データベースの取り込み
$con = mysql_connect('localhost', 'root', 'sakamoto');
if (!$con) {
	exit('データベースに接続できませんでした。');
}

$result = mysql_select_db('db_syain', $con);
if (!$result) {
	exit('データベースを選択できませんでした。');
}
$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
	exit('文字コードを指定できませんでした。');
}

echo  '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="1000" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th nowrap width="5">'.役割.'</th>';
echo '<th nowrap width="60">'.役割名.'</th>';
echo '<th nowrap width="30">'.役割手当て.'</th>';
echo '</tr>';
echo '</thead>';

$sql = "SELECT * FROM db_syain.wari_m order by no desc;";
$result = mysql_query($sql);
if ($result) {
    echo '<tbody>';
   	while ($data = mysql_fetch_array($result)) {

   		  echo '<td>'.'<a href="wari_new.php?P1='.$data['wari_no'].'">'.$data['wari_no'].'</a>'.'</td>';
        echo '<td>'.$data['wari_nm'].'</td>';
        echo '<td>'.$data['wari_kin'].'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
}

echo '</table>';

$con = mysql_close($con);
if (!$con) {
	exit('データベースとの接続を閉じられませんでした。');
}
?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#table_id').dataTable();
});
</script>

</body>
</html>
