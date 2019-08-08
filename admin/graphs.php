<?php
    include"connect.php";
    if(isset($_POST['e'])){


    $stmt=$con->prepare("select month(date) as a,count(cid) as b from complaints where service=? and year(date)=? group by a order by a");
        $stmt->execute(array('electricity',date("Y")));
        $res=$stmt->fetchAll();

        echo json_encode($res);
}
   if(isset($_POST['w'])){


    $stmt=$con->prepare("select month(date) as a,count(cid) as b from complaints where service=? and year(date)=? group by a order by a");
        $stmt->execute(array('water',date("Y")));
        $res=$stmt->fetchAll();

        echo json_encode($res);
}
if(isset($_POST['g'])){


    $stmt=$con->prepare("select month(date) as a,count(cid) as b from complaints where service=? and year(date)=? group by a order by a");
        $stmt->execute(array('gas',date("Y")));
        $res=$stmt->fetchAll();

        echo json_encode($res);
}

?>