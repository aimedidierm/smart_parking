<?php
/*$query = "SELECT * FROM history ORDER BY id DESC limit 1";
$stmt = $db->prepare($query);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
$praces=$rows['total'];*/
$data = array('cstatus' =>"5");
echo $response = json_encode($data);
?>