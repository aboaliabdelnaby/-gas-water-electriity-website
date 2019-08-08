<?php
    
    ob_start();
    session_start();
    $title = 'تقييم الخدمة';
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        
        $service    = $_POST['s'];
        $userid     = $_SESSION['userid'];
        $stop_start = $_POST['stop_start'];
        $duration   = $_POST['duration'];
        
        $date = date_create($stop_start);
        date_add($date, date_interval_create_from_date_string($duration . ' months'));
        
        $stop_end   = date_format($date, 'Y-m-d');
        
        $q = "INSERT INTO stop_sub(U_ID, service, stop_start, stop_end, Duration) VALUES (?, ?, ?, ?, ?)";
        
        $num = $db->insertRow($q, array($userid, $service, $stop_start, $stop_end, $duration));
        
        if($num > 0)
        {
            $msg = "<div class='alert alert-success' dir='rtl'> ايقاف الخدمه.</div>";
        }
        
    }
    
    

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="rate" style="background: url('layout/images/stop1.jpg');background-position: center center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed;">
    <div class="">
        <div class="container">

            <form class="center-block form-horizontal" method="post">
                
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($msg)) { echo $msg; } ?>
                
                <h1 class="text-center">إيقاف الخدمة</h1>
                
                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="date" name="stop_start" class="form-control">
                    </div>
                    <label class="control-label col-sm-3" dir="rtl"> بداية الإيقاف :</label>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="number" name="duration" class="form-control">
                    </div>
                    <label class="control-label col-sm-3" dir="rtl"> مدة الشهور :</label>
                </div>
                
                <input type="hidden" value="<?php echo $_GET['s'] ?>" name="s">
                
                <input type="submit" value="إيقاف" class="form-control center-block">
                
            </form>
            
        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>