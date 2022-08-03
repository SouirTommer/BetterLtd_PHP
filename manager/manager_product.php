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
    function setValue(itemID, itemName, itemDescription, stockQuantity, price){
      document.getElementById("itemID").value=itemID;
      document.getElementById("itemName").value=itemName;
      document.getElementById("itemDescription").value=itemDescription;
      document.getElementById("stockQuantity").value=stockQuantity;
      document.getElementById("price").value=price;
      document.forms[0].submit();
    }
    

    function searchfun() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search");
      filter = input.value.toUpperCase();
      table = document.getElementById("table");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
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

    $sql = "SELECT * FROM item";
    $rs = mysqli_query($conn, $sql);
  ?>

  <div class="wrapper">
    <div id="red" class="sidebar" >
      <a href="manager_menu.php"><h2>Better.ltd</h2></a>
      <ul>
        <li style="background: rgba(255,255,255, 0.3);"><a href="manager_product.php"><i class="fa-solid fa-receipt"></i> Product</a></li>
        <li><a href="manager_customer.php"><i class="fa-solid fa-file-invoice"></i> Customer</a></li>
        <li><a href="manager_Report.php"><i class="fa-solid fa-file-invoice"></i> Report</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
    <div class="main_content">
      <div class="topbar">
        <div class="header">Product</div>
        
        <div class="input-group mb-4">
          <input type="text" id="search" class="form-control" placeholder="Item ID" aria-label="Item ID" aria-describedby="button-addon2">
          <button class="btn btn-secondary" onClick="searchfun()" type="button" id="button-addon2">Search</button>
        </div>
        <div class="col-md-1">
        <a href="add_product.php"><button type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Insert</button></a>
        </div>
        
      </div>
      <div class="box_table">

        <div class="custom-table">
          <form action="modify_product.php"  method="post">
          <table id="table">
            <thead>
              <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Item Description</th>
                <th>Stock Quantity</th>
                <th>Price</th>
                <th>Modify</th>
              </tr>
            </thead>
            <tbody>

            <?php
              while ($rc = mysqli_fetch_assoc($rs)) {
              ?>
                <tr>
                  <td><?php echo $rc['itemID'] ?></td>
                  <td><?php echo $rc['itemName'] ?></td>
                  <td><?php echo $rc['itemDescription'] ?></td>
                  <td><?php echo $rc['stockQuantity'] ?></td>
                  <td><?php echo $rc['price'] ?></td>

                  <?php 
                  $name = str_replace('"', "“", $rc['itemName']);
                  $description = str_replace('"', "“", $rc['itemDescription']);
                  ?>
                  
                  <th><button class="btn" name="edit" onClick="
                  setValue(<?php echo $rc['itemID']?>,<?php echo (" '$name' "); ?>,<?php echo (" '$description' ");?>,<?php echo $rc['stockQuantity']?>, <?php echo $rc['price']?>)">
                   <i class="fa-solid fa-clipboard-list"></i></button></th>
                </tr>
                <?php
                }
                

                mysqli_free_result($rs);
                mysqli_close($conn);
                ?>

            </tbody>
          </table>
          <input type="hidden" id="itemID" name="itemID" value=""/>
          <input type="hidden" id="itemName" name="itemName" value=""/>
          <input type="hidden" id="itemDescription" name="itemDescription" value=""/>
          <input type="hidden" id="stockQuantity" name="stockQuantity" value=""/>
          <input type="hidden" id="price" name="price" value=""/>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>