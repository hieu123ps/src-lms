
<main id='main' class='main'>

<div class='pagetitle'>
  <h1>Form Elements</h1>
  <nav>
	<ol class='breadcrumb'>
	  <li class='breadcrumb-item'><a href='index.html'>Home</a></li>
	  <li class='breadcrumb-item'>Forms</li>
	  <li class='breadcrumb-item active'>Elements</li>
	</ol>
  </nav>
</div><!-- End Page Title -->
<?php 
//start: fix  Undefined index
if(!isset($_GET["CBHT"])){
	$_GET["CBHT"]='';
}
//end: fix  Undefined index
$TIEUDE="Sửa đổi thông tin cá nhân";
include_once("dulieu/header.php");
include_once("dulieu/menu.php");

if ( !$_SESSION['user_id'] )
{ 
	echo "Bạn chưa đăng nhập! <a href='login.php'>Nhấp vào đây để đăng nhập</a> hoặc <a href='register.php'>Nhấp vào đây để đăng ký</a>"; 
}
else
{ 
	//check xem co duoc edit hay ko?
	
	$sql_query = "SELECT * FROM caidat WHERE id='1'"; 
	$caidat1 = $conn->query($sql_query); 
	$caidat = $caidat1->fetch_assoc();
	
	$chophepedit = "{$caidat['editprofile']}";
	
	
	$user_id = intval($_SESSION['user_id']);
 
	$sql_query = "SELECT * FROM members WHERE id='{$user_id}'"; 
	$member1 = $conn->query($sql_query); 
	$member = $member1->fetch_assoc();
	
	if ($member['admin'] == "0"){
	if ($chophepedit == 0) 
		{
			//echo "<font color='red'><b>Admin đã tắt chức năng thay đổi thông tin, vui lòng liên hệ admin để được trợ giúp!</b>";
			echo"<div class='alert alert-danger alert-dismissable'>
                            			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                            			<strong>Thông báo:</strong> Admin đã khóa chức năng này, vui lòng liên hệ admin để được trợ giúp!
                        			</div>";
			exit;
		}
	}
	
	//----Noi dung thong bao sau khi sua
	// $thanhcong='Sửa thành công <a href="javascript:history.go(-1)">Quay lại</a>';
	$thanhcong ="<script src='js/myPlugins/AlertJS/Success.js' language='javascript'></script>";
	$kothanh='Sửa không thành công';
	echo "<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Thay đổi thông tin: <b>{$member['username']}</b></h3></div><div class='panel-body'>"; 
		
		
		
	if (isset($_GET['do'])&&$_GET['do']=="sua") {//fix  Undefined index
		$ten = addslashes( $_POST['name'] );
		$pass = md5( addslashes( $_POST['pass'] ) );
		$sn = addslashes( $_POST['sn'] );
		$url = addslashes( $_POST['url'] );
		$email = addslashes( $_POST['email'] );
		$sql="
		UPDATE `members` SET
		`email` = ".$email.",
		`URLS` = ".$url.",
		`Name` = ".$ten.",
		`Birthday` = ".$sn." WHERE `id` =$user_id LIMIT 1 ;";
		
		
		if ($sua=$conn->query($sql)){
			echo $thanhcong;sleep(3);
		}
		
		else
			echo $kothanh;
			
		if (isset($_POST['pass'])&&$_POST['pass']!="") {//fix  Undefined index
			$sqlx="UPDATE `members` SET `password` = '".$pass."' WHERE `id` = '$user_id' LIMIT 1 ;";
			$suapass=$conn->query($sqlx);
			if ($suapass){
				echo "<meta http-equiv='refresh' content='0; index.php'>";
			}
			else
				echo "(Chưa đổi pass) ";
		}
	}
	else
		echo"
		<section class='section profile'>
		<div class='row'>
		  <div class='col-xl-4'>
  
			<div class='card'>
			  <div class='card-body profile-card pt-4 d-flex flex-column align-items-center'>
  
				<img src='assets/img/profile-img.jpg' alt='Profile' class='rounded-circle'>
				<h2>{$member['Name']}</h2>

				<h3>{$member['id']}</h3>
				<div class='social-links mt-2'>
				  <a href='#' class='twitter'><i class='bi bi-twitter'></i></a>
				  <a href='{$member['url']}' class='facebook'><i class='bi bi-facebook'></i></a>
				</div>
			  </div>
			</div>
  
		  </div>
  
		  <div class='col-xl-8'>
  
			<div class='card'>
			  <div class='card-body pt-3'>
				<!-- Bordered Tabs -->
				<ul class='nav nav-tabs nav-tabs-bordered'>
  
				  <li class='nav-item'>
					<button class='nav-link active'data-bs-toggle='tab'data-bs-target='#profile-overview'>Tổng quan</button>
				  </li>
  
				  <li class='nav-item'>
					<button class='nav-link'data-bs-toggle='tab'data-bs-target='#profile-edit'>Chỉnh sửa thông tin</button>
				  </li>
				</ul>
				<div class='tab-content pt-2'>
  
				  <div class='tab-pane fade show active profile-overview' id='profile-overview'>
					<h5 class='card-title'>Giới thiệu bản thân</h5>
					<p class='small fst-italic'>Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>
  
					<h5 class='card-title'>Thông tin cá nhân</h5>
  
					<div class='row'>
					  <div class='col-lg-3 col-md-4 label '>Tên đầy đủ</div>
					  <div class='col-lg-9 col-md-8'>{$member['Name']}</div>
					</div>
					<div class='row'>
					  <div class='col-lg-3 col-md-4 label'>Email</div>
					  <div class='col-lg-9 col-md-8'>{$member['email']}</div>
					</div>
  
				  </div>
  
				  <div class='tab-pane fade profile-edit pt-3' id='profile-edit'>
  
					<!-- Profile Edit Form -->
					<form  method='POST' action='suathongtin.php?do=sua&CBHT=edit'>
					  <div class='row mb-3'>
						<label for='profileImage' class='col-md-4 col-lg-3 col-form-label'>Profile Image</label>
						<div class='col-md-8 col-lg-9'>
						  <img src='assets/img/profile-img.jpg' alt='Profile'>
						  <div class='pt-2'>
							<a href='#' class='btn btn-primary btn-sm' title='Upload new profile image'><i class='bi bi-upload'></i></a>
							<a href='#' class='btn btn-danger btn-sm' title='Remove my profile image'><i class='bi bi-trash'></i></a>
						  </div>
						</div>
					  </div>
  
					  <div class='row mb-3'>
						<label for='fullName' class='col-md-4 col-lg-3 col-form-label'>Tên tài khoản</label>
						<div class='col-md-8 col-lg-9'>
						  <input name='fullName' type='text' class='form-control' id='fullName' value='{$member['Name']}'>
						</div>
					  </div>
					  <div class='row mb-3'>
						<label for='Email' class='col-md-4 col-lg-3 col-form-label'>Email</label>
						<div class='col-md-8 col-lg-9'>
						  <input name='email' type='email' class='form-control' id='Email' value='{$member['email']}'>
						</div>
					  </div>
					  <div class='row mb-3'>
						<label for='Twitter' class='col-md-4 col-lg-3 col-form-label'>Twitter Profile</label>
						<div class='col-md-8 col-lg-9'>
						  <input name='twitter' type='text' class='form-control' id='Twitter' value='https://twitter.com/#'>
						</div>
					  </div>
					  <div class='row mb-3'>
						<label for='Facebook' class='col-md-4 col-lg-3 col-form-label'>Facebook Profile</label>
						<div class='col-md-8 col-lg-9'>
						  <input name='facebook' type='text' class='form-control' id='Facebook' value='https://facebook.com/#'>
						</div>
					  </div>
					<div class='row mb-3'>
					  <label for='currentPassword' class='col-md-4 col-lg-3 col-form-label'>Mật khẩu hiện tại</label>
					  <div class='col-md-8 col-lg-9'>
						<input name='password' type='password' class='form-control' id='currentPassword' value='{$member['password']}'>
					  </div>
					</div>

					<div class='row mb-3'>
					  <label for='newPassword' class='col-md-4 col-lg-3 col-form-label'>Mật khẩu mới</label>
					  <div class='col-md-8 col-lg-9'>
						<input name='newpassword' type='password' class='form-control' id='newPassword'>
					  </div>
					</div>
					<div class='row mb-3'>
					  <label for='renewPassword' class='col-md-4 col-lg-3 col-form-label'>Xác nhận mật khẩu mới</label>
					  <div class='col-md-8 col-lg-9'>
						<input name='renewpassword' type='password' class='form-control' id='renewPassword'>
					  </div>
					</div>
					<div class='text-center'>
					<button type='submit' class='btn btn-primary'>Lưu thay đổi</button>
				  </div>
				  </form>
				  </div>

				</div> <!-- End Bordered Tabs -->
  
			  </div>
			</div>
  
		  </div>
		</div>
	  </section>";
} 
include_once("dulieu/footer.php");
?>
</main><!-- End #main -->
