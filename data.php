<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
/*
//kwinjira
$data = array('c' => 1);
echo $response = json_encode($data)."\n";
//gusohoka
$data = array('c' => 2,'balance' =>$newbalance);
echo $response = json_encode($data)."\n";
//No solts
$data = array('c' => 3);
echo $response = json_encode($data)."\n";
//lowbalance
$data = array('c' => 10);
echo $response = json_encode($data)."\n";
*/

if(isset($_POST['card'])){
    $card=$_POST['card'];
    $query = "SELECT * FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    if ($stmt->rowCount() > 0) {
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $uid=$rows['id'];
        $query = "SELECT * FROM history WHERE user=? ORDER BY id DESC limit 1";
        $stmt = $db->prepare($query);
        $stmt->execute(array($card));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>