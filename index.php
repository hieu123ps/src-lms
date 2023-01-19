<?php
//start: fix  Undefined index
if(!isset($_GET["CBHT"])){
	$_GET["CBHT"]='';
}
//end: fix  Undefined index
switch($_GET["CBHT"])
{
	default:
	{
	$TIEUDE="iSchool LMS";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("dulieu/home.php");
	include_once("dulieu/footer.php");
	break;
	}	
	case "contest":
	{
	$TIEUDE="KÌ THI ĐANG DIỄN RA";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("contest.php");
	include_once("dulieu/footer.php");
	break;
	}
	case "rank":
	{
	$TIEUDE="BẢNG XẾP HẠNG";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("rank.php");
	include_once("dulieu/footer.php");
	break;
	}
	case "admin":
	{
	$TIEUDE="TRANG QUẢN LÍ";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("admin.php");
	include_once("dulieu/footer.php");
	break;
	}
	case "signs":
	{
	$TIEUDE="ĐĂNG XUẤT";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("thoat.php");
	include_once("dulieu/footer.php");
	break;
	}
	case "submit":
	{
	$TIEUDE="KHU VỰC NỘP BÀI";
	include_once("nop.php");
	break;
	}
	case "logs":
	{
	//$TIEUDE="File logs";
	include_once("login.php");
	break;
	}
	case "forums":
	{
	$TIEUDE = "DIỄN ĐÀN THẢO LUẬN";
	include_once("dulieu/header.php");
	include_once("dulieu/menu.php");
	include_once("forum.php");
	include_once("dulieu/footer.php");
	break;
	}
}

				?>