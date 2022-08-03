<?php
session_start();

if ($_SESSION['authenticated'] != true) {
  echo "<script type='text/javascript'> 
      document.location = '../index.php'; 
      </script>";
  exit;
}
?>

<?php
$orderID=$_SESSION['order_detail'];
$deliveryAddress = $_SESSION['order_detail_Address'] ;
$deliveryDate = $_SESSION['order_detail_Date'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Better Limited Retail Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/styles.css" />
  <script src="https://kit.fontawesome.com/a178411011.js" crossorigin="anonymous"></script>
</head>

<body>
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
        <div class="header" style="padding: 6px 14px;">Update order (orderID: <?php echo($orderID); ?>)</div>

      </div>


      <section id="add-prod">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-12">
              <h3>Update delivery information</h3>
              <form action="Action/update_order_action.php" method="post">

              <div class="form-group row">
                  <label for="orderID" class="col-sm-2 col-form-label">orderID</label>
                  <div class="col-sm-10">
                    <input id="orderID" readonly class="form-control" type="text" name="orderID" value="<?php echo($orderID); ?>"/>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="deliveryAddress" class="col-sm-2 col-form-label">deliveryAddress</label>
                  <div class="col-sm-10">
                    <textarea id="deliveryAddress" rows="3" class="form-control" type="text" name="deliveryAddress" required="required" placeholder="description"><?php echo($deliveryAddress);?></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="deliveryDate" class="col-sm-2 col-form-label">deliveryDate</label>
                  <div class="col-sm-10">
                    <input id="deliveryDate" class="form-control" type="date" name="deliveryDate" value="<?php echo($deliveryDate); ?>"required="required" />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10" id="update">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                  <div class="col-sm-2">
                    <button type="reset" class="btn btn-warning">Reset</button>
                  </div>
                </div>

                </from>

            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</body>

</html>