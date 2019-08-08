<?php
    
    ob_start();
    session_start();
    $title = 'تقييم الخدمة';
    include 'init.php';
    
    $service    = $_GET['s'];
    $userid     = $_SESSION['userid'];

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $userid     = $_SESSION['userid'];
        $rate       = $_POST['rate'];
        $service    = $_POST['s'];
        
        
        if($service == 'e')
        {
            $q = "update users set ERate = ? where ID = ?";
        }
        
        if($service == 'w')
        {
            $q = "update users set WRate = ? where ID = ?";
        }
        
        if($service == 'g')
        {
            $q = "update users set GRate = ? where ID = ?";
        }
        
        
        $num = $db->updateRow($q, array($rate, $userid));
        
        if($num > 0)
        {
            $msg = "<div class='alert alert-success' dir='rtl'>تم التقييم.</div>";
        }
    }
    
    if($service == 'e')
    {
        $current_rate = $db->getRow("select ERate from users where ID = ? ", array($userid));
    }

    if($service == 'w')
    {
        $current_rate = $db->getRow("select WRate from users where ID = ? ", array($userid));
    }

    if($service == 'g')
    {
        $current_rate = $db->getRow("select GRate from users where ID = ? ", array($userid));
    }

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div class="rate">
    <div class="">
        <div class="container">

            <form class="center-block" method="post">
                
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($msg)) { echo $msg; } ?>
                
                <h1 class="text-center">تقييم الخدمة</h1>
                
                <h3 class="text-center">تقييمك الحالى : <?php echo $current_rate[0] ?></h3>
                
                <select name="rate" class="form-control" style="margin: 55px auto; width: 50%">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                
                <input type="hidden" value="<?php echo $_GET['s'] ?>" name="s">
                
                <input type="submit" value="تقييم" class="form-control center-block">
                
            </form>
            
        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();

?>