<?php
ob_start();
session_start();
include"connect.php";
include"functions.php";
require'database.php';
// if the user is already logged in and enter that page then it will be directed to index.php
if(!isset($_SESSION['admin']))
{
    header("location: login.php");
}
if(!empty($_POST))
{
	
	$rows=$db->updateRow("update jobs set description=? where id=?",array($_POST["description"],$_POST["id"]));
}
if(!empty($_GET))
{
	$id=$_GET["id"];
	$rows=$db->deleteRow("delete from jobs where id=?",array($id));
	//header("Refresh:0;url=display_jobs.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<title>تعديل على الاعلان على الوظائف</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/sty.css">
<body>
<!-- Sidebar/menu -->
<div class="navbar">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="#" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
    </div>
    
    
<nav class="w3-sidebar  w3-collapse w3-top w3-large" style="z-index:3;width:250px;font-weight:bold;background-color:RGB(34, 45 , 50);" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px;float:left">اغلاق القائمة</a>
  <div class="element">
    <span > <img src="images/point.jpg"> <?php echo $_SESSION['admin'] ;?> <i class="fa fa-user" aria-hidden="true"></i></span>
  
    <a href="index.php" onclick="w3_close()" class="btn">لوحة التحكم <i class="fa fa-home" aria-hidden="true"></i></a> 
    <a href="insert.php" onclick="w3_close()" class="btn "> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn "> تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
       <a href="admin.php" onclick="w3_close()" class="btn "> المسؤولين <i class="fa fa-user" aria-hidden="true"></i></a>
	   <a href="notification.php" onclick="w3_close()" class="btn"> ارسال الاشعارات <i class="fa fa-comment" aria-hidden="true"></i></a>
	<a href="complaints.php" onclick="w3_close()" class="btn">عرض الشكاوى <i class="fa fa-comments" aria-hidden="true"></i></a>
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:16px">عرض الشكوى التى تم التعامل معها <i class="fa fa-comments" aria-hidden="true"></i></a>
	 <a href="enpost.php" onclick="w3_close()" class="btn">اضافة الخبر <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="shpost.php" onclick="w3_close()" class="btn">عرض الاخبار <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="consumption.php" onclick="w3_close()" class="btn" >اضافة سعر الوات واللتر <i class="fa fa-industry" aria-hidden="true"></i></a>
	<a href="add_jobs.php" onclick="w3_close()" class="btn"> اضافة الوظيفة <i class="fa fa-share-square" aria-hidden="true"></i></a>
	<a href="display_jobs.php" onclick="w3_close()" class="btn" style="font-size:18px">تعديل الوظيفة <i class="fa fa-pencil" aria-hidden="true"></i></a>
	<a href="display_cvs.php" onclick="w3_close()" class="btn ">عرض المتقدمون للوظائف <i class="fa fa-paperclip" aria-hidden="true"></i></a>
	<a href="newsub.php" onclick="w3_close()" class="btn">طلبات الاشتراك بالخدمة <i class="fa fa-envelope-open-o" aria-hidden="true"></i></a>
	
	

     
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="container-fluid w3-top w3-hide-large  w3-xlarge w3-padding" style="background-color: RGB(60, 141 , 188);">
    <a href="logout.php" class="logout">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    <a href="#" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
  <a href="javascript:void(0)" class="w3-button " style="background-color: RGB(60, 141 , 188);" onclick="w3_open()">☰</a>
  
</header> 

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="container-fluid con">
 <div class="row">
   <h2>تعديل على الاعلان على الوظائف</h2>    
 </div>
<div class="row con">
<div class="col-md-9  col-sm-12">
<div class="table-responsive">
<table class="table" border="1px">
    <thead>
      <tr>
		
        <th>مسلسل</th>
        <th>اسم الوظيفة</th>
        <th>مكان الوظيفة</th>
        <th>وطف لمتطلبات الوظيفة</th>
		<th>الفعل</th>
      </tr>
    </thead>
    <tbody>
	
<?php
		$arr=array("Default","success","danger","info","warning","active");
		$rows=$db->getRows("SELECT * from jobs;",array());
		$i=0;
		if(count($rows)>0)
		{
			$j=1;
		foreach($rows as $row)
		{
			echo "<form method='post' name='modified' value='aa'><tr class=".$arr[$i].">
			<td>".$j++ ."</td>";
			echo"<td>".$row["name"]."</td>";
			echo"<td>".$row["location"]."</td>";
			//echo"<td><div class='form-group'><input type='text' value=".$row["location"]." class='form-control' name='location'></div></td>";
			echo"<td><div class='form-group'><textarea class='form-control message' rows='5' name='description'>".$row["description"]."</textarea></div></td>";
			echo"<td><div class='form-group'><button type='submit' style='font-size:18px;font-weight:bold;' class='bs btn btn-success btn-block'> تعديل<i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></div>
			<input type='hidden' name='id' value='".$row["id"]."'></form>
			<div class='form-group'><a href='display_jobs.php?id=".$row["id"]."'><button type='button' style='font-size:16px;font-weight:bold;' class='btn btn-danger btn-block'>
			حذف<i class='fa fa-times' aria-hidden='true'></button></a></div></td></tr>";
			//<input type='hidden' name='cid' value='".$row["cid"]."'>
			$i=$i+1;
			if($i>5)
			{
				$i=1;
			}
		}
	    }
	
	
	?>
	
    </tbody>
  </table> 
</div>
</div>
<div class="col-md-3 hide"></div>
</div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
