<?php
ob_start();
session_start();
error_reporting( error_reporting() & ~E_NOTICE );
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
	if($_POST["modified"]=="aa")
	{
		$uid=$_POST["uid"];
		$ser=$_POST["service"];
		$sid=$_POST['sid'];
		
		if($ser=='الكهرباء')
		{
			$rows=$db->updateRow("update users set Electricity=1 where ID=?",array($uid));
		}elseif($ser=='المياة')
		{
			$rows=$db->updateRow("update users set Water=1 where ID=?",array($uid));
		}elseif($ser=="الغاز")
		{
			$rows=$db->updateRow("update users set Gas=1 where ID=?",array($uid));
		}
		
		$rows=$db->updateRow("update sub set status=1 where s_id=?",array($sid));
	}
	elseif($_POST["delete"]=="ddd")
	{
		$id=$_POST["sid"];
		$rows=$db->deleteRow("delete from sub where s_id=?",array($id));
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<title>طلبات الاشتراك بالخدمة</title>
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
	<a href="complaints.php" onclick="w3_close()" class="btn">عرض الشكاوى<i class="fa fa-comments" aria-hidden="true"></i></a>
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:16px">عرض الشكوى التى تم التعامل معها<i class="fa fa-comments" aria-hidden="true"></i></a>
 <a href="enpost.php" onclick="w3_close()" class="btn">اضافة الخبر <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="shpost.php" onclick="w3_close()" class="btn">عرض الاخبار <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="consumption.php" onclick="w3_close()" class="btn" >اضافة سعر الوات واللتر <i class="fa fa-industry" aria-hidden="true"></i></a>
	<a href="add_jobs.php" onclick="w3_close()" class="btn"> اضافة الوظيفة <i class="fa fa-share-square" aria-hidden="true"></i></a>
	<a href="display_jobs.php" onclick="w3_close()" class="btn" style="font-size:18px">تعديل الوظيفة <i class="fa fa-pencil" aria-hidden="true"></i></a>
	<a href="display_cvs.php" onclick="w3_close()" class="btn ">عرض المتقدمون للوظائف <i class="fa fa-paperclip" aria-hidden="true"></i></a>
	<a href="newsub.php" onclick="w3_close()" class="btn active">طلبات الاشتراك بالخدمة <i class="fa fa-envelope-open-o" aria-hidden="true"></i></a>
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
   <h2>طلبات الاشتراك بالخدمة</h2>    
 </div>
<div class="row con">
<div class="col-md-9  col-sm-12">
<?php
$row=$db->getRow("SELECT count(*) from sub where status=0 and service='الكهرباء'",array());
$rows=$db->getRow("SELECT count(*) from sub where status=0 and service='المياة'",array());
$rowss=$db->getRow("SELECT count(*) from sub where status=0 and service='الغاز'",array());
$count1=$row[0];
$count2=$rows[0];
$count3=$rowss[0];
?>
<a href="newsub.php?id=1"> <button type="button" class="bttn btn btn-primary" style='width:auto;font-size:20px;margin-bottom:8px;'>خدمة الكهرباء <span class="badge"><?php echo $count1;?></span></button></a>
<a href="newsub.php?id=2" style="margin-right:30px;"><button type="button" class="bttn btn btn-primary" style='width:auto;font-size:20px;margin-bottom:8px;'>خدمة المياه <span class="badge"><?php echo $count2;?></span></button></a>
<a href="newsub.php?id=3" style="margin-right:30px;"><button type="button" class="bttn btn btn-primary" style='width:auto;font-size:20px;margin-bottom:8px;'>خدمة الغاز <span class="badge"><?php echo $count3;?></span></button></a>
<div class="table-responsive">
<table class="table" border="1px">
    <thead>
      <tr>
        <th>رقم الطلب</th>
        <th>اسم المستخدم</th>
		<th>رقم الهاتف</th>
        <th>عنوان المستخدم</th>
        <th>نوع الخدمة</th>
		<th>حالة الطلب</th>
		<th>الفعل</th>
      </tr>
    </thead>
    <tbody>
<?php
if(!empty($_GET))
{
	$id=$_GET["id"];
	if($id==1)
	{
		show("SELECT * from sub where status=0 and service='الكهرباء';",1);
	}elseif($id==2)
	{
		show("SELECT * from sub where status=0 and service='المياة';",2);
	}elseif($id==3)
	{
		show("SELECT * from sub where status=0 and service='الغاز';",3);
	}else
	{
		show("SELECT * from complaints where status=0;",0);
	}
}else
{
	show("SELECT * from sub where status=0;",0);
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
<?php
function show($q,$id){
   global $db;
   $arr=array("Default","success","danger","info","warning","active");
   $rows=$db->getRows($q,array());
   $i=0;
   if($id)
   {
	   $url="newsub.php?id=$id";
   }else
   {
	   $url="newsub.php";
   }
	if(count($rows)>0)
	{
		foreach($rows as $row)
		{
			$n=$db->getRow("SELECT * from users where ID=?",array($row["u_id"]));
			if($row["service"]=="المياة")
			{
				$dis='المياه';
			}else
			{
				$dis=$row["service"];
			}
			
			echo "<form method='post' action='".$url."' name='modified' value='aa'><tr class=".$arr[$i]."><td>".$row["s_id"] ."</td>";
			echo"<td>".$n["FullName"]."</td>";
			echo"<td>".$n["Phone"]."</td>";
			echo"<td>".$n["address"]."</td>";
			echo"<td>".$dis."</td>";
			echo"<td>لم يتم قبول الطلب</td>";
			echo"<td><div class='form-group'><button type='submit' style='font-size:18px;font-weight:bold;' name='modified' value='aa' class='bs btn btn-success btn-block'>قبول طلب الاشتراك <i class='fa fa-check-square-o' aria-hidden='true'></i></button></div>
			<input type='hidden' name='sid' value='".$row["s_id"]."'>
			<input type='hidden' name='service' value='".$row["service"]."'>
			<input type='hidden' name='uid' value='".$row["u_id"]."'>
			</form>
			<form method='post' action='".$url."' >
			<div class='form-group'><button type='submit' style='font-size:18px;font-weight:bold;' name='delete' value='ddd' class='bs btn btn-danger btn-block'>حذف الطلب <i class='fa fa-trash' aria-hidden='true'></i></i></button></div>
			<input type='hidden' name='sid' value='".$row["s_id"]."'></form></td>";
			$i=$i+1;
			if($i>5)
			{
				$i=1;
			}
		}
	}else
	{
		echo "<tr class=".$arr[0]."><td colspan='7'>لم نتلقى اى طلبات جديدة</td><tr>";
	}
}
?>
