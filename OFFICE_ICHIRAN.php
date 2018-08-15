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
<TITLE>OFFICEライセンス一覧</TITLE>
</br>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="margin: 0;">
<font face="メイリオ">
<font size="4">office一覧
<form action="OFFICE_ICHIRAN.php" method="post" onSubmit="return check()" name="mainForm" >
</center>
<table border="2" cellspacing="0" cellpadding="5"
 bordercolor="#000000"  width="100%" style="border-collapse: collapse">
 <Div Align="left">
<input type="button"  value="メニュー" onClick="location.href='PC_index.php'"
style="WIDTH: 100px; margin-left: 7px; margin-right: 0px;  " >
 <input type="button"  value="新規" onClick="location.href='OFFICE_DETAIL.php?P2=1'" 
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




echo  '<div class="x_scroll_box">';
echo  '<table border="1" cellspacing="0" cellpadding="5"  bordercolor="#000000"  width="1500" style="border-collapse: collapse" id="table_id" class="display">';
echo '<thead>';
echo '<tr align="center">';
echo '<th nowrap width="40">'.OFFICE番号.'</th>';
echo '<th nowrap width="80">'.キー.'</th>';
echo '<th nowrap width="50">'.メディア名.'</th>';
echo '<th nowrap width="50">'.形状.'</th>';
echo '<th nowrap width="50">'.購入日.'</th>';
echo '<th nowrap width="30">'.PC番号.'</th>';
echo '<th nowrap width="80">'.URL.'</th>';
echo '<th nowrap width="80">'.UID.'</th>';
echo '<th nowrap width="50">'.パスワード.'</th>';
echo '<th nowrap width="80">'.備考.'</th>';
echo '</tr>';
echo '</thead>';

$sql = "SELECT * FROM t_office  ORDER BY bangou DESC";
$sql =$sql . ";";
$result = mysql_query($sql);

if ($result) {
  echo '<tbody>';
   	while ($data = mysql_fetch_array($result)) {
        
        //if($data['pcno']==''){
        if($data['pcno'] == 'PC000'){          
          echo '<tr style="background-color: #FFFFFF">'; 
        }else{
          echo '<tr style="background-color: #b5b5b5">'; 
        }
   	    echo '<td nowrap width="40"><a href="OFFICE_DETAIL.php?p1='.$data['bangou'].'">'.$data['bangou'].'</a></td>';
        echo '<td nowrap width="80">'.$data['key1'].'</td>';
        echo '<td nowrap width="50">'.$data['media'].'</td>';
        echo '<td nowrap width="50">'.$data['syurui'].'</td>';
        echo '<td nowrap width="50">'.$data['kounyuubi'].'</td>';
        echo '<td nowrap width="30">'.$data['pcno'].'</td>';
        echo '<td nowrap width="80"><a href="'.$data['url'].'">'.$data['url'].'</a></td>';
        echo '<td nowrap width="80">'.$data['uid'].'</td>';
        echo '<td nowrap width="50">'.$data['pass'].'</td>';
        echo '<td nowrap width="80">'.$data['bikou'].'</td>';
        echo '</tr>';
    }
  echo '</tbody>';
}

echo  '</table>';
echo  '</div>';

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