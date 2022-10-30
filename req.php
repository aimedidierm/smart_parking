<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
//echo $time=date_default_timezone_get();
$time = date('Y-m-d h:m:s');
if(isset($_GET['gusohoka'])){
    $card = $_GET['gusohoka'];
    $query = "SELECT * FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $user=$rows['id'];
    $balance=$rows['balance'];
    $query = "SELECT * FROM history ORDER BY id DESC limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $praces=$rows['total'];
    $total=$praces-1;
    $query = "SELECT * FROM history WHERE user = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($user));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $entertime=$rows['enter'];
    //calculte amount 
    $query = "SELECT amount FROM price limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $amount=$rows['amount'];
    echo $c=$time-$entertime;
    /*
    $pay=200;

    if ($pay<=$balance) {
        $newbalance=$balance-$pay;
        $sql ="UPDATE history SET gout = ? WHERE user = ?";
        $stm = $db->prepare($sql);
        $stm->execute(array($time,$user));
        $sql ="UPDATE user SET balance = ? WHERE id = ?";
        $stm = $db->prepare($sql);
        $stm->execute(array($newbalance,$user));
        $data = array('cstatus' =>$total);
        echo $response = json_encode($data);
    } else {
    $data = array('cstatus' =>'10'); 
    echo $response = json_encode($data);
}*/
}
if(isset($_GET['kwinjira'])){
    $card = $_GET['kwinjira'];
    $query = "SELECT id FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $user=$rows['id'];
    $query = "SELECT * FROM history ORDER BY id DESC limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $praces=$rows['total'];
    $total=$praces+1;
    if ($praces!=4) {
        $sql ="INSERT INTO history (user,enter,total) VALUES (?,?,?)";
        $stm = $db->prepare($sql);
        $stm->execute(array($user,$time,$total));
        $data = array('cstatus' =>$praces);
        echo $response = json_encode($data);
    } else {
    $data = array('cstatus' =>'10'); 
    echo $response = json_encode($data);
}
}
if(isset($_GET['kureba'])){
    $query = "SELECT * FROM history ORDER BY id DESC limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $praces=$rows['total'];
    $data = array('cstatus' =>$praces);
    echo $response = json_encode($data);
}
?>