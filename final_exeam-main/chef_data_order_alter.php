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
<title>廚師資訊區-修改訂單狀態</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">廚師資訊區-修改訂單狀態</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "chef_data_order_alter.php" method = "POST">
	<h3>桌號:</h3>
	<select class="form-select" aria-label="Default select example" name = '桌號'>
	<?php
	$sql_check_table_number = "SELECT `桌號` FROM `diningtable` order by `桌號` asc";
	$table_result = mysqli_query($link,$sql_check_table_number);
	if (mysqli_num_rows($table_result) > 0) {
		while ($row = mysqli_fetch_assoc($table_result)) {
		$row = implode(" ",$row);
		echo "<option value='{$row}'>桌號: {$row}</option>";
		}
	}
	echo "</select>";
	echo "<button>查詢</button>";
	?>
	</form>
	<form align="center" action = "chef_data_order_alter.php" method = "POST">
	<?php
	@ $table_number = $_POST['桌號'];
	echo "<h3>桌號: </h3>";
	echo "<input name = '桌號' value = '{$table_number}' required readonly>";
	echo "<h3>訂單:</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '餐點名稱'>";
	$sql_check_menu = "SELECT * FROM `order` WHERE `桌號` = '{$table_number}'";
	$sql_check_menu_result = mysqli_query($link,$sql_check_menu);
	if (mysqli_num_rows($sql_check_menu_result) > 0) {
		while ($row = mysqli_fetch_assoc($sql_check_menu_result)) {
			echo "<option value='{$row['餐點']}'>{$row['餐點']}</option>";
		}
	}
	echo "</select>";
	echo "<h3>狀態</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '狀態'>
		  <option>未出餐</option>
		  <option>可出餐</option>
		  <option>已出餐</option>
		  </select>";
	echo "<button>更改</button>";
	?>
	<?php
	 @ $table_number = $_POST['桌號'];
	 @ $order_name = $_POST['餐點名稱'];
	 @ $order_state = $_POST['狀態'];
	 @ $update_order_state = "UPDATE `order` SET `狀態` =  '{$order_state}'
	 						WHERE `桌號` = '{$table_number}' 
							AND `餐點` = '{$order_name}'";
	
	 @ $update_result = mysqli_query($link,$update_order_state);
	if(@ $order_state != null){
		$update_state = mysqli_query($link,$update_order_state);
		echo "<script language='JavaScript'>alert('修改成功');</script>";
	}
	?>
	<a href="chef_data.php"><input type="button" value="返回"></button></a>
</body>
</html>