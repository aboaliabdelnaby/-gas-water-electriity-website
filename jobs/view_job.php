<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $msg = array(); 
        $fullname        = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING); 
        $email           = $_POST['email']; 
        $socialid        = $_POST['socialid']; 
        $mobile          = $_POST['mobile']; 
        $job_id          = $_POST['job_id']; 
        function pre_r($array){
            echo'<pre>';
            print_r($array);
            echo'</pre>';
        } 
        if(isset($_FILES['cv'])){
            //print_r($_FILES);
            //pre_r($_FILES);
            $cv  = 'files/'.$_FILES['cv']['name'];
            move_uploaded_file($_FILES['cv']['tmp_name'],'../admin/files/'.$_FILES['cv']['name']);
        }
        
        if(strlen($fullname) < 10 || strlen($fullname) > 60)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الاسم الكامل للمستخدم يجب ان يكون بين 10 و 60 حرف</div>";
        } 
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>البريد الالكترونى غير صالح</div>";
        }
        
        if(!is_numeric($socialid))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الرقم القومى غير صالح</div>";
        } 
        if(!is_numeric($mobile))
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الهاتف غير صالح</div>";
        } 
        if(is_numeric($mobile) && strlen($mobile) != 11)
        {
            $msg[] = "<div class='alert alert-danger' dir='rtl'>الهاتف غير صالح</div>";
        } 

        if(empty($msg))
        {
            include("connect.php");
            $sql = "insert into applicants (job_id,name,email,status,cv) VALUES ('$job_id', '$fullname', '$email','0','$cv')";
            if ($conn->query($sql) === TRUE) {
                        //echo'successfully insert data in applicants table';
            }else {
                        echo "Error:in table applicants " . $sql . "<br>" . $conn->error;
            }
           // $db->insertRow("insert into users(UserName, Password, social_id, Phone, Email, Govern, District, address, Center, FullName, Electricity, Water, Gas) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1, 1)", array($username, $password_hash, $socialid, $mobile, $email, $govern, $district, $address, $center, $fullname));
             //$row = $db->getRow("select ID from users where UserName = ?", array($username));  
            $success = "<div class='alert alert-success' dir='rtl'>  تم الارسال البيانات بنجاح وسوف يتم الرد من خلال الايميل </div>";
            header("location: jobs.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="ar"> 
<head >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> أخبار الوظائف </title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
        <link href="css/lightbox.min.css" rel="stylesheet">
        <link href="css/social-share-kit.css" rel="stylesheet">
        <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/card.min.css" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/fontawesome-all.min.css" rel="stylesheet"> 
        <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/front-style.css">
        <!-- <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">  -->
</head> 
<body> 
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="menu">القائمة</span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left center-block " style="text-align:center;margin:auto;">
                    <li ><a href="jobs.php" class=" active" style="width: 800px;margin-left: 122px;"> أخبار الوظائف</a></li> 
                </ul>
            </div>
        </div>
    </nav>
    <div id="jobs" class="container">
        <div class="well well-lg">
            <div class="panel panel-primary">
                <div class="panel-heading">أخبار الوظائف</div>
                <div class="panel-body text-center" style="padding:0;"> 
                    <ul class="text-right list-unstyled">
                        <?php 
                            include("connect.php");
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                $conn->query("set names utf8");
                                $sql = "select * FROM jobs where id='$id' ";//LIMIT 1
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row= $result->fetch_assoc()) {
                                        echo'<li> 
                                                    <h2>' . $row["location"] . '<br /> 
                                                        <ul class="list-unstyled" id="job_name">
                                                        <li>  '.$row["name"].' </li> 
                                                            <li>  '.$row["description"].' </li> 
                                                        </ul> 
                                                    </h2> 
                                                <span id="ad_date">'.$row["date"].'</span>
                                            </li>
                                            ';
                                    }
                                }
                            } 
                            //echo $id;
                        ?> 
                    </ul> 
                    <hr />
                    <div class="alert alert-info"> 
                        <div class="signup">
    <div class="overlay">
        <div class="container"> 
            <form method="post" class="center-block" enctype="multipart/form-data" style="width: 1000px;"> 
                <h2>التقديم على الوظيفة </h2> 
                <?php 
                    if(isset($msg)) 
                    {
                        foreach($msg as $m)
                        {
                            echo $m;
                        }
                    } 
                    if(isset($success))
                    {
                        echo $success;
                        //header("refresh:2; url=jobs.php");
                    } 
                ?> 
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder=" الاسم المتقدم " name="fullname" required  pattern=".{10,60}" title="الاسم للمستخدم يجب ان يكون بين 10 و 60 حرف">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-envelope fa-fw"></i>
                        </div>
                        <input type="email" class="form-control" placeholder="البريد الالكترونى" name="email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="الرقم القومى" name="socialid" required pattern="^[0-9]{14}$" title="الرقم القومى غير صالح">
                    </div>
                </div>
                
                <!-- <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="كلمة المرور" name="password" required autocomplete="new-password" pattern=".{5,15}" title="كلمة المرور يجب ان تكون بين 5 و 15 حرف">
                    </div>
                </div> -->
                
                <!-- <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key fa-fw"></i>
                        </div>
                        <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password2" required autocomplete="new-password" pattern=".{5,15}" title="كلمة المرور يجب ان تكون بين 5 و 15 حرف">
                    </div>
                </div> -->
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone fa-fw"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="رقم الهاتف" name="mobile" required pattern="^[0-9]{11}$" title="رقم الهاتف مكون من 11 رقم">
                    </div>
                </div>  
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-file-pdf-o"></i>
                        </div>
                        <input type="file" class="form-control" placeholder="اضغط للرفع الملف" name="cv" required title=" اضغط للرفع الملف ">
                    </div>
                </div>
                <input type="hidden" name="job_id" value="<?php echo $id; ?>">
                <input type="submit" value="التسجيل" class="form-control center-block">

            </form>

        </div>
    </div>
</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!---------------- Share ----------------->

    <div class="ssk-sticky ssk-left ssk-center ssk-lg">
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://www.dkwasc.com.eg/pages/jobs.php" class="ssk ssk-facebook" title="شارك عبر الفيسبوك"></a>
        <a href="https://twitter.com/home?status=http://www.dkwasc.com.eg/pages/jobs.php" class="ssk ssk-twitter" title="شارك عبر تويتر"></a>
        <a href="https://plus.google.com/share?url=http://www.dkwasc.com.eg/pages/jobs.php" class="ssk ssk-google-plus" title="شارك عبر جوجل بلس"></a>
        <a href="mailto:?" class="ssk ssk-email" title="شارك عبر البريد الالكتروني"></a>
        <!--
    <a href="https://www.facebook.com/dialog/send?app_id=673798652822430&link=http://www.dkwasc.com.eg/pages/jobs.php&redirect_uri=http://www.dkwasc.com.eg/pages/jobs.php&display=popup" class="ssk ssk-fbm" title="شارك عبر ماسنجر الفيسبوك"><img src="../img/icons/fbm.png" height="28" width="28" /></a>-->
    </div>
    <!--------- Footer ------------------>
    <footer>
        <div class="container"> 
            <div class="row"> 
            <hr />
            <div class="row">

                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 text-center rights">
                            <p class="text-center">جميع الحقوق محفوظة &copy; <a href="http://www.dkwasc.com.eg">شركات الكهرباء و مياه الشرب والصرف الصحي والغاز   </a> 2019</p>
                        </div>
                    </div>
                </div> 
            </div>

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
        </div> 
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script> 
    <!-- <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut(100);
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            }); 
        });
    </script>  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/social-share-kit.min.js"></script>
    <script src="js/bootstrap-dropdownhover.min.js"></script>
    <script src="js/script.js"></script>
    
</body> 
</html>