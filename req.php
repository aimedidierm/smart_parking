<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
$sellerid=1;
$newamount=0;
if(isset($_GET['gusohoka'])){
    $card = $_GET['gusohoka'];
    //$card = 'F3 65 AB AB';
/*
            if ($stm->execute(array($newamount, $user))) {
                $data = array('cstatus' =>$praces,'balance' =>$balance);
                echo $response = json_encode($data);
            }
        } else {
            $data = array('cstatus' =>'0'); 
            echo $response = json_encode($data);
        }
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
    $time="2022-08-15 21:11:01";
    if ($praces!=4) {
        $sql ="INSERT INTO history (user,enter,total) VALUES (?,?,?)";
        $stm = $db->prepare($sql);
        $stm->execute(array($user,$time,$total));
        $data = array('cstatus' =>$praces);
        echo $response = json_encode($data);
    } else {
    $data = array('cstatus' =>'1'); 
    echo $response = json_encode($data);
}
}
?>