<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHPで外部プログラムを起動してみる</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

	<form action="" method="post">
		<input type="submit" name="program" value="起動する">
	</form>

<?php
		echo("GO000");
	if( isset($_POST["program"] )){
		//外部プログラムを実行する
		echo("GO001");
		exec("firefox");
	}
		echo("GO002");

?>

</body>
</html>