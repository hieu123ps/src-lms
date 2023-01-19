<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="./?CBHT=index.php">
          <i class="bi bi-house-door"></i>
          <span>Trang chủ</span>
        </a>
      </li>
      <li  class="nav-item">
      <a class="nav-link collapsed" href="./?CBHT=rank">
          <i class="bi bi-bar-chart-line"></i>
          <span>Bảng xếp hạng</span>
        </a>
      </li>
      <li  class="nav-item">
      <a class="nav-link collapsed" href="./?CBHT=contest">
          <i class="bi bi-file-text"></i>
          <span>Kì thi</span>
        </a>
      </li>
      <li class="nav-item">
      <a class="nav-link collapsed" href="./?CBHT=forums">
          <i class="bi bi-newspaper"></i>
          <span>Diễn đàn</span>
        </a>
      </li>
      

<?php 
if (!isset($_SESSION['user_id']) || !$_SESSION['user_id'] )//fix  Undefined index
    {
        echo "<li class ='nav-item'><a class='nav-link  collapsed' href='./login.php?CBHT=logs'>
        <i class='bi bi-grid'></i>
        <span>Đăng nhập</span>
    </a></li> "; 
    }
else
{
	$user_id = intval($_SESSION['user_id']); 
	$sql_query = "SELECT * FROM members WHERE id='{$user_id}'"; 
	$member1 = $conn->query($sql_query); 
	$member = $member1->fetch_assoc();

	echo "
  <li class='nav-item'>
  <a class='nav-link collapsed' href='./suathongtin.php?CBHT=edit'>
      <i class='bi bi-pencil-square'></i>
      <span>Sửa thông tin</span>
    </a>
  </li>
  ";
	
	if ($_SESSION['user_admin'] == 1) 
		{

    echo "
      <li class='nav-item'>
      <a class='nav-link collapsed' href='./add_user.php?CBHT=add_user'>
          <i class='bi bi-person-plus'></i>
          <span>Thêm người dùng</span>
        </a>
      </li>
      ";
      
	    echo "
      <li class='nav-item'>
      <a class='nav-link collapsed' href=' ./admincp.php?CBHT=admincp'>
          <i class='bi bi-wrench-adjustable-circle'></i>
          <span>Quản trị viên</span>
        </a>
      </li>
      ";
		}
	
    echo "
    <li class='nav-item'>
    <a class='nav-link collapsed' href='./submit.php?CBHT=submit'>
    <i class='bi bi-cloud-arrow-up' ></i>
        <span>Nộp bài tập</span>
      </a>
    </li>
    ";

	echo "<center><button class='btn btn-danger md-btn'><i class='bi bi-box-arrow-in-right'></i><a style='color:white;' href='./?CBHT=signs'> Đăng xuất</a></button></center>";
	
}
?>
    </ul>

  </aside>