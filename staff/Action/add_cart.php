<?php
session_start();

$itemid = $_POST['itemID'];
$name = $_POST['itemName'];
$price = $_POST['price'];

$items = array('itemid' => $itemid, 'name' => $name, 'price' => $price);


echo json_encode($items);
exit;
if ($_SESSION['authenticated'] != true) {
  echo "<script type='text/javascript'> 
      document.location = '../../index.php'; 
      </script>";
  exit;
}

?>