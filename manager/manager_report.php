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
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Better Limited Retail Web App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../css/styles.css" />
    <script
      src="https://kit.fontawesome.com/a178411011.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body>
    <div class="wrapper">
      <div id="red" class="sidebar">
        <a href="manager_menu.php"><h2>Better.ltd</h2></a>
        <ul>
          <li>
            <a href="manager_product.php"
              ><i class="fa-solid fa-receipt"></i> Product</a
            >
          </li>
          <li>
            <a href="manager_customer.php"
              ><i class="fa-solid fa-file-invoice"></i> Customer</a
            >
          </li>
          <li style="background: rgba(255, 255, 255, 0.3)">
            <a href="manager_report.php"
              ><i class="fa-solid fa-file-invoice"></i> Report</a
            >
          </li>
        </ul>
        <div class="sidebar_bottom">
          <a href="../index.php"
            ><i class="fa-solid fa-arrow-right-from-bracket"></i
          ></a>
        </div>
      </div>
      <div class="main_content">
        <div class="topbar">
          <div class="header">Report</div>
        </div>
        <section id="report">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h3>Generate monthly report</h3>
                <form action="report_detail.php" method="post">
                <select name="month" id="month-select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                  <option selected value="1">Select month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
                <div class="text-center">
                <p><button type="submit" class="btn btn-primary">Generate</button></p>
                </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </body>
</html>
