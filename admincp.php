<main id="main" class="main">

<div class="pagetitle">
  <h1>Quản trị website</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
	  <li class="breadcrumb-item">Forms</li>
	  <li class="breadcrumb-item active">Elements</li>
	</ol>
  </nav>
</div><!-- End Page Title -->
<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
require_once("mysql.php");
//start: fix  Undefined index
if(!isset($_GET["CBHT"])){
	$_GET["CBHT"]='';
}
//end: fix  Undefined index

$TIEUDE="Khu vực quản trị website";
include_once("dulieu/header.php");
include_once("dulieu/menu.php");
?>
<?php 
if ( !$_SESSION['user_id'] )
{ 
	echo "Bạn chưa đăng nhập! <a href='login.php'>Nhấp vào đây để đăng nhập</a> hoặc <a href='register.php'>Nhấp vào đây để đăng ký</a>"; 
}
else
{ 
	$user_id = intval($_SESSION['user_id']);
	$sql_query = "SELECT * FROM members WHERE id='{$user_id}'";
	$member1 = $conn->query($sql_query); 
	$member = $member1->fetch_assoc();
	
	if ($member['admin']!="1")  
		echo "<b>{$member['username']}</b>, bạn không có thẩm quyền để truy cập trang này, vui lòng đăng nhập lại với tài khoản admin";
	else
	{
		//Noi dung cac ham, cac lenh va code danh cho admin
	//	echo "Chức năng đang được xây dựng...";



/*
echo '<select>';
$tempholder = array();
$rs = mysql_query("SELECT * FROM members");
$nr = mysql_num_rows($rs);
for ($i=0; $i<$nr; $i++){
    $r = mysql_fetch_array($rs);
    if (!in_array($r['username'], $tempholder)){
        $tempholder[$i] = $r['username'];
        echo "<option>".$r["username"]."</option>";//<option$selected>...
    }
}
unset($tempholder);
echo '</select>';
*/

		$sql_query = "SELECT * FROM caidat WHERE id='1'";
		$caidat1 = $conn->query($sql_query); 
		$caidat = $caidat1->fetch_assoc();

		$thanhcong = '<font color="green"><b>Bạn đã thiết lập thành công</font></b> <a href="admincp.php?CBHT=admincp">Bấm vào đây để quay lại</a>';
		$kothanh = 'Thiết lập thất bại';
		if (isset($_GET['do'])&&$_GET['do']=="sua") 
		{
			//fix  Undefined index		
			$submit = addslashes( $_POST['submiton'] );
			$register = addslashes( $_POST['registeron'] );
			$rank = addslashes( $_POST['viewrank'] );
			$profile = addslashes( $_POST['editprofile'] );
			
			
			$sql="
			UPDATE `caidat` SET
			`submiton` = '".$submit."',
			`registeron` = '".$register."',
			`viewrank` = '".$rank."',
			`editprofile` = '".$profile."' WHERE `id` = 1 ;";
			
			
			if ($sua=$conn->query($sql))
				echo $thanhcong;
			else
				echo $kothanh;
		}
		else{
		//echo $data;
			echo "
			<div class='card'>
            <div class='card-body'>
              <h5 class='card-title'>Cài đặt các quyền</h5>
				<form method='POST' action='admincp.php?do=sua&CBHT=admincp'>
					<table border='0' width='100%' id='table1' cellspacing='0' cellpadding='0' style='border-collapse: collapse' bordercolor='#C0C0C0'>
						<tr>
							<td>Cho phép submit: ( 0 = off ; 1 = on )</td>
							<td><input class='form-control' type='text' value='{$caidat['submiton']}' name='submiton' size='20'></td>
						</tr>
						<tr>
							<td>Cho phép đăng ký: ( 0 = off ; 1 = on )</td>
							<td><input class='form-control' type='text' value='{$caidat['registeron']}' name='registeron' size='20'></td>
						</tr>
						<tr>
							<td>Cho phép xem rank: ( 0 = off ; 1 = on )</td>
							<td><input class='form-control' type='text' value='{$caidat['viewrank']}' name='viewrank' size='20'></td>
						</tr>
						<tr>
							<td>Cho phép chỉnh sửa thông tin: ( 0 = off ; 1 = on )</td>
							<td><input class='form-control' type='text' name='editprofile' value='{$caidat['editprofile']}' size='20'></td>
						</tr>		
					</table><br>
					<button class='btn  btn-primary' type='button' ><li class='bi bi-pencil-square'></li>Sửa </button>
					 <input class='btn  btn-primary' type='reset' value='Khôi phục' name='B2'>
				
				</form>
		        </div></div>";
			}
		}
} 
?>
<div class='card'>
	<div class='card-body'>
		<h5 class='card-title'>Cài đặt các quyền</h5>
	<div class="d-flex">
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<input type="search" name="" id="input" class="form-control" value="" required="required" title="">
		</div>
		<button type="button" class="btn btn-primary mx-3"><i class='bi bi-search'></i> Lọc dữ liệu</button>			
	</div>
	<br>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên tài khoản</th>
				<th>Username</th>
				<th>Password</th>
				<th>Thao tác</th>
				<th>Quyền admin</th>
			</tr>
		</thead>
		<tbody>
</div></div>
		<?php
			$sltv=0; 	
			$result = $conn->query("SELECT * FROM members");
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
					$sltv=$sltv+1;
			     	$tentk[$sltv]=$row["username"];
			     	$tentv[$sltv]=$row["Name"];
			     	$mk[$sltv] = $row["password"];
			     	$id[$sltv] = $row["admin"];
			    }
			}
			for ($i = 1; $i <= $sltv; $i++)
			{
	       		$temp = 'Không';
				echo "<tr><td><b><center>".$i."</center></b></td>";
				//$sql_query1 = @mysql_query("SELECT name FROM members WHERE username='{$tentv[$i]}'");
				echo "<td>".$tentv[$i]."</td><td>".$tentk[$i]."</td>";
				echo "<td>".$mk[$i]."</td>";
				echo "<td><button type='button' class='btn btn-warning' id='edituser'>
						<i class='bi bi-pencil-square'></i><span> Sửa</span></button>
					<button type='button' class='btn btn-danger' id='deluser'>
						<i class='bi bi-trash'></i> Xóa</button></td>";
				if ($id[$i] == 1) {
					$temp = 'Có';
				}
				echo "<td>".$temp."</td></tr>";
			}
		?>
		</tbody>
	</table>
</div></div>
</main>
<?php
include_once("dulieu/footer.php");
?>