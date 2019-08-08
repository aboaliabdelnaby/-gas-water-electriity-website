<!DOCTYPE html>
<html lang="en">
<?php
    include"connect.php";
    include"functions.php";
       ob_start();
    session_start();
    if(!isset($_SESSION['admin']))
    {
        header("location: login.php");
    }
    else{
        
    
?>
<title>لوحة التحكم</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
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
  
    <a href="index.php" onclick="w3_close()" class="btn active">لوحة التحكم <i class="fa fa-home" aria-hidden="true"></i></a> 
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
<div class="container-fluid">
 <div class="row">
   <h2>لوحة التحكم</h2>    
 </div>
 <div class="row">
     <div class="col-md-3  col-sm-4">
          <a href="user.php"><div class="user">
             <p class="font"><i class="fa fa-users" aria-hidden="true"></i></p>
             <p class="cont"><span>
                 <?php
                   try {
                    $stmt=$con->prepare("select count(*) from users");
                    $stmt->execute();
                    $row=$stmt->fetch();
                    echo $row[0];
                    
                   }
                   catch(PDOException $e)
                   {
                        echo "Error: " . $e->getMessage();
                   }
                 ?>
                 </span><br>مستخدمين</p>
              </div></a>
     </div>
     <div class="col-md-3 col-sm-4">
          <a href="complaints.php"><div class="compl">
             <p class="font"><i class="fa fa-comments" aria-hidden="true"></i></p>
             <p class="cont"><span>
                  <?php echo compl()?>
                 </span><br>شكاوي</p>
              </div></a>
     </div>
     <div class="col-md-3 col-sm-4">
     <a href="invoice.php"><div class="inv">
             <p class="font"><i class="fa fa-pencil-square" aria-hidden="true"></i></p>
             <p class="cont"><span>
                 <?php
                   try {
                    $stmt=$con->prepare("select count(*) from invoice where paid=0");
                    $stmt->execute();
                    $row=$stmt->fetch();
                    echo $row[0];
                    
                   }
                   catch(PDOException $e)
                   {
                        echo "Error: " . $e->getMessage();
                   }
                 ?>
                 </span><br>فواتير</p>
         </div></a>
     </div>
     <div class="col-md-3 col-sm-4 hide"></div>
 </div>
<div class="row">
    <div class="col-md-3 col-sm-4 gr">
    <div id="chart-container" style="margin-top:50px;">
        <canvas id="graphCanvas1"></canvas>
    </div>
    
    <p style="font-size:20px;font-weight:bold;text-align:center;color:RGB(0, 192 , 239)">الكهرباء</p>
</div>

<div class="col-md-3 col-sm-4 gr">
    <div id="chart-container" style="margin-top:50px;">
        <canvas id="graphCanvas2"></canvas>
    </div>
    
    <p style="font-size:20px;font-weight:bold;text-align:center;color:RGB(0, 166 , 90)">المياه</p>
    
</div>
    
<div class="col-md-3 col-sm-4 gr">
    <div id="chart-container" style="margin-top:50px;">
        <canvas id="graphCanvas3"></canvas>
    </div>
    
    <p style="font-size:20px;font-weight:bold;text-align:center;color:RGB(243, 156 , 18)">الغاز</p>
    
</div>
<div class="col-md-3 col-sm-4 hide"></div>
</div>
    <div class="row">
        <div class="col-md-3 col-sm-4 pie">
          <div class="chart-container">
            <div class="pie-chart-container" style="margin-top:50px;">
              <canvas id="pie-chartcanvas-1"></canvas>
            </div>
            </div>
        </div>
         <div class="col-md-3 col-sm-4 pie">
          <div class="chart-container">
            <div class="pie-chart-container" style="margin-top:50px;">
              <canvas id="pie-chartcanvas-2"></canvas>
            </div>
            </div>
        </div>
         <div class="col-md-3 col-sm-4 pie">
          <div class="chart-container">
            <div class="pie-chart-container" style="margin-top:50px;margin-bottom:50px">
              <canvas id="pie-chartcanvas-3"></canvas>
            </div>
            </div>
        </div>
       <div class="col-md-3 col-sm-4 hide"></div> 
    </div>


</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/script.js"></script>
<script src="js/graphs.js"></script>
<script src="js/pie.js"></script>


<?php
    }
    ob_end_flush();
    ?>
</body>
</html>
