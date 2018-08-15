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
<TITLE>PC管理簿</TITLE>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">PC管理簿
<form action="PC_ICHIRAN.php" method="post" onSubmit="return check()" name="mainForm" >
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='PC_index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " >
 <input type="button"  value="新規" onClick="location.href='PC_DETAIL.php?P2=1'"
style="WIDTH: 100px; margin-left: 0px; margin-right: 0px; ">
</div>

<?php
// Retuen PC_DETAIL_DO.php start

if ($_GET ['P1']  == 'UPD') {
  $altmsg = "正常に更新しました";
  echo <<<EOM
  <script type="text/javascript">
    alert('$altmsg')
  </script>
EOM;
}
if ($_GET ['P1'] == 'DEL') {
  $altmsg = "正常に削除しました";
  echo <<<EOM
  <script type="text/javascript">
    alert('$altmsg')
  </script>
EOM;
}
if ($_GET ['P1'] == 'INS') {
  $altmsg = "正常に追加しました";
  echo <<<EOM
  <script type="text/javascript">
    alert('$altmsg')
  </script>
EOM;
}
// Retuen PC_DETAIL_DO.php END

//データベースの取り込み
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

echo '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="1100" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th width="40" rowspan=2 >'.PC番号.'</th>';
echo '<th width="50" rowspan=2 >'.メーカー.'</th>';
echo '<th width="40" rowspan=2 >'.形状.'</th>';
echo '<th width="50" rowspan=2 >'.購入日.'</th>';
echo '<th width="40" rowspan=2 >'.OS番号.'</th>';
echo '<th width="40" rowspan=2 >'.OF番号.'</th>';
echo '<th width="40" rowspan=2 >'.VU番号.'</th>';
echo '<th width="400" colspan=4 >'.最新保有者.'</th>';
echo '<th width="400" colspan=4 >'.前回保有者.'</th>';
echo '</tr>';
echo '<th width="100">'.氏名.'</th>';
echo '<th width="100">'.場所.'</th>';
echo '<th width="100">'.貸出日.'</th>';
echo '<th width="100">'.返却日.'</th>';
echo '<th width="100">'.氏名.'</th>';
echo '<th width="100">'.場所.'</th>';
echo '<th width="100">'.貸出日.'</th>';
echo '<th width="100">'.返却日.'</th>';
echo '</thead>';

$sql = "select no,maker,keijyou,buy,ex_os,office,virus,simei,basyo,kasidasi,hennkyaku,oldsimei,oldbasyo,oldkasidasi,oldhennkyaku from t_pc order by no desc;";
if ($result = mysql_query($sql)) {
  echo '<tbody>';
  while ($data = mysql_fetch_array($result)) {
   		echo '<tr>';
      echo '<td>'.'<a href="PC_DETAIL.php?P1='.$data['no'].'">'.$data['no'].'</a>'.'</td>';
      echo '<td>'.$data['maker'].'</td>';
      echo '<td>'.$data['keijyou'].'</td>';
      echo '<td>'.$data['buy'].'</td>';
      echo '<td>'.$data['ex_os'].'</td>';
      echo '<td>'.$data['office'].'</td>';
      echo '<td>'.$data['virus'].'</td>';
      echo '<td>'.$data['simei'].'</td>';
      echo '<td>'.$data['basyo'].'</td>';
      echo '<td>'.$data['kasidasi'].'</td>';
      echo '<td>'.$data['hennkyaku'].'</td>';
      echo '<td>'.$data['oldsimei'].'</td>';
      echo '<td>'.$data['oldbasyo'].'</td>';
      echo '<td>'.$data['oldkasidasi'].'</td>';
      echo '<td>'.$data['oldhennkyaku'].'</td>';
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
</font>
</CENTER>


<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
$('#table_id').dataTable();
});
</script>

</body>
</html>
