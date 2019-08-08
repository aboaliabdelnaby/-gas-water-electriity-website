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
	$email=$_POST["email"];
	$name=$_POST["name"];
	$address= $name." عزيزى ";
	$msg = "يسعدنى ابلاغ سيادتكم بقبول طلبكم على التقدم للوظيفة بشركتنا و نرجو ان يكون ث مرة عملنا معا مثمرة";
	$msg = wordwrap($msg,80);
	$headers = "From: abdulazizahmed106622@gmail.com";
    mail($email,$address,$msg,$headers);
	$rows=$db->updateRow("update applicants set status=1 where id=?",array($_POST["id"]));
}
if(!empty($_GET))
{
	$id=$_GET["id"];
	$rows=$db->updateRow("update applicants set status=1 where id=?",array($id));
}
?>
<!DOCTYPE html>
<html lang="en">
<title>عرض المتقدمون للوظائف</title>
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
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:16px">عرض الشكوى التى تم التعامل معها<i class="fa fa-comments" aria-hidden="true"></i></a>
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
   <h2>عرض المتقدمون للوظائف</h2>    
 </div>
<div class="row con">
<div class="col-md-9  col-sm-12">
<div class="table-responsive">
<table class="table" border="1px">
    <thead>
      <tr>
		
        <th>مسلسل</th>
        <th>اسم المتقدم</th>
		<th>البريد الالكترونى</th>
		<th>السيرة الذاتية</th>
		<th>متقدم لوظيفة</th>
        <th>مكان الوظيفة</th>
		<th>الفعل</th>
      </tr>
    </thead>
    <tbody>
	
<?php
		show("SELECT * from applicants where status=0;");
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
<?php
function show($q)
{
		global $db;
		$arr=array("Default","success","danger","info","warning","active");
		$rows=$db->getRows($q,array());
		$i=0;
		if(count($rows)>0)
		{
			$j=1;
		foreach($rows as $row)
		{
		    $job=$db->getRow("select * from jobs where id=?",array($row["job_id"]));
			echo "<form method='post' name='modified' value='aa'><tr class=".$arr[$i]."><td>".$j++ ."</td>";
			echo"<td>".$row["name"]."</td>";
			echo"<td>".$row["email"]."</td>";
			echo"<td><div><a href='".$row["cv"]."' class='btn btn-primary'>download cv</a></div></td>";
			echo"<td>".$job["name"]."</td>";
			echo"<td>".$job["location"]."</td>";
			
			echo"<td><div class='form-group'><button type='submit' style='font-size:18px;font-weight:bold;' class='bs btn btn-success btn-block'>قبول <i class='fa fa-check-circle' aria-hidden='true'></i></button></div>
			<input type='hidden' name='id' value='".$row["id"]."'>
			<input type='hidden' name='email' value='".$row["email"]."'>
			<input type='hidden' name='name' value='".$row["name"]."'>
			</form>
			<div class='form-group'><a href='display_cvs.php?id=".$row["id"]."'><button type='button' style='font-size:16px;font-weight:bold;' class='btn btn-danger btn-block'>
			رفض <i class='fa fa-times' aria-hidden='true'></i></button></a></div></td></tr>";
			//<input type='hidden' name='cid' value='".$row["cid"]."'>
			$i=$i+1;
			if($i>5)
			{
				$i=1;
			}
		}
	    }else
		{
			 echo "<tr class=".$arr[0]."><td colspan='7'>جدول المتقدمون للوظائف فارغ</td><tr>";
		}
}
?>
