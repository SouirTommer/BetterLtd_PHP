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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Better Limited Retail Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/a178411011.js" crossorigin="anonymous"></script>
</head>

<body>

  <div class="wrapper">
    <div id="red" class="sidebar" >
      <a href="manager_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li style="background: rgba(255,255,255, 0.3);"><a href="manager_menu.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="manager_product.php"><i class="fa-solid fa-receipt"></i> Product</a></li>
        <li><a href="manager_customer.php"><i class="fa-solid fa-file-invoice"></i> Customer</a></li>
        <li><a href="manager_Report.php"><i class="fa-solid fa-file-invoice"></i> Report</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">
        <div class="header">Home</div>
      </div>
    </div>

    
  </div>

</body>

</html>