<?php
session_start();
?>

<?php
$orderID=$_POST['orderID'];
$deliveryAddress=$_POST['deliveryAddress'];
$deliveryDate=$_POST['deliveryDate'];
$check=$_POST['act'];

require_once("../../connection/mysqli_conn.php");

if($check == "delete"){

    $sql="DELETE FROM itemorders WHERE orderID='".$orderID."'";
    $rc=mysqli_query($conn,$sql);

    $sql="DELETE FROM orders WHERE orderID='".$orderID."'";
    $rc=mysqli_query($conn,$sql);


    if(mysqli_affected_rows($conn)>0){
         echo "<script type='text/javascript'> 
         alert('Deleted!');
         document.location = '../staff_order.php'; 
         </script>";
    }
}


if($check == "update"){
    
    
    $_SESSION['order_detail'] = $orderID;
    $_SESSION['order_detail_Address'] = $deliveryAddress;
    $_SESSION['order_detail_Date'] = $deliveryDate;

    echo "<script type='text/javascript'> 
    document.location = '../update_order.php'; 
    </script>";
}

if($check == "view"){
    
    $_SESSION['order_detail'] = $orderID;

    echo "<script type='text/javascript'> 
    document.location = '../order_detail.php'; 
    </script>";
}

?>