<?php
$customerEmail=$_POST['customerEmail'];

require_once("../../connection/mysqli_conn.php");

    $sql="Select orderID FROM orders WHERE customerEmail='".$customerEmail."'";
    $rs=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($rs)){
        $sql="DELETE FROM itemorders WHERE orderID='".$row['orderID']."'";
        $rc=mysqli_query($conn,$sql);

        $sql="DELETE FROM orders WHERE orderID='".$row['orderID']."'";
        $rc=mysqli_query($conn,$sql);
    }

    $sql="DELETE FROM customer WHERE customerEmail='".$customerEmail."'";
    $rc=mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn)>0){
         echo "<script type='text/javascript'> 
         alert('Deleted!');
         document.location = '../manager_customer.php'; 
         </script>";
    }

?>