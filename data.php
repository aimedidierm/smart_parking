<?php
/*
require 'php-includes/db_conn.php';
$in=0;
$p=0;
$b=0;
$balance=0;
$time = date('Y-m-d h:m:s');
$card = $_GET['card'];
$sql="SELECT * FROM user WHERE card = '$card' limit 1";
$exe=$conn->query($sql);
if($exe->num_rows>0){
    while ($row=$exe->fetch_array()) {
     $user=$row['id'];
     $balance=$row['balance']; 
 }

 $sql="SELECT amount FROM price limit 1";
 $exe=$conn->query($sql);
 while($row=$exe->fetch_array()){
    $amount=$row['amount'];
}
$sql="SELECT * FROM `history` WHERE enter IS NOT null AND goout  IS null";
$exe=$conn->query($sql);
$numCars=$exe->num_rows;
if($exe->num_rows>0){
    // when the user is getting out 
    $in=1;
    if($amount<=$balance){
        $b=1;
        $sql2="UPDATE `history` SET `goout` = '$time',`amount`='$amount' WHERE `history`.`user` = '$user'";
        $exe2=$conn->query($sql2);
        $balance=$balance-$amount;
        $sql3="UPDATE `user` SET `balance` = '$balance' WHERE `user`.`id` = '$user'";
        $exe3=$conn->query($sql3);

    }
    else{
        $b=0;
    }
}
else{
    

    $in=0;
    if ($numCars>=4) {
        $p=0;
    }
    else{
        $p=1;
        $numCars=$numCars+1;
        $sql="INSERT INTO `history`(`id`, `user`, `enter`, `goout`, `total`, `amount`) VALUES (null,'$user','$time',null,'$numCars','0')";
        $exe=$conn->query($sql);
    }
    
}
}
$data = array('in' =>$in,'b'=>$b,'p'=>$p,'balance'=>$balance); 
echo $response = json_encode($data)."\n";*/

//kwinjira
//$data = array('d1' => 1);

//gusohoka
//$data = array('d1' => 2);
echo "1";
//full
$data = array('d1' => 3);
echo $response = json_encode($data)."\n";
?>