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


<script>
    function setValue(email){
      document.getElementById("customerEmail").value=email;
      document.forms[0].submit();
    }

    
    function confirm_del(cust_email){
      var c = confirm("Are you sure you want to delete customerEmail " + cust_email+ " ?");
      if ( c == true) {
        
        setValue(cust_email);

      } else if ( c == false){

        alert("Cancelled!");
        return false;
      }
    }

    function searchfun() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("table");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    </script>

</head>

<body>

  <?php 
    require_once("../connection/mysqli_conn.php");

    $sql = "SELECT * FROM customer";
    $rs = mysqli_query($conn, $sql);
  ?>

  <div class="wrapper">
    <div id="red" class="sidebar" >
      <a href="manager_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li><a href="manager_product.php"><i class="fa-solid fa-receipt"></i> Product</a></li>
        <li style="background: rgba(255,255,255, 0.3);"><a href="manager_customer.php"><i class="fa-solid fa-file-invoice"></i> Customer</a></li>
        <li><a href="manager_Report.php"><i class="fa-solid fa-file-invoice"></i> Report</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">
        <div class="header">Customer</div>
        
        <div class="input-group mb-4">
          <input type="text" id="search" class="form-control" placeholder="Customer's email" aria-label="Customer's email" aria-describedby="button-addon2">
          <button class="btn btn-secondary" onClick="searchfun()" type="button" id="button-addon2">Search</button>
        </div>
        
      </div>
      <div class="box_table">
       <form action="Action/del_cust.php" method="post">
        <div class="custom-table">
          <table id="table">
            <thead>
              <tr>
                <th>Customer Email</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              
            <?php
              while ($rc = mysqli_fetch_assoc($rs)) {
              ?>
                <tr>
                  <td><?php echo $rc['customerEmail'] ?></td>
                  <td><?php echo $rc['customerName'] ?></td>
                  <td><?php echo $rc['phoneNumber'] ?></td>
                  <td><button class="btn" onClick="return confirm_del('<?php echo $rc['customerEmail']?>');"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>

                <?php
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
                ?>
            </tbody>
          </table>
          <input type="hidden" id="customerEmail" name="customerEmail" value=""/>
        </div>
       </form>
      </div>
    </div>
  </div>

</body>

</html>