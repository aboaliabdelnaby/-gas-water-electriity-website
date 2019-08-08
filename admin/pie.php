<?php
    include"connect.php";

 if(isset($_POST['e'])){
     $stmt=$con->prepare("select ERate as a,count(ID) as b from users where Electricity=? and ERate>0 group by a order by a");
        $stmt->execute(array(1));
        $res=$stmt->fetchAll();

        echo json_encode($res);
 }
 if(isset($_POST['w'])){
     $stmt=$con->prepare("select WRate as a,count(ID) as b from users where Water=? and WRate>0 group by a order by a");
        $stmt->execute(array(1));
        $res=$stmt->fetchAll();

        echo json_encode($res);
 }
 if(isset($_POST['g'])){
     $stmt=$con->prepare("select GRate as a,count(ID) as b from users where Gas=? and GRate>0 group by a order by a");
        $stmt->execute(array(1));
        $res=$stmt->fetchAll();

        echo json_encode($res);
 }
?>