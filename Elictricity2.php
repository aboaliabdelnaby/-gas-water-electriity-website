<?php
	ob_start();
	session_start();
	include 'init.php';
	if(isset($_SESSION['username']))
    {
    	$uname=$_SESSION['username'];
    	$id=$_SESSION['userid'] ;
    	$service="الكهرباء";

    	if($_SERVER['REQUEST_METHOD'] == 'POST')
	    {
	    	$msg = array();
	    	$row1 = $db->getRow("select * from sub where u_id = ? and service= ?", array($id,$service));
	    	if(!empty($row1))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'> أنت مشترك بالفعل من قبل</div>";
        }
        else{
	    	    $row = $db->getRow("select * from users where UserName = ?", array($uname));

	    	   $id1=$row['ID'];
	    	   $db->insertRow("insert into sub(u_id,service) values(?, ?)", array($id1,$service));

               $success = "<div class='alert alert-success' dir='rtl'>تم الاشتراك بنجاح</div>";
            }  
	    }

    }
     else
    {
    	header("location: index.php");
    }

 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>إشتراك الكهراء</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css22/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts22/font-awesome-5/css/fontawesome-all.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css22/style.css"/>
       <!-- BootStrap Links-->
     <link rel="stylesheet" type="text/css" href="css1/bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="css1/fontawesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	  <link rel="stylesheet" type="text/css" href="css1/main.css">
	    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>



<body class="form-v5">
<nav class="navbar navbar-expand-sm bg-dark fixed-top" style="   position: absolute; height: 75px; margin-bottom: -24px;">
	<a class="navbar-brand" style="font-size: 40px; color: blue;margin-right: 200px;
margin-bottom: 30px;" href="index.php">الرئيسيه</a>
	<a class="navbar-brand" style="font-size: 40px; color: white;padding-left: 250px;
    padding-right: 300px;" href="#">الكهرباء</a>

  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="logout.php" class="logout" style="font-size: 26px; margin-left: 150px;color: #007bff;  ">تسجيل خروج <i class="fa fa-sign-out" aria-hidden="true"></i></a>
    </li>
    
  </ul>
</nav>
<br><br><br>
	<div class="page-content">
		<div class="form-v5-content">
			<form class="form-detail" action="#" method="post">
				<?php 
				if(isset($msg)) 
                    {
                        foreach($msg as $m)
                        {
                            echo $m;
                        }
                        header("refresh:2; url=index.php");
                    }
				if(isset($success))
                {
                    echo $success;
                    header("refresh:2; url=index.php");
                } ?>


				<h2>إشتراك الكهرباء</h2>
				<div class="form-row">
					<label for="full-name">الإسم بالكامل</label>
					<input type="text" name="full-name" id="full-name" class="input-text" placeholder="Your Name" <?php echo "value='".$_SESSION['fullname']."'"; ?>ك required>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="your-email">الإيميل</label>
					<input type="text" name="your-email" id="your-email" class="input-text" placeholder="Your Email" <?php echo "value='". $_SESSION['email']."'"; ?> required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
					<i class="fas fa-envelope"></i>
				</div>
			<div class="form-row">
				        <label for="username">إسم المستخدم</label>
						<input type="text" name="username" id="username" class="input-text"  <?php echo "value='".$_SESSION['username']."'"; ?> required>
					</div>

			<div class="form-row">
				        <label for="phone">رقم التليفون</label>

						<input type="text" name="phone" id="phone" class="input-text" placeholder="Your Phone" <?php echo "value='".$_SESSION['phone']."'"; ?>required>
					</div>

                      <div class="form-row">
				        <label for="Govern">المحافظة</label>

						<input type="text" name="Govern" id="Govern" class="input-text" placeholder="Your Govern" <?php echo "value='".$_SESSION['govern']."'"; ?>required>
					</div>

			<div class="form-row">
				        <label for="social_id">الرقم القومي</label>

						<input type="text" name="social_id" id="social_id" class="input-text" placeholder="Your Social Id" <?php echo "value='".$_SESSION['socialid']."'"; ?> required>
					</div>

					<div class="form-row">
				        <label for="Center">*الحي</label>

						<input type="text" name="Center" id="Center" class="input-text" placeholder=" Center"  <?php echo "value='".$_SESSION['center']."'"; ?>required>
					</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="إشتراك">
				</div>
			</form>
		</div>
	</div>

	<div class="footer" style="padding: 30px 0;">
  <div id="footer_contact" style="text-align: center; text-decoration: none;
  background-color: black; height: 130px;">
                <p style="text-align: center;">
                    <a href="#">الرئيسية </a>| <a href="#" id="ctl00_A32">
                        البحث فى الموقع </a>| <a href="#" id="ctl00_A33">مواقع مهمة
                        </a>| <a href="#" id="ctl00_A34">خريطة جوجل </a>| <a href="#" id="ctl00_A45" target="_blank">البريد الإلكتروني
                    </a>
                    <br />
                    <br />
                    <p style="color: red;">       جميع الحقوق محفوظة &copy; 2019</p>
                    
                    
                </p>
            </div>
            <div class="clear">
         </div>
</div>
</body>

</html>