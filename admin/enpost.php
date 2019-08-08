
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
<title>ادخال الخبر</title>
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
     
    <a href="insert.php" onclick="w3_close()" class="btn"> ادخال الفاتورة <i class="fa fa-plus-square" aria-hidden="true"></i></a>
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
   <h2>ادخال الخبر</h2>    
 </div>
    
     <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
         $picture=$_FILES["image"];
            $pictName=$picture["name"];
            $pictSize=$picture["size"];
            $pictTmp=$picture["tmp_name"];
            $pictType=$picture["type"];
            $pictExtension=array("jpeg","jpg","png","gif");
            $res=explode('.', $pictName);
            $ext = strtolower($res[1]);
        
        $err=array();
        if(empty($_POST['subject'])){
            $err[]='ادخل العنوان';
        }
         if(empty($_POST['content'])){
            $err[]='ادخل المحتوى';
        }
        if(!isset($_POST['service'])){
            $err[]='اختار نوع الخدمة';
        }
        if(!empty($pictName)&&!in_array($ext,$pictExtension)){
             $err[]="امتداد الصورة غير مسموح";
        }
        if(empty($pictName)){
            $err[]="الرجاء تحميل الصورة";
        }
        if($pictSize>4194304){
            $err[]=" 4MB الصورة لا يمكن أن تكون أكبر من";
        }
        if(empty($err)){
           $pict=rand(0,100000)."_".$pictName;
                move_uploaded_file($pictTmp,"images\posts\\".$pict);
            $stmt=$con->prepare("insert into posts(subject,content,service,image,date,admin_id)values(?,?,?,?,now(),?)");
            $stmt->execute(array($_POST['subject'],$_POST['content'],$_POST['service'],$pict,$_SESSION['id']));
               if($stmt){
                      ?>
                 <div class="col-md-7  col-sm-9">
                <?php echo"<div class='alert alert-success'> تم الاضافة بنجاح</div>";?>
              </div>
               <div class="control-label col-md-2 col-sm-3"> </div>
                <div class="col-md-3 col-sm-4 hide"></div> <?php

                     header("refresh:3;url=shpost.php");
                        die();

              }  
			
		}
        if(!empty($err)){
            foreach($err as $r){?>
             <div class="col-md-7  col-sm-9">
             <?php echo"<div class='alert alert-danger'>$r</div>";?>
           </div>
             <div class="control-label col-md-2 col-sm-3"> </div>
            <div class="col-md-3 col-sm-4 hide"></div> <?php
                 //header("refresh:3;url=insert.php");
                           // die();
            }
            
        }
    }else{
 ?>  
    
    <form class="form-horizontal" method="post" action="<?php echo $_SERVER["PHP_SELF"]?>"  enctype="multipart/form-data">
   <div class="form-group">
    <div class="col-md-7  col-sm-9">
        <input type="text" class="form-control" id="sub" name="subject" placeholder="ادخل العنوان" required oninvalid="this.setCustomValidity('الرجاء ادخال العنوان')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="sub"> : العنوان</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
   <div class="form-group">
    <div class="col-md-7  col-sm-9">
        <textarea class="form-control" id="cont" name="content" placeholder="ادخل المحتوي"
        required oninvalid="this.setCustomValidity('الرجاء ادخال المحتوى')" oninput="setCustomValidity('')"></textarea>
    </div>
    <label class="control-label col-md-2 col-sm-3" for="sub"> : المحتوى</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>

    <div class="form-group">
    <div class="col-md-7  col-sm-9">
       <input type="file" class="form-control" id="image" name="image"  required oninvalid="this.setCustomValidity('الرجاء ادخال الصورة')" oninput="setCustomValidity('')">
    </div>
    <label class="control-label col-md-2 col-sm-3" for="image"> : الصورة</label>
    <div class="col-md-3 col-sm-4 hide"></div>
  </div>
  <div class="form-group">
    <div class="col-md-7  col-sm-9">
         <select class="form-control" id="ser" name='service' style="font-size: 22px;height: 45px; " required>
             <option  value=' ' hidden selected  disabled> الخدمة</option>
            <option  value='e'>كهرباء</option>
            <option  value='g'>غاز</option>
            <option  value='w'>مياه</option>
         </select>
    </div>
    <label class="control-label col-md-2 col-sm-3" for="month"> : الخدمة</label>
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
        }
        }
    ob_end_flush();
    ?>
    

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<script>
 $(".govern").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".center").val(-1);
            $(".center").attr("disabled","disabled");
            
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }
        else
        {
            $(".center").removeAttr("disabled");
            $(".center").val(-1);
            $(".district").val(-1);
            $(".center optgroup").css("display","none");
            $(".center optgroup[label = " + $(this).val() + "]").css("display","block");
        }
    });
    
    $(".center").on("change", function(){
        
        if($(this).val() == -1)
        {
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }
        else /*if($(this).val() == $(".govern").val())*/
        {
            $(".district").removeAttr("disabled");
            $(".district").val(-1);
            $(".district optgroup").css("display","none");
            $(".district optgroup[label = " + $(this).val() + "]").css("display","block");
        }
        /*else
        {
            $(".district").val(-1);
            $(".district").attr("disabled","disabled");
        }*/
    });

</script>
</body>
</html>
