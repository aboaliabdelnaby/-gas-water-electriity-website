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
<title>عرض الاخبار</title>
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
      <span><img src="images/point.jpg"> <?php echo $_SESSION['admin'] ;?> <i class="fa fa-user" aria-hidden="true"></i></span>
    <a href="index.php" onclick="w3_close()" class="btn ">لوحة التحكم <i class="fa fa-home" aria-hidden="true"></i></a>
    
    <a href="insert.php" onclick="w3_close()" class="btn "> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn ">تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
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
   <h2>عرض الاخبار</h2>    
 </div>
<?php
    if(isset($_GET['id'])){
         $stmt=$con->prepare("delete from posts  where id=?");
                      $stmt->execute(array($_GET['id']));
    }
    ?>

    <div class="col-md-9 col-sm-12">
    <a href="enpost.php" class="btn btn-primary" style="font-size: 20px;font-weight: bold;margin-bottom:10px;"> اضافة خبر <i class="fa fa-plus" aria-hidden="true"></i></a>
	<div class="table-responsive">
      <table class="table table-responsive" border="1">
          <thead>
            <tr>
                <th scope="col">تعديل او حذف</th>
                <th scope="col">الصورة</th>
                <th scope="col">التاريخ</th>
                <th scope="col">الخدمة</th>
                <th scope="col">المحتوى</th>
                <th scope="col">العنوان</th>
            </tr>
          </thead>
          <tbody>
              <?php

                     $stmt=$con->prepare("select * from posts");
                     $stmt->execute(array());
                     $rows=$stmt->fetchAll();

           //echo date("d");

            foreach($rows as $r){
             ?>
                 <tr>
                  <td><a href="modpost.php?id=<?php echo $r['id'];?>"  class="btn btn-success suc">تعديل الخبر <i class="fa fa-pencil-square-o" ></i></a><a href="shpost.php?id=<?php echo $r['id'];?>"  class="btn btn-danger suc" style="margin:5px;">حذف الخبر<i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                 <td><img width='100px' height="100px" src="<?php echo 'images/posts/'.$r['image']?>"></td>
                 <td><?php echo $r['date'] ?></td>
                 <td><?php if($r['service']=='e'){
                      echo 'كهرباء';
                    }
                    if($r['service']=='g'){
                      echo 'غاز';
                    }
                    if($r['service']=='w'){
                      echo 'مياه';
                    }
                   ?></td>
                 <td><?php echo $r['content'] ?></td>  
                  <td><?php echo $r['subject'] ?></td>

               </tr>
             <?php } ?>
          </tbody>
     </table>
	 </div>
        
   </div>

   <div class="col-md-3 col-sm-4 hide"></div>
  <?php

                    
    
 ?>  
    
    

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<?php
    }
    ob_end_flush();
    ?>
</body>
</html>
