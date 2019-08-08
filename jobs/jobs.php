 
<html> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
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
    <link href="../layout/css/fontawesome-all.min.css" rel="stylesheet">  
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
                    <img class="img-responsive" src="img/c4.jpg" width="100%" style="margin:0;" />
                    <ul class="text-right list-unstyled">
                        <?php
                        include("connect.php");
                        $conn->query("set names utf8");
                        $sql = "select * FROM jobs"; //LIMIT 1
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            //print_r($result->fetch_assoc());
                            while ($row = $result->fetch_assoc()) {
                                echo '<li>
                                            <a href="view_job.php?id=' . $row["id"] . '">
                                                <h2>' . $row["location"] . '<br /> 
                                                    <ul class="list-unstyled" id="job_name">
                                                    <li>  ' . $row["name"] . ' </li> 
                                                        <li>  ' . $row["description"] . ' </li> 
                                                    </ul> 
                                                </h2>
                                            </a>
                                            <span id="ad_date">' . $row["date"] . '</span>
                                        </li>
                                        ';
                            }
                        }
                        ?> 
                    </ul> 
                    <hr />
                    <div class="alert alert-info">
                        <strong>
                            الرجاء متابعة الصفحة لمعرفة آخر أخبار الوظائف على مواقع التواصل الاجتماعى
                        </strong>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!---------------- Share ----------------->

    <div class="ssk-sticky ssk-left ssk-center ssk-lg">
        <a href="https://www.facebook.com/aly.momdouh/jobs.php" class="ssk ssk-facebook" title="شارك عبر الفيسبوك"></a>
        <a href="https://twitter.com/aly.momdouh" class="ssk ssk-twitter" title="شارك عبر تويتر"></a>
        <a href="https://plus.google.com/alymomdouh" class="ssk ssk-google-plus" title="شارك عبر جوجل بلس"></a>
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
                                <p class="text-center">جميع الحقوق محفوظة &copy; <a href="../index.php">شركات الكهرباء و مياه الشرب والصرف الصحي والغاز </a> 2019</p>
                            </div>                  <!--  http://www.dkwasc.com.eg      -->
                        </div>
                    </div>
                </div> 
            </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
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
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/social-share-kit.min.js"></script>
    <script src="js/bootstrap-dropdownhover.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        SocialShareKit.init();
    </script>
    <!--Start of Chat Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/596ca3db6edc1c10b0346577/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <script>
        var app = angular.module('myApp', []);
        app.controller('areasCtrl', function($scope, $http) {
            $http.get("areas_contact.php")
                .then(function(response) {
                    $scope.names = response.data.records;
                    $scope.update = function() {
                        console.log($scope.names);
                    }
                });
        });
    </script>
</body>

</html>