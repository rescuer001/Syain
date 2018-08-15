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
<TITLE>OSライセンス一覧</TITLE>
</br>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">OSライセンス一覧
<form action="OS_ICHIRAN.php" method="post" onSubmit="return check()" name="mainForm" >
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='PC_index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " >
 <input type="button"  value="新規" onClick="location.href='OS_DETAIL.php?P2=1'"
style="WIDTH: 100px; margin-left: 0px; margin-right: 0px; ">
 </Div>
 </font>

<?php
echo ("OS_ICHIRAN 000");
//データベースの取り込み
$con = mysql_connect('localhost', 'pc_user', 'pcpass');
if (!$con) {
	exit('データベースに接続できませんでした。');
}
echo ("OS_ICHIRAN 001");

$result = mysql_select_db('db_pc', $con);
if (!$result) {
	exit('データベースを選択できませんでした。');
}
X:\03.PC管理簿\6.Source\OS_ICHIRAN.php$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
	exit('文字コードを指定できませんでした。');
}
echo ("OS_ICHIRAN 002");

// 編集時のグレーアウト
$ronly = "readonly=\"readonly\" ";
$gray = "style=\"background-color:#b5b5b5\" ";

echo  '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="1000" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th nowrap width="5">'.OS番号.'</th>';
echo '<th nowrap width="60">'.ライセンス.'</th>';
echo '<th nowrap width="30">'.OS.'</th>';
echo '<th nowrap width="10">'.購入日.'</th>';
echo '<th nowrap width="15">'.形状.'</th>';
echo '<th nowrap width="5">'.PC番号.'</th>';
echo '<th nowrap width="60">'.URL.'</th>';
echo '<th nowrap width="60">'.備考.'</th>';
echo '</tr>';
echo '</thead>';

$sql = "SELECT * FROM t_os order by no desc;";
$result = mysql_query($sql);
if ($result) {
    echo '<tbody>';
    echo ("OS_ICHIRAN 003");
   	while ($data = mysql_fetch_array($result)) {

        if($data['pc'] == 'PC000'){
          echo '<tr style="background-color: #FFFFFF">'; 
        }else{
          echo '<tr style="background-color: #b5b5b5">'; 
        }
   		  echo '<td>'.'<a href="OS_DETAIL.php?P1='.$data['no'].'">'.$data['no'].'</a>'.'</td>';
        echo '<td>'.$data['licence'].'</td>';
        echo '<td>'.$data['os_name'].'</td>';
        echo '<td>'.$data['buy_date'].'</td>';
        echo '<td>'.$data['shape'].'</td>';
        echo '<td>'.$data['pc'].'</td>';
        echo '<td><a href="'.$data['url'].'">'.$data['url'].'</a></td>';
        echo '<td>'.$data['biko'].'</td>';
        echo '</tr>';
    }
    echo '</tbody>';
}

echo '</table>';
echo ("OS_ICHIRAN 004");

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
