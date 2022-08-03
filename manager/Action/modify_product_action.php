<?php

$itemID=(int) $_POST['itemID'];
$itemName=$_POST['itemName'];
$itemDescription=$_POST['itemDescription'];
$stockQuantity= (int) $_POST['stockQuantity'];
$price= (double) $_POST['price'];

    require_once("../../connection/mysqli_conn.php");


    $sql="SELECT * FROM item WHERE itemID='".$itemID."'";


    $rs=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($rs)==0){
    
        echo "<script type='text/javascript'> 
        alert('Error!');
        document.location = '../manager_product.php'; 
        </script>";

    } else{


        $sql="UPDATE item SET itemName='".$itemName."', itemDescription='".$itemDescription."', 
        stockQuantity='".$stockQuantity."',price='".$price."' WHERE itemID='".$itemID."'";

        if(mysqli_query($conn,$sql)){
            
            echo "<script type='text/javascript'> 
            alert('This item is updated successfully!');
            document.location = '../manager_product.php'; 
            </script>";
        } else{
            echo "Error description: ". mysqli_error($conn);
        }
    }

?>