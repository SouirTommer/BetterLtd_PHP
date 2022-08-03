<?php
session_start();

if ($_SESSION['authenticated'] != true) {
  echo "<script type='text/javascript'> 
      document.location = '../index.php'; 
      </script>";
  exit;
}
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
    <div id="red" class="sidebar">
      <a href="manager_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li style="background: rgba(255, 255, 255, 0.3)">
          <a href="manager_product.php"><i class="fa-solid fa-receipt"></i> Product</a>
        </li>
        <li>
          <a href="manager_customer.php"><i class="fa-solid fa-file-invoice"></i> Customer</a>
        </li>
        <li>
          <a href="manager_Report.php"><i class="fa-solid fa-file-invoice"></i> Report</a>
        </li>
      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">
        <a href="manager_product.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</button></a>
        <div class="header" style="padding: 6px 14px;">Add product</div>

      </div>
      <section id="add-prod">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-12">
              <h3>Add product item</h3>
              <form action="Action/new_product_action.php" method="post">

                <div class="form-group row">
                  <label for="itemName" class="col-sm-2 col-form-label">Item name</label>
                  <div class="col-sm-10">
                    <input id="itemName" class="form-control" type="text" name="itemName" required="required" placeholder="name" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="itemDescription" class="col-sm-2 col-form-label">Item description</label>
                  <div class="col-sm-10">
                    <textarea id="itemDescription" rows="3" class="form-control" type="text" name="itemDescription" required="required" placeholder="description"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="stockQuantity" class="col-sm-2 col-form-label">Stock quantity</label>

                  <div class="col-sm-10">
                    <input id="stockQuantity" class="form-control" type="number" min="0" max="900" name="stockQuantity" placeholder="qty" required="required" />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="price" class="col-sm-2 col-form-label">Price</label>

                  <div class="col-sm-10">
                    <input id="price" class="form-control" type="number" min="0.00" max="90000.00" step="0.01" name="price" placeholder="price" required="required" />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-10" id="insert">
                    <button type="submit" class="btn btn-primary">Insert</button>
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