<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}

$sql_check_menu = "SELECT * FROM `menu` order by `餐點名稱` asc";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>廚師資訊區-刪除菜單</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<h1 align="center" valign="center">廚師資訊區-刪除菜單</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "chef_data_menu_delete.php" method = "POST">
	<h3>菜名:</h3>
	<select class="form-select" aria-label="Default select example" name = '餐點名稱'>
	<?php
	$sql_check_menu = "SELECT * FROM `menu`";
	$sql_chec_menu_result = mysqli_query($link,$sql_check_menu);
	if (mysqli_num_rows($sql_chec_menu_result) > 0) {
		while ($row = mysqli_fetch_assoc($sql_chec_menu_result)) {
		echo "<option value='{$row['餐點名稱']}'>{$row['餐點名稱']}</option>";
		}
	}
	echo "</select>";
	echo "<button>刪除</button>";
	?>
	</form>
	<?php
	@ $delete_menu = $_POST['餐點名稱'];
	if($delete_menu != null){
		$delete_sql = "DELETE FROM `menu` WHERE `餐點名稱` = '{$delete_menu}'";
		$delete_sql_result = mysqli_query($link,$delete_sql);
		echo "<script language='JavaScript'>alert('刪除成功');</script>";
	}
	?>
	<a href="chef_data_menu.php"><input type="button" value="返回"></button></a>
</body>
</html>
