<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);
if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>廚師資訊區-新增菜單</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">廚師資訊區-新增菜單</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "chef_data_menu_add.php" method = "POST">
	<?php
	echo "<h3>菜名</h3>";
	echo "<input name = '菜名'>";
	echo "<h3>食材</h3>";
	echo "<input name = '食材'>";
	echo "<h3>金額</h3>";
	echo "<input name = '金額'>";
	?>
	<button>新增</button>
	</form>
	<a href="chef_data_menu.php"><input type="button" value="返回"></button></a>
	<?php
	@ $dish_name = $_POST['菜名'];
	@ $Ingredients = $_POST['食材'];
	@ $money = $_POST['金額'];
	$save_menu = "INSERT INTO `menu` (`ID`,`餐點名稱`,`食材`,`金額`,`狀態`) VALUES (NULL,'{$dish_name}','{$Ingredients}','{$money}','可販售')";
	if($dish_name != null and $Ingredients != null and $money != null){
		$save_money_result = mysqli_query($link,$save_menu);
		echo "<script language='JavaScript'>alert('新增成功');</script>";
	}
	?>
</body>
</html>
