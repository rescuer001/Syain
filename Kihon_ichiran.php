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
   border-width: 1px; /* 線種 */
   border-color: #000000; /* 線色 */
   font-weight: normal;
}

</style>

<img src="logo72.png" alt="写真" width="100px" align="left">
<br>
<center>
<TITLE>基本情報テーブル一覧</TITLE>
</br>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">基本情報テーブル一覧
<form action="Kihon_ichiran.php" method="post" onSubmit="return check()" name="mainForm">
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " ><input type="button"  value="新規" onClick="location.href='Kihon_new.php?P2=1'"
style="WIDTH: 100px; margin-left: 0px; margin-right: 0px; ">
 </Div>
 </font>
 
 <script>
//更新
function koshin(){
  location.reload();
}
</script>
 
<?php

//データベースの取り込み
$con = mysql_connect('localhost', 'root', 'sakamoto');
if (!$con) {
	exit('データベースに接続できませんでした。');
}
$result = mysql_select_db('db_syain', $con);
if (!$result) {
	exit('データベースを選択できませんでした');
}
$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
	exit('文字コードを指定できませんでした。');
}


echo  '<div class="x_scroll_box">';
echo  '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="1000" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th nowrap width="5">'.社員番号.'</th>';
echo '<th nowrap width="40">'.氏名.'</th>';
echo '<th nowrap width="40">'.フリガナ.'</th>';
echo '<th nowrap width="40">'.生年月日.'</th>';
echo '<th nowrap width="5">'.年齢.'</th>';
echo '<th nowrap width="40">'.入社日.'</th>';
echo '<th nowrap width="40">'.正社員雇用日.'</th>';
echo '<th nowrap width="5">'.勤続年数.'</th>';
echo '<th nowrap width="5">'.勤続日数.'</th>';
echo '<th nowrap width="40">'.郵便番号.'</th>';
echo '<th nowrap width="5">'.事業部名.'</th>';
echo '<th nowrap width="10">'.職位ナンバー.'</th>';
echo '<th nowrap width="10">'.職位名.'</th>';
echo '<th nowrap width="40">'.基本給.'</th>';
echo '<th nowrap width="10">'.役職ナンバー.'</th>';
echo '<th nowrap width="10">'.役割ナンバー.'</th>';
echo '<th nowrap width="40">'.部下人数（チーフ）.'</th>';
echo '<th nowrap width="40">'.勤労福祉口数.'</th>';
echo '<th nowrap width="40">'.関東IT年金口数.'</th>';
echo '<th nowrap width="40">'.住宅手当.'</th>';
echo '<th nowrap width="40">'.退職区分.'</th>';
echo '<th nowrap width="40">'.退職日.'</th>';

$sql = "SELECT * FROM syain_t ORDER BY syain_code DESC";
$result = mysql_query($sql);

if ($result) {
    echo '<tbody>';
   	while ($data = mysql_fetch_array($result)) {
   	    if($data['syain_code'] == '000'){
          echo '<tr style="background-color: #FFFFFF">'; 
   	    }else{
          echo '<tr style="background-color: #FFFFFF">'; 
        }
        //echo '<td>'.'<a href="addr_ichiran.php?P1='.$data['syain_code'].'">'.$data['syain_code'].'</a>'.'</td>';
        echo '<td nowrap width="40" tr style="background-color: #FFFFFF"><a href="Kihon_new.php?p1='.$data['syain_code'].'">'.$data['syain_code'].'</a></td>';
        echo '<td nowrap width="50">'.$data['name'].'</td>';
        echo '<td nowrap width="50">'.$data['furigana'].'</td>';
        echo '<td nowrap width="50">'.$data['birth_day'].'</td>';
        echo '<td nowrap width="50">'.$data['age'].'</td>';
        echo '<td nowrap width="50">'.$data['in_day'].'</td>';
        echo '<td nowrap width="50">'.$data['insei_day'].'</td>';
        echo '<td nowrap width="50">'.$data['kinzoku_nen'].'</td>';
        echo '<td nowrap width="50">'.$data['kinzoku_nisu'].'</td>';
        echo '<td nowrap width="50">'.$data['post_cd'].'</td>';
        echo '<td nowrap width="50">'.$data['division_cd'].'</td>';
        echo '<td nowrap width="50">'.$data['syoku_no'].'</td>';
        echo '<td nowrap width="50">'.$data['syoku_nm'].'</td>';
        echo '<td nowrap width="50">'.$data['kihon_kin'].'</td>';
        echo '<td nowrap width="50">'.$data['yaku_no'].'</td>';
        echo '<td nowrap width="50">'.$data['wari_no'].'</td>';
        echo '<td nowrap width="50">'.$data['wari_ninzu'].'</td>';
        echo '<td nowrap width="50">'.$data['kinrou_su'].'</td>';
        echo '<td nowrap width="50">'.$data['nenkin_su'].'</td>';
        echo '<td nowrap width="50">'.$data['jyutaku_kin'].'</td>';
        echo '<td nowrap width="50">'.$data['taisyoku_kbun'].'</td>';
        echo '<td nowrap width="50">'.$data['taisyoku_day'].'</td>';
        
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
