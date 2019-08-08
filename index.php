<?php
    
    ob_start();
    session_start();
    $title = 'الرئيسية';
    include 'init.php';

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="index">
    <div class="overlay">
    
    <div class="container">
        <div class="reglog">
            <div class="row">
                
                
                <div class="col-xs-4">
                    <a class="btn btn-default center-block log" href="jobs/jobs.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>الوظايف</a>
                </div>
                
                <?php 
                    
                    if(!isset($_SESSION['userid']))
                    {
                
                ?>
                
                <div class="col-xs-4">
                    <a class="btn btn-default center-block reg" href="signup.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>التسجيل</a>
                </div>
                <div class="col-xs-4">
                    <a class="btn btn-default center-block log" href="login.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>تسجيل الدخول</a>
                </div>
                
                <?php
                    }
                
                    else
                    {
                ?>
                        <div class="col-xs-offset-4 col-xs-4">
                            <a class="btn btn-default center-block logout" href="logout.php" role="button"><i class="fa fa-edit fa-x" style="color:white; margin-right:3px"></i>تسجيل الخروج</a>
                        </div>
                <?php
                        
                        $row = $db->getRow("select Water, Gas, Electricity from users where ID = ?", array($_SESSION['userid']));
                        
                    }
                ?>
                
            </div>
        </div>

        <div class="services">
            <div class="row">
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/water.jpg" class="img-responsive">
                        </div>
                        <a href="water-main.php" class="center-block text-center homepage">الصفحة الرئيسية</a>
                        <div class="functions">
                            <ul dir="rtl">
								<?php
                                    
                                    if(isset($_SESSION['userid']))
                                    {
                                        if($row[0] == 1)
                                        {
                                ?>
                                            <li><a href="inquireinvoicewater.php">الاستعلام عن الفاتورة</a></li>
                                            <li><a href="pay.php?s=w">دفع الفاتورة</a></li>
                                            <li><a href="rate_service.php?s=w">تقييم الخدمة</a></li>
                                            <li><a href="stop_service.php?s=w">إيقاف الخدمة</a></li>
                                            <li><a href="complaints.php?service=water">تقديم شكوى</a></li>
                                
                                <?php
                                        }
                                        else
                                        {
                                ?>
                                            <li><a href="WaterForm2.php">إشتراك</a></li>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <li><a href="inquireinvoicewater.php">الاستعلام عن الفاتورة</a></li>
                                        <li><a href="pay.php?s=w">دفع الفاتورة</a></li>
                                        <li><a href="rate_service.php?s=w">تقييم الخدمة</a></li>
                                        <li><a href="stop_service.php?s=w">إيقاف الخدمة</a></li>
                                        <li><a href="complaints.php?service=water">تقديم شكوى</a></li>
                                <?php
                                    }
                                ?>
                                
                                <li><a href="new.php?s=w">إظهار الأفرع</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/gas.jpg" class="img-responsive">
                        </div>
                        <a href="gas-main.php" class="center-block text-center homepage">الصفحة الرئيسية </a>
                        <div class="functions">
                            <ul dir="rtl">
                                <?php
                                    
                                    if(isset($_SESSION['userid']))
                                    {
                                        if($row[1] == 1)
                                        {
                                ?>
                                            <li><a href="inquireinvoicegas.php">الاستعلام عن الفاتورة</a></li>
                                            <li><a href="pay.php?s=g">دفع الفاتورة</a></li>
                                            <li><a href="rate_service.php?s=g">تقييم الخدمة</a></li>
                                            <li><a href="stop_service.php?s=g">إيقاف الخدمة</a></li>
                                            <li><a href="complaints.php?service=gas">تقديم شكوى</a></li>
                                
                                <?php
                                        }
                                        else
                                        {
                                ?>
                                            <li><a href="GasForm2.php">إشتراك</a></li>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <li><a href="inquireinvoicegas.php">الاستعلام عن الفاتورة</a></li>
                                        <li><a href="pay.php?s=g">دفع الفاتورة</a></li>
                                        <li><a href="rate_service.php?s=g">تقييم الخدمة</a></li>
                                        <li><a href="stop_service.php?s=g">إيقاف الخدمة</a></li>
                                        <li><a href="complaints.php?service=gas">تقديم شكوى</a></li>
                                <?php
                                    }
                                ?>
                                
                                <li><a href="new.php?s=g">إظهار الأفرع</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="serv center-block">
                        <div class="logo center-block">
                            <img src="layout/images/elec.jpg" class="img-responsive">
                        </div>
                        <a href="electricity-main.php" class="center-block text-center homepage">الصفحة الرئيسية </a>
                        <div class="functions">
                            <ul dir="rtl">
                                <?php
                                    
                                    if(isset($_SESSION['userid']))
                                    {
                                        if($row[2] == 1)
                                        {
                                ?>
                                            <li><a href="inquireinvoiceelec.php">الاستعلام عن الفاتورة</a></li>
                                            <li><a href="pay.php?s=e">دفع الفاتورة</a></li>
                                            <li><a href="rate_service.php?s=e">تقييم الخدمة</a></li>
                                            <li><a href="stop_service.php?s=e">إيقاف الخدمة</a></li>
                                            <li><a href="complaints.php?service=electricity">تقديم شكوى</a></li>
                                
                                <?php
                                        }
                                        else
                                        {
                                ?>
                                            <li><a href="Elictricity2.php">إشتراك</a></li>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <li><a href="inquireinvoiceelec.php">الاستعلام عن الفاتورة</a></li>
                                        <li><a href="pay.php?s=e">دفع الفاتورة</a></li>
                                        <li><a href="rate_service.php?s=e">تقييم الخدمة</a></li>
                                        <li><a href="stop_service.php?s=e">إيقاف الخدمة</a></li>
                                        <li><a href="complaints.php?service=electricity">تقديم شكوى</a></li>
                                <?php
                                    }
                                ?>
                                
                                <li><a href="new.php?s=e">إظهار الأفرع</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    
    </div>   
</div>


<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>