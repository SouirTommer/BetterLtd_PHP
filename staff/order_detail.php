<?php
    session_start();
    $orderID = $_SESSION['order_detail'];
    
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
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Better Limited Retail Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/a178411011.js" crossorigin="anonymous"></script>

</head>

<body>

<?php
  require_once("../connection/mysqli_conn.php");
  $sql = "SELECT itemorders.*, item.itemName FROM itemorders 
    LEFT JOIN item ON itemorders.itemID = item.itemID 
    WHERE itemorders.orderID='".$orderID."' AND item.itemID = itemorders.itemID
    ORDER BY `item`.`itemName` DESC";
  $rs = mysqli_query($conn, $sql);
  ?>

  <div class="wrapper">
    <div class="sidebar">
      <a href="staff_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li><a href="staff_product.php"><i class="fa-solid fa-receipt"></i> Sales Product</a></li>
        <li style="background: rgba(255,255,255, 0.3);"><a href="staff_order.php"><i class="fa-solid fa-file-invoice"></i> Order Record</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">

      <a href="staff_order.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</button></a>

        <div class="header" style="padding: 6px 14px;">Order Detail (DESC BY ITEMNAME)</div>

      </div>
      <div class="box_table">
        
        <div class="custom-table">
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>itemName</th>
                <th>itemID</th>
                <th>orderQuantity</th>
                <th>price</th>
              </tr>
            </thead>
            <tbody>

            <?php
              while ($rc = mysqli_fetch_assoc($rs)) {
              ?>
                <tr>
                  <td><?php echo $rc['orderID'] ?></td>
                  <td><?php echo $rc['itemName'] ?></td>
                  <td><?php echo $rc['itemID'] ?></td>
                  <td><?php echo $rc['orderQuantity'] ?></td>
                  <td><?php echo $rc['price'] ?></td>
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