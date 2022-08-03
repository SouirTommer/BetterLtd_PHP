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
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Better Limited Retail Web App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link rel="stylesheet" href="../css/styles.css">
  <script src="https://kit.fontawesome.com/a178411011.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>

  <?php
  require_once("../connection/mysqli_conn.php");

  $sql = "SELECT * FROM item WHERE stockQuantity >0";
  $rs = mysqli_query($conn, $sql);
  ?>


  <div class="wrapper">

    <div class="sidebar">
      <a href="staff_menu.php">
        <h2>Better.ltd</h2>
      </a>
      <ul>
        <li style="background: rgba(255,255,255, 0.3);"><a href="staff_product.php"><i class="fa-solid fa-receipt"></i> Sales Product</a></li>
        <li><a href="staff_order.php"><i class="fa-solid fa-file-invoice"></i> Order Record</a></li>

      </ul>
      <div class="sidebar_bottom">
        <a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>



    <div class="main_content">
      <div class="topbar">
        <div class="header">Create Order</div>

        <div class="input-group mb-3">

          <input type="text" id="search" class="form-control" placeholder="Item ID" aria-label="Item ID" aria-describedby="button-addon2" />

          <button class="btn btn-secondary" onClick="searchfun()" type="button" id="button-addon2">Search</button>
        </div>
        <div class="col-md-1">
          <a href="viewcart.php"><button type="button" class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i> Cart</button></a>
        </div>

      </div>

      <div class="box_tble">
        <div class="custom-table">
          <form>
            <table id="table">
              <thead>

                <tr>
                  <th>Item ID</th>
                  <th>Item Name</th>
                  <th>Item Description</th>
                  <th>Stock Quantity</th>
                  <th>Price</th>
                  <th>Add</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($rc = mysqli_fetch_assoc($rs)) {
                ?>
                  <tr id="tr<?php echo $rc['itemID'] ?>">
                    <td><input type="hidden" name="itemID" value="<?php echo $rc['itemID'] ?>"><?php echo $rc['itemID'] ?></td>
                    <td><input type="hidden" name="itemName" value="<?php echo $rc['itemName'] ?>"><?php echo $rc['itemName'] ?></td>
                    <td><input type="hidden" name="desc" value="<?php echo $rc['itemDescription'] ?>"><?php echo $rc['itemDescription'] ?></td>
                    <td><input type="hidden" name="qty" value="<?php echo $rc['stockQuantity'] ?>"><?php echo $rc['stockQuantity'] ?></td>
                    <td><input type="hidden" name="price" value="<?php echo $rc['price'] ?>"><?php echo $rc['price'] ?></td>
                    <td>
                      <div class="btn" name="add" onClick="btnsubmit(<?php echo $rc['itemID'] ?>)"><i class="fa-solid fa-cart-plus"></i></div>
                    </td>
                  </tr>

                <?php
                }
                mysqli_free_result($rs);
                mysqli_close($conn);
                ?>
              </tbody>
            </table>

          </form>

        </div>
      </div>

    </div>

  </div>





</body>
<script>
  /*function setValue(itemID) {
      document.getElementById("itemID").value = itemID;
      console.log('itemID')
      document.forms[0].submit();
    }*/

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
  function btnsubmit(clickdata) {
    $.ajax({
      type: "POST",
      url: 'Action/add_cart.php',
      data: {
        "itemID": $("#tr" + clickdata + " [name='itemID']").val(),
        "itemName": $("#tr" + clickdata + " [name='itemName']").val(),
        "price": $("#tr" + clickdata + " [name='price']").val()
      },
      success: function(data) {
        if (localStorage.getItem('cart')) {
          var cartitem = localStorage.getItem('cart');
          if (cartitem.match(data)) {
            alert("You have already added this itme");
            return;
          } else {
            JSON.parse(cartitem);
            localStorage.setItem('cart', cartitem.substr(0, cartitem.length - 1) + ',' + data + "]");
          }
        } else {
          localStorage.setItem('cart', "[" + data + "]");
        }
        alert("You added item " + data);
      }
    });
  }



</script>

</html>