<?php
    
    ob_start();
    session_start();
    $title = 'تقييم الخدمة';
    include 'init.php';

    $q = "select * from posts where id = ?";
    $row = $db->getRow($q, array($_GET['id']));

?>
<!-- chat Script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c19d9dcc-731c-4a28-aa46-a8cddd09f7d7"> </script>

<div style="background: url(layout/images/post.jpg);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;">
        <div class="container" dir="rtl">

            <h1 style="text-align: center; margin: 60px 0; font-size: 42px;"><?php echo $row['subject'] ?></h1>
            
            
            <img src="<?php echo "layout/images/".$row['image'] ?>" style="display: block;
    margin: 0px auto 55px;
    width: 750px;
    height: 350px;
    border-radius: 15px;
    border: 5px solid black;">
            <span style="font-size: 18px;
    color: crimson;"><?php echo $row['date'] ?></span>
            
            <p style="    font-size: 23px;
    color: black;
    line-height: 1.5;
    margin-top: 15px;"><?php echo $row['content'] ?></p>
            
        </div>
    </div>
</div>

<?php

    include "$tpl/footer.php";
    ob_end_flush();
?>