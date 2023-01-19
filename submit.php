<?php 

//start: fix  Undefined index
if(!isset($_GET["CBHT"])){
	$_GET["CBHT"]='';
}
//end: fix  Undefined index

$TIEUDE = "Nộp bài";
include_once("dulieu/header.php");
include_once("dulieu/menu.php");
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Nộp bài</h1>
  <nav>
	<ol class="breadcrumb">
	  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
	  <li class="breadcrumb-item">Forms</li>
	  <li class="breadcrumb-item active">Elements</li>
	</ol>
  </nav>
</div><!-- End Page Title -->
<?php

if (isset($_SESSION['user_id'] ))
{

	//check xem co duoc sub hay ko?
	$sql_query = "SELECT * FROM caidat WHERE id='1'";
	$caidat1 = $conn->query($sql_query); 
	$caidat = $caidat1->fetch_assoc();
	$chophepsub = "{$caidat['submiton']}";
	
	$user_id = intval($_SESSION['user_id']);
	$sql_query = "SELECT * FROM members WHERE id='{$user_id}'"; 
	$member1 = $conn->query($sql_query); 
	$member = $member1->fetch_assoc();
	
	if ($member['admin'] == "0"){
	if ($chophepsub == 0) 
		{
			//echo "<font color='red'><b>Admin đã tắt chức năng submit, vui lòng liên hệ admin để được trợ giúp!</b>";
			echo"<div class='alert alert-danger alert-dismissable'>
                            			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                            			<strong>Thông báo:</strong> Admin đã khóa chức năng này, vui lòng liên hệ admin để được trợ giúp!
                        			</div>";
			exit;
		}
	}



	if (isset($_GET['act']) && $_GET['act'] == "do" )	//fix  Undefined index
{

$tenfile = basename($_FILES["fileToUpload"]["name"]);

$tenfile= str_replace('.','].',$tenfile);

$namefile = "[{$member['username']}][" . $tenfile;

$target_dir = "nopbai/";

$target_file = $target_dir . $namefile;

$uploadOk = 1;

$ngonngubailam = strtoupper(pathinfo($target_file,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<b class='text-danger'>File của bạn có kích cỡ quá lớn.</b><br>";
    $uploadOk = 0;
}

if($ngonngubailam != "PAS" && $ngonngubailam != "PP" && $ngonngubailam != "CPP"
&& $ngonngubailam != "JAVA" && $ngonngubailam != "C" && $ngonngubailam != "PY") {
   // echo "<p class='text-warning'>Hệ thống chỉ cho phép nộp các file *.pas, *.pp, *.cpp, *.java, *.c, *py</p>";
print<<<EOF
<br>
<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="fa fa-info-circle"></i>  Hệ thống chỉ cho phép nộp các file *.pas, *.pp, *.cpp, *.java, *.c, *py
                        </div>
EOF;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "<b class='text-danger'>Nộp bài không thành công</b><br>";
print<<<EOF
<br>
<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Thông báo:</strong> Nộp bài không thành công
                        </div>
EOF;
print <<<EOF
<br>
<form action="submit.php" method="post" enctype="multipart/form-data">
<input  class='btn btn-primary' type="submit" value="Quay trở lại" name="submit">
</form>

EOF;
exit();
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     echo "<font color=green><b>Tài khoản {$member['username']} đã nộp bài ". basename( $_FILES["fileToUpload"]["name"]). " thành công.</b></font><br>";

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('Bạn đã nộp bài thành công');</script>";
		print "<meta http-equiv='refresh' content='0; /?CBHT=rank'>";
    } else {
        echo "<font color=red><b>Xin lỗi, có lỗi phát sinh trong quá trình tải.</b></font><br>";
    }
}
}
else
{

print <<<EOF
<h4>Lưu ý khi nộp bài:</h4>
<ul>
<li>Hệ thống chỉ nhận file có dung lượng dưới 500MB</li>
<li>File code chấp nhận có đuôi *.cpp, *.pas, *.java, *.c, *.pp</li>
</ul>

<form action="submit.php?act=do" method="post" enctype="multipart/form-data">

<h4>Chọn bài làm:</h4>

<input class='form-control' type="file" name="fileToUpload" id="fileToUpload"><br>

<input  class='btn btn-primary' type="submit" value="Nộp bài" name="submit">

</form>

</div></div>
EOF;

}			
}else{
	Echo "Bạn chưa đăng nhập, vui lòng đăng nhập để tiếp tục";
}
?>

<div class='panel panel-primary'>
<div class='panel-heading'><h3 class='panel-title'>Hiển thị bài làm</h3></div>
<div class='panel-body' >
<textarea class='form-control' id='content'> </textarea>
</div>

</div>

<?php
	include_once("dulieu/footer.php");
?>