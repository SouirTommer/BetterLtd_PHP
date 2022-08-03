<?php


function init(){ 
    $check=$_POST['Login'];
    
    require_once("connection/mysqli_conn.php");

    if($check == "Login"){
        $sql="Select * FROM staff WHERE staffID='{$_POST["staffID"]}' AND password='{$_POST["password"]}' ";
    } else if($check == "Manager Login"){
        $sql="Select * FROM staff WHERE staffID='{$_POST["staffID"]}' AND password='{$_POST["password"]}' AND position = 'Manager' ";
    }
    
    $rs=mysqli_query($conn,$sql);
        checkStaffLogin($rs, $check);
}

function checkStaffLogin($rs, $check){
    if(mysqli_num_rows($rs) >0){
        session_start();

        $_SESSION['authenticated']=true;
        $rc=mysqli_fetch_assoc($rs);
            $_SESSION["staffID"]=$rc["staffID"];


        if($check == "Manager Login"){
            header("Location: manager/manager_product.php");
        }else{
            header("Location: staff/staff_product.php");
        }

    } else{

        
        if($check == "Manager Login"){
            
            echo "<script type='text/javascript'> 
            alert('StaffID or Password is incorrect! OR you are not manager');
            document.location = 'index.php'; 
            </script>";
            exit;
        } else{
            echo "<script type='text/javascript'> 
            alert('StaffID or Password is incorrect!');
            document.location = 'index.php'; 
            </script>";
            exit;

        }

    }

}

init();

?>