<!DOCTYPE html>
<html lang="en">
    <?php
    include"connect.php";
    include"functions.php";
	require'database.php';
      ob_start();
    session_start();
    if(!isset($_SESSION['admin']))
    {
        header("location: login.php");
    }
    else{
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
?>
<title>ادخال الفاتورة</title>
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
     
    <a href="insert.php" onclick="w3_close()" class="btn active"> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
    <a href="edit.php" onclick="w3_close()" class="btn ">تعديل الفاتورة <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
  <a href="admin.php" onclick="w3_close()" class="btn "> المسؤولين <i class="fa fa-user" aria-hidden="true"></i></a>
  <a href="notification.php" onclick="w3_close()" class="btn"> ارسال الاشعارات <i class="fa fa-comment" aria-hidden="true"></i></a>
	<a href="complaints.php" onclick="w3_close()" class="btn">عرض الشكاوى<i class="fa fa-comments" aria-hidden="true"></i></a>
	<a href="hangcomplaints.php" onclick="w3_close()" class="btn" style="font-size:17px">عرض الشكوى التى تم التعامل معها<i class="fa fa-comments" aria-hidden="true"></i></a>
 <a href="enpost.php" onclick="w3_close()" class="btn">اضافة الخبر <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="shpost.php" onclick="w3_close()" class="btn">عرض الاخبار <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
 <a href="consumption.php" onclick="w3_close()" class="btn" >اضافة سعر الوات واللتر <i class="fa fa-industry" aria-hidden="true"></i></a>
	<a href="add_jobs.php" onclick="w3_close()" class="btn"> اضافة الوظيفة <i class="fa fa-share-square" aria-hidden="true"></i></a>
	<a href="display_jobs.php" onclick="w3_close()" class="btn" style="font-size:18px">تعديل الوظيفة <i class="fa fa-pencil" aria-hidden="true"></i></a>
	<a href="display_cvs.php" onclick="w3_close()" class="btn ">عرض المتقدمون للوظائف <i class="fa fa-paperclip" aria-hidden="true"></i></a>
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
   <h2>ادخال الفاتورة</h2>    
 </div>
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
      <input type="text" class="form-control" id="read" name="read" placeholder="قراءة العداد">
        <input type="hidden" class="form-control"  name="id"  value="<?php echo $id;?>">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="read"> : قراءة العداد</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group"> 
    <div class="col-md-7  col-sm-9">
      <input type="submit" class="btn btn-primary btn-block" name="submit" value="ادخال">
    </div>
      <div class="control-label col-md-2 col-sm-3"> </div>
      <div class="col-md-3 col-sm-4 hide"></div>
  </div>
</form>
 <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $err=array();
        if(empty($_POST['read'])){
            $err[]='حقل قراءة العداد فارغ';
        }
        if(!filter_var($_POST['read'], FILTER_VALIDATE_INT)){
            $err[]=' اادخل القراءة صحيحة ,القراءة ارقام فقط';
        }
         
        
        if(empty($err)){
            $val=intval($_POST['read']);
          if($_SESSION['service']=='e'){
			  $row=$db->getRow("SELECT * from consumption where type='e' and $val>=minn and $val<=maxx;",array());
                if($val>=0&&$val<=50)
				{
                    $cost=($val*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
                if($val>=50&&$val<=100){
					$ro=$db->getRow("SELECT * from consumption where id=?;",array($row["id"]-1));
                    $cost=($ro['maxx']*$ro['cost']+($val-$ro['maxx'])*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
                if($val>=100&&$val<=200){
                    $cost=($val*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
                if($val>=200&&$val<=350){
					$ro=$db->getRow("SELECT * from consumption where id=?;",array($row["id"]-1));
                    $cost=($ro['maxx']*$ro['cost']+($val-$ro['maxx'])*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
                if($val>=350&&$val<=650){
					$roo=$db->getRow("SELECT * from consumption where id=?;",array($row["id"]-1));
					$ro=$db->getRow("SELECT * from consumption where id=?;",array($roo["id"]-1));
                    $cost=($ro['maxx']*$ro['cost']+150*$roo['cost']+($val-($ro['maxx']+150)*$row["cost"]))+$row["additional_val"];
					//echo $cost;
                }
                if($val>650&&$val<=1000){
					$rooo=$db->getRow("SELECT * from consumption where id=?;",array($row["id"]-1));
					$roo=$db->getRow("SELECT * from consumption where id=?;",array($rooo["id"]-1));
					$ro=$db->getRow("SELECT * from consumption where id=?;",array($roo["id"]-1));
                    $cost=($ro['maxx']*$ro['cost']+150*$roo['cost']+300*$rooo['cost']+($val-($ro['maxx']+150+300))*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
                if($val>1000){
                    $cost=($val*$row["cost"])+$row["additional_val"];
					//echo $cost;
                }
          }
          if($_SESSION['service']=='w'){
			  $row=$db->getRow("SELECT * from consumption where type='w' and $val>=minn and $val<=maxx;",array());
			  $cost=$row["cost"]*$val;
			  //echo $cost;
              // if($val>=0&&$val<=10){
                  // $cost=0.65*$val;
              // }
              // if($val>=11&&$val<=20){
                  // $cost=1.60*$val;
              // }
              // if($val>=21&&$val<=30){
                  // $cost=2.25*$val;
              // }
              // if($val>=31&&$val<=40){
                  // $cost=2.75*$val;
              // }
              // if($val>=41){
                  // $cost=3.15*$val;
              // }
          }
            if($_SESSION['service']=='g'){
			  $row=$db->getRow("SELECT * from consumption where type='g' and $val>=minn and $val<=maxx;",array());
			  $cost=$row["cost"]*$val;
              // if($val>=0&&$val<=30){
                  // $cost=1.75*$val;
              // }
              // if($val>=31&&$val<=60){
                  // $cost=2.50*$val;
              // }
              // if($val>=61){
                  // $cost=3*$val;
              // }
          }
		  //$stmt=$db->insertRow("insert into invoice(Month,Date,U_id,service,meter_reading,invoice_admin,cost,Paid)values(?,now(),?,?,?,?,?,0)",array($_SESSION['month'],$_POST['id'],$_SESSION['service'],$_POST['read'],$_SESSION['id'],$cost));
           $stmtt=$con->prepare("insert into invoice(Month,Date,U_id,service,meter_reading,invoice_admin,cost,Paid)values(?,now(),?,?,?,?,?,0)");
           $stmtt->execute(array($_SESSION['month'],$_POST['id'],$_SESSION['service'],$_POST['read'],$_SESSION['id'],$cost));
			//echo $stmtt;
            if($stmtt)
			{
        ?>
            <div class="col-md-7  col-sm-9">
            <?php echo"<div class='alert alert-success'> تم الادخال بنجاح</div>";?>
            </div>
            <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div>
	        <?php
             header("refresh:3;url=insert.php");
              die();             
            }
            
            
        }if(!empty($err)){
            foreach($err as $r){?>
             <div class="col-md-7  col-sm-9">
             <?php echo"<div class='alert alert-danger'>$r</div>";?>
           </div>
             <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div> <?php
            }
            
        }
    }
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
