<?php
//start: fix  Undefined index
if(!isset($_GET["CBHT"])){
	$_GET["CBHT"]='';
}
//end: fix  Undefined index
$TIEUDE="iSchool Login";
include_once("dulieu/header.php");
include_once("dulieu/menu.php");

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) { die("không thể kết nối: " . $conn->connect_error); }



if (isset($_GET['act']) && $_GET['act'] == "do" )
{
	// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
	$username = addslashes( $_POST['username'] );
	$password = md5( addslashes( $_POST['password'] ) );
	// Lấy thông tin của username đã nhập trong table members
	
	$sql_query = "SELECT id, username, admin, password FROM members WHERE username='{$username}'";
	
	// Nếu username này không tồn tại thì....
	$member1 = $conn->query($sql_query); 
	
	$member = $member1->fetch_assoc();
	
	
	if ( $member1->num_rows <= 0 )
	{
		print "Tên truy nhập không tồn tại. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>"; 
		include_once("dulieu/footer.php");
		exit;
	}
	// Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
	if ( $password != $member['password'] )
	{
		print "Nhập sai mật khẩu. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>"; 
		include_once("dulieu/footer.php");
		exit;
	}
	// Khởi động phiên làm việc (session)
	$_SESSION['user_id'] = $member['id'];
	$_SESSION['user_admin'] = $member['admin'];
	// Thông báo đăng nhập thành công
	echo "<script src='js\myPlugins\AlertJS\Success.js'></script>";
	print "<meta http-equiv='refresh' content='0; index.php'>";
	// print "Bạn đã đăng nhập với tài khoản {$member['username']} thành công. <a href='index.php'>Nhấp vào đây để vào trang chủ</a>";	
}
else
{
// Form đăng nhập
	if (!isset($_SESSION['user_id'] ))//fix  Undefined index
{
print <<<EOF
<main>
<div class="container">
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
	<div class="container">
	  <div class="row justify-content-center">
		<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

		  <div class="d-flex justify-content-center py-4">
			<a href="index.html" class="logo d-flex align-items-center w-auto">
			  <img src="assets/img/favicon.svg" alt="">
			  <span class="d-none d-lg-block">iSchool LMS</span>
			</a>
		  </div><!-- End Logo -->

		  <div class="card mb-3">

			<div class="card-body">

			  <div class="pt-4 pb-2">
				<h5 class="card-title text-center pb-0 fs-4">Đăng nhập hệ thống</h5>
			  </div>

			  <form  action="login.php?act=do" method="post" class="row g-3 needs-validation" novalidate>

				<div class="col-12">
				  <label for="yourUsername" class="form-label">Tài khoản</label>
				  <div class="input-group has-validation">
					<span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-circle"></i></span>
					<input type="text" name="username" class="form-control" id="yourUsername" required>
					<div class="invalid-feedback">Vui lòng nhập tài khoản.</div>
				  </div>
				</div>

				<div class="col-12">
				  <label for="yourPassword" class="form-label">Mật khẩu</label>
				  <div class="input-group has-validation">
				  <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-key"></i></span>
				  <input type="password" name="password" class="form-control" id="yourPassword" required>
				  <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
				  </div>
				</div>

				<div class="col-12">
				  <div class="form-check">
					<input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
					<label class="form-check-label" for="rememberMe">Ghi nhớ tài khoản</label>
				  </div>
				</div>
				<div class="col-12">
				  <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
				</div>
			  </form>

			</div>
		  </div>

		</div>
	  </div>
	</div>

  </section>

</div>
</main><!-- End #main -->

EOF;
}
else
{
	echo "Bạn đã đăng nhập vào tài khoản với tên {$member['username']}";
}
}

include_once("dulieu/footer.php");

?> 

