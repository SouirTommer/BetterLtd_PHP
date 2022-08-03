<?php
    session_start();
    
    if($_SESSION['authenticated'] != true){
      echo "<script type='text/javascript'> 
      document.location = '../index.php'; 
      </script>";
      exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">  

  <meta name="viewport" content=  "width=device-width, initial-scale=1">
  <title>Better Limited Retail Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/a178411011.js" crossorigin="anonymous"></script>


</head>

<body>

  <?php 
    $month=$_POST['month']; 
    $year= date("Y");
    $date= $year . "-" . $month;
    
    require_once("../connection/mysqli_conn.php");

    $sql = "SELECT `staff`.`staffID`, `staff`.`staffName`, COUNT(`orders`.`orderID`) AS 'Number of order records', SUM(`orders`.`totalPrice`) AS 'Total sales amount'
    FROM `staff` 
      LEFT JOIN `orders` ON `orders`.`staffID` = `staff`.`staffID`
    WHERE `orders`.`staffID` = `staff`.`staffID` AND `orders`.`dateTime` LIKE '".$date."%'
    GROUP BY `orders`.`staffID`";
    $rs = mysqli_query($conn, $sql);
  ?>

  <div class="wrapper">
    <div id="red" class="sidebar" >
      <a href="manager_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li><a href="manager_product.php"><i class="fa-solid fa-receipt"></i> Product</a></li>
        <li><a href="manager_customer.php"><i class="fa-solid fa-file-invoice"></i> Customer</a></li>
        <li style="background: rgba(255,255,255, 0.3);"><a href="manager_Report.php"><i class="fa-solid fa-file-invoice"></i> Report</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">
        <a href="manager_report.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
        <div class="header" style="padding: 6px 14px;">Report (<?php echo($date); ?>) </div>
        
        
      </div>
      <div class="box_table">
        <div class="custom-table">
          <table>
            <thead>
              <tr>
                <th>Staff ID</th>
                <th>Staff Name</th>
                <th>Number of order records</th>
                <th>Total sales amount</th>
              </tr>
            </thead>
            <tbody>
              
            <?php
              while ($rc = mysqli_fetch_assoc($rs)) {
              ?>
                <tr>
                  <td><?php echo $rc['staffID'] ?></td>
                  <td><?php echo $rc['staffName'] ?></td>
                  <td><?php echo $rc['Number of order records'] ?></td>
                  <td><?php echo $rc['Total sales amount'] ?></td>
                </tr>

                <?php
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>

</html>