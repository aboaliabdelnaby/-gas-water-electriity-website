<?php
ob_start();
session_start();
include"connect.php";
include "functions.php";
require 'database.php';
// if the user is already logged in and enter that page then it will be directed to index.php
if(!isset($_SESSION['admin']))
{
    header("location: login.php");
}
if(!empty($_POST))
{
	$name=$_POST["name"];
	$des=$_POST["description"];
	$loc=$_POST["location"];
	$num_r=$db->insertRow("insert into jobs (location,name,description,date) values(?,?,?,now())",array($loc,$name,$des));
	show(0);
}
else
{
	show(1);
}
function show($mess){
?>
<!DOCTYPE html>
<html lang="en">
<title>اعلان عن وظائف</title>
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
    <a href="complaints.php" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
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
	<a href="complaints.php" onclick="w3_close()" class="btn">عرض الشكاوى<i class="fa fa-comments" aria-hidden="true"></i></a>
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
    <a href="complaints.php" class="notif"><?php echo compl()?><i class="fa fa-bell" aria-hidden="true"></i></a>
  <a href="javascript:void(0)" class="w3-button " style="background-color: RGB(60, 141 , 188);" onclick="w3_open()">☰</a>
  
</header> 

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<!-- !PAGE CONTENT! -->
<div class="container-fluid con">
 <div class="row">
   <h2>اعلان عن وظائف</h2>    
 </div>
 <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
 <?php
	global $db;
 ?>
<div class="form-group">
				<div class='col-md-7  col-sm-9'>
                    <input class="form-control" id="inp1" name="name" type="text" placeholder="اسم الوظيفة" required oninvalid="this.setCustomValidity('نرجو ادخال اسم الوظيفة المقدمة')" oninput="setCustomValidity('')">   
			    </div>
	<label class='control-label col-md-2 col-sm-3' for='inp1'> الوظيفة :</label><div class='col-md-3 col-sm-4 hide'></div>
</div>
<br><br>
<div class="form-group">
				<div class='col-md-7  col-sm-9'>
                    <input class="form-control" id="inp1" name="location" type="text" placeholder=" اسم الشركة او القطاع" required oninvalid="this.setCustomValidity('نرجو ادخال اسم الشركة المقدمة للوظيفة')" oninput="setCustomValidity('')">   
			    </div>
	<label class='control-label col-md-2 col-sm-3' for='inp1'> مكان الوظيفة :</label><div class='col-md-3 col-sm-4 hide'></div>
</div>
<!--<div class="form-group">
  <div class="col-md-7  col-sm-9">
	<select class='form-control area' name='type' id='sel4'>
	<option  value='0' selected></option>
	<option  value='1'>اشعار لاعلام جميع المستخدمين بضرورة الدفع</option></select>
  </div>
		<label class="control-label col-md-2 col-sm-3" for="sel4">:</label>
    <div class="col-md-3 col-sm-4 hide"></div>
</div>-->

   <div class="form-group">
		<div class="col-md-7  col-sm-9">
			<textarea class="form-control message" required rows="5" name="description" id="comment" oninvalid="this.setCustomValidity(' ارجو ادخال وصف للوظيفة وعدد الموظفين المطلوبون و مكان الوظيفة')" oninput="setCustomValidity('')"></textarea>
		</div>
			<label class="control-label col-md-2 col-sm-3" for="comment">وصف لمتطلبات الوظيفة :</label>
		<div class="col-md-3 col-sm-4 hide"></div>
    </div>
	
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <button type='submit' name="submit" class='btn btn-primary btn-block' style="font-size: 22px;">عرض اعلان الوظيفة</button>
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
 </form>
 <?php
 if($mess){}else
 {
?>
 <div> 
	<div class='col-md-7  col-sm-9'>
		<div class='alert alert-success' style='font-weight:bolder;font-size:20px;'><?php echo "تم الاعلان عن الوظيفة بنجاح";?></div>
	</div>
	<div class='control-label col-md-2 col-sm-3'> </div>
	<div class='col-md-3 col-sm-4 hide'></div>
</div>
 <?php
 }
 ?>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php 
}
?>
