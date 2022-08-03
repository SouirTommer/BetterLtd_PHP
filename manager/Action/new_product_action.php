<?php
$itemName=$_POST['itemName'];
$itemDescription=$_POST['itemDescription'];
$stockQuantity= (int) $_POST['stockQuantity'];
$price= (double) $_POST['price'];

    require_once("../../connection/mysqli_conn.php");


    $sql="SELECT * FROM item WHERE itemName='".$itemName."'";
    $rs=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($rs)>0){
    
        echo "<script type='text/javascript'> 
        alert('Item already exist!');
        document.location = '../add_product.php'; 
        </script>";

    } else{

        $sql="INSERT INTO item(itemName, itemDescription, stockQuantity, price) VALUES
        ('{$itemName}','{$itemDescription}','{$stockQuantity}','{$price}')";

        if(mysqli_query($conn,$sql)){
            
            echo "<script type='text/javascript'> 
            alert('This item is added successfully!');
            document.location = '../manager_product.php'; 
            </script>";
        } else{
            echo "Error description: ". mysqli_error($conn);
        }
    }

?>