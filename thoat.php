<?php
//session_start();
//header('Content-Type: text/html; charset=UTF-8');
if (session_destroy())
	{
	 echo"<script language='JavaScript'>
			swal({
				icon: 'success',
			  	title: 'Đăng xuất,thành công !',
			  	timer: 3000,
			});
		</script>";
	 echo "Đăng xuất thành công!";
	 echo"<meta http-equiv='refresh' content='0; index.php'>";
	}
else
	echo "Không thể thoát dc, có lỗi trong việc hủy session";

echo '<br><a href="index.php">Bấm vào đây để quay lại trang chủ<br></a>';
?>