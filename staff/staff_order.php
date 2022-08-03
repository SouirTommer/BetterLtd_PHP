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

  <script>
    function setValue(orderID){
      document.getElementById("orderID").value=orderID;
      document.forms[0].submit();
    }

    function updateValue(orderID, deliveryAddress, deliveryDate){
      document.getElementById("orderID").value=orderID;
      document.getElementById("deliveryAddress").value=deliveryAddress;
      document.getElementById("deliveryDate").value=deliveryDate;
      document.forms[0].submit();
    }

    function confirm_del(orderID){
      var c = confirm("Are you sure you want to delete orderID " +orderID+" ?");
      if ( c == true) {
        
        setValue(orderID);

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

  $sql = "SELECT orders.*, customer.customerName, customer.phoneNumber, staff.staffName FROM orders
    LEFT JOIN customer ON orders.customerEmail = customer.customerEmail
    LEFT JOIN staff ON orders.staffID = staff.staffID;";
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
        <div class="header">Order record</div>
        
        <div class="input-group mb-4">
          <input type="text" id="search" class="form-control" placeholder="Customer's email" aria-label="Customer's email" aria-describedby="button-addon2">
          <button class="btn btn-secondary" onClick="searchfun()" type="button" id="button-addon2">Search</button>
        </div>


      </div>
      <div class="box_table">
        
      <form action="Action/handle_order.php" method="post">
        <div class="custom-table">
          <table id="table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>CustomerEmail</th>
                <th>CustomerName</th>
                <th>phoneNumber</th>
                <th>Staff ID</th>
                <th>Staff Name</th>
                <th>DateTime</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Total price</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>

            <?php
              while ($rc = mysqli_fetch_assoc($rs)) {
              ?>
                <tr>
                  <td><?php echo $rc['orderID'] ?></td>
                  <td><?php echo $rc['customerEmail'] ?></td>
                  <td><?php echo $rc['customerName'] ?></td>
                  <td><?php echo $rc['phoneNumber'] ?></td>
                  <td><?php echo $rc['staffID'] ?></td>
                  <td><?php echo $rc['staffName'] ?></td>
                  <td><?php echo $rc['dateTime'] ?></td>
                  <td><?php echo $rc['deliveryAddress'] ?></td>
                  <td><?php echo $rc['deliveryDate'] ?></td>
                  <td><?php echo $rc['totalPrice'] ?></td>
                  
                  <?php 
                  $deliveryAddress = str_replace('"', "“", $rc['deliveryAddress']);
                  $deliveryDate = $rc['deliveryDate'];
                  ?>

                  <td class="btn_th"><button class="btn" value="view" name="act" onClick="setValue(<?php echo $rc['orderID']?>)"><i class="fa-solid fa-eye"></i></button></td>
                  <td class="btn_th"><button class="btn" value="update" name="act" onClick="updateValue(<?php echo $rc['orderID']?>, <?php echo (" '$deliveryAddress' ");?>, <?php echo (" '$deliveryDate' ");?>)"><i class="fa-solid fa-truck"></i></button></td>
                  <td class="btn_th"><button class="btn" value="delete" name="act" onClick="return confirm_del('<?php echo $rc['orderID']?>');"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>

                <?php
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
              ?>

            </tbody>
          </table>
          <input type="hidden" id="orderID" name="orderID" value=""/>
          <input type="hidden" id="deliveryAddress" name="deliveryAddress" value=""/>
          <input type="hidden" id="deliveryDate" name="deliveryDate" value=""/>
        </div>
        </form>
      </div>
      
    </div>
  </div>

</body>

</html>