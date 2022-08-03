<?php

$orderID=(int) $_POST['orderID'];
$deliveryAddress=$_POST['deliveryAddress'];
$deliveryDate=$_POST['deliveryDate'];

    require_once("../../connection/mysqli_conn.php");


    $sql="SELECT * FROM orders WHERE orderID='".$orderID."'";


    $rs=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($rs)==0){
    
        echo "<script type='text/javascript'> 
        alert('Error!');
        document.location = '../staff_order.php'; 
        </script>";

    } else{


        $sql="UPDATE orders SET deliveryAddress='".$deliveryAddress."', deliveryDate='".$deliveryDate."' WHERE orderID='".$orderID."'";

        if(mysqli_query($conn,$sql)){
            
            echo "<script type='text/javascript'> 
            alert('This order is updated successfully!');
            document.location = '../staff_order.php'; 
            </script>";
        } else{
            echo "Error description: ". mysqli_error($conn);
        }
    }

?>