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

</style>

<img src="logo72.png" alt="写真" width="100px" align="left">
<br>
<center>
<TITLE>ウイルスソフトライセンス一覧</TITLE>
</br>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">ウイルスソフトライセンス一覧
<form action="VIRUS_ICHIRAN.php" method="post" onSubmit="return check()" name="mainForm" >
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='PC_index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " >
 <input type="button"  value="新規" onClick="location.href='VIRUS_DETAIL.php?P2=1'"
style="WIDTH: 100px; margin-left: 0px; margin-right: 0px; ">
 </Div>
 </font>

<?php
$con = mysql_connect('localhost', 'pc_user', 'pcpass');
if (!$con) {
  exit('データベースに接続できませんでした。');
}
$result = mysql_select_db('db_pc', $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}
$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}
echo '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="600" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th nowrap width="80" >'.VIRUS番号.'</th>';
echo '<th nowrap width="300" >'.品名.'</th>';
echo '<th nowrap width="200" >'.シリアル番号.'</th>';
echo '<th nowrap width="50" >'.PC番号.'</th>';
echo '<th nowrap width="300" >'.URL.'</th>';
echo '<th nowrap width="300" >'.備考.'</th>';
echo '</tr>';
echo '</thead>';

$sql = "SELECT * FROM t_virus ";
$sql =$sql . "order by number desc";
$sql =$sql . ";";
$result = mysql_query($sql);
if ($result) {
  echo '<tbody>';
   	while ($data = mysql_fetch_array($result)) {

        if($data['torokumei'] == 'PC000'){
          echo '<tr style="background-color: #FFFFFF">'; 
        }else{
          echo '<tr style="background-color: #b5b5b5">'; 
        }
   		      echo '<td nowrap width="80"><a href="VIRUS_DETAIL.php?P1='.$data['number'].'">'.$data['number'].'</a></td>';
              echo '<td nowrap width="300">'.$data['hinmei'].'</td>';
              echo '<td nowrap width="250">'.$data['cereal'].'</td>';
              echo '<td nowrap width="50">'.$data['torokumei'].'</td>';
              echo '<td nowrap width="300"><a href="'.$data['url'].'">'.$data['url'].'</a></td>';
              echo '<td nowrap width="300">'.$data['bikou'].'</td>';
              echo '</tr>';
    }
    echo '</tbody>';
}

$con = mysql_close($con);
if (!$con) {
	exit('データベースとの接続を閉じられませんでした。');
}
?>

</table>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#table_id').dataTable();
});
</script>

</body>
</html>