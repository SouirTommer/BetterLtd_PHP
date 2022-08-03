<?php
session_start();

require_once("../../connection/mysqli_conn.php");


$cartdatajson = $_POST['data'];
$cartdata = json_decode($cartdatajson);
$cDate = new DateTime();
$cDate->format('Y-m-d H:i:s');

$totalprice = $cartdata[0]->totalprice;
$cusemail = $cartdata[0]->cusemail;
$orderid = $cartdata[0]->orderid;
$address = $cartdata[0]->deliveryAddress;
$date = $cartdata[0]->deliveryDate;

// if ($date == "0000-00-00"){
//     $date = null;
// }

$staffid = $_SESSION["staffID"];

//email checking
$sql="SELECT * FROM customer WHERE customerEmail = '{$cusemail}'";
$rs=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($rs)>0){

    } else{
        echo 'emailfail';
        exit;
    }

//insert for orders

if ($date == ""){
    $sql = "INSERT INTO orders(orderID, customerEmail, staffID, dateTime, deliveryAddress, deliveryDate, totalPrice)
    VALUES ('{$orderid}','{$cusemail}','{$staffid}','{$cDate->format('Y-m-d H:i:s')}','{$address}',NULL,'{$totalprice}')";
   
} else{
    $sql = "INSERT INTO orders(orderID, customerEmail, staffID, dateTime, deliveryAddress, deliveryDate, totalPrice)
    VALUES ('{$orderid}','{$cusemail}','{$staffid}','{$cDate->format('Y-m-d H:i:s')}','{$address}','{$date}','{$totalprice}')";
}
if (mysqli_query($conn, $sql)) {

    echo 'oreder success';
} else {
    echo "Error description: " . mysqli_error($conn);
}



//insert for itemorders
for ($i = 0; $i < sizeof($cartdata); $i++) {
    // echo sizeof($cartdata);
    // var_dump($cartdata[$i]);
    // var_dump($cDate->format('Y-m-d H:i:s'));
    $orderid = $cartdata[$i]->orderid;
    $itemid = $cartdata[$i]->itemid;
    $itemqty = $cartdata[$i]->itemqty;
    $itemprice = $cartdata[$i]->itemprice;

    $sql = "INSERT INTO itemorders(orderID, itemID, orderQuantity, price) 
    VALUES ('{$orderid}','{$itemid}','{$itemqty}','{$itemprice}')";

    if (mysqli_query($conn, $sql)) {

        echo 'iterm order success';
    } else {
        echo "Error description: " . mysqli_error($conn);
    }

    $sql = "UPDATE `item` 
    SET stockQuantity = stockQuantity - {$itemqty} 
    WHERE itemID = '{$itemid}'";
     if (mysqli_query($conn, $sql)) {

        echo 'item qty update success';
    } else {
        echo "Error description: " . mysqli_error($conn);
    }

}

exit;

