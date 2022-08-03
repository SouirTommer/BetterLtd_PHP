<?php

session_start();
require_once("../connection/mysqli_conn.php");

$sql = "SELECT orderID FROM orders";
$rs = mysqli_query($conn, $sql);
$maxorder = 0;


$sql = "SELECT MAX(orderID) as maxorderid FROM orders ";
$rs = mysqli_query($conn, $sql) or die(mysqli_error($conn));

while ($row = $rs->fetch_assoc()) {
    $maxorder = $row['maxorderid'];
    $maxorder += 1;
}

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
                <a href="index.php" onclick="clearcart()"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                <a href="#"><i class="fa-solid fa-address-card"></i></a>
            </div>
        </div>



        <div class="main_content">
            <div class="topbar">
                <div class="col-md-1">View Shopping Cart</div>
                <div style="padding:10px;">
                </div>
                <div class="col-md-1">
                    <label for="oid">Order ID</label>
                    <input class="form-control" id="oid" type="text" disabled value=<?php echo $maxorder ?>>
                </div>
                <div style="padding:10px;">
                </div>
                <div class="col-md-1">
                    <label for="totalp">Total Price</label>
                    <input class="form-control" id="totalp" type="text" disabled>
                </div>
                <div style="padding:10px;">
                </div>
                <div class="col-md-1">
                    <label for="discountp">Discount Price<Price</label>
                    <input class="form-control" id="discountp" type="text" disabled>
                </div>
                <div style="padding:20px;">
                </div>
                <div class="input-group mb-1">
                    <input type="text" id="cusemail" class="form-control" placeholder="Customer Email" aria-label="Item ID" aria-describedby="button-addon2">
                    <button class="btn btn-secondary" disabled type="" id="button-addon2"> <i class="fa-solid fa-envelope"></i></button>
                </div>


                <div class="col-md-1">
                    <button class="btn btn-success" type="button" onclick="btnsubmit()" id="button-addon2">Submit</button>
                </div>

                <div class="col-md-1">
                    <a href="./staff_product.php"><button type="button" class="btn btn-primary"> Back</button></a>
                </div>


            </div>
            <div class="topbar">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="enabledelivery()">
                    <label class="form-check-label" for="flexCheckDefault">
                        Delivery
                    </label>
                </div>
                <div style="padding:10px;">
                </div>
                <div class="col-md-5">
                    <textarea id="deliveryAddress" rows="1" class="form-control" type="text" name="deliveryAddress" required="required" placeholder="delivery Address" disabled></textarea>
                </div>
                <div style="padding:10px;">
                </div>
                <div class="col-md-3">
                    <input id="deliveryDate" class="form-control" type="date" name="deliveryDate" value="" required="required" disabled />
                </div>

            </div>

            <div class="box_tble">
                <div class="custom-table">
                    <form>
                        <table id="table">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Itemv Name</th>
                                    <th>Unit price</th>
                                    <th>qty</th>
                                </tr>
                            </thead>
                            <tbody id=tb>

                            </tbody>
                        </table>

                    </form>

                </div>
            </div>

            <div class="col-auto">
                <div>

                </div>

            </div>

        </div>

    </div>





</body>
<script>
    populatecart();

    function populatecart() {
        var items = JSON.parse(localStorage.getItem('cart'));

        console.log(items);

        var t = "";
        for (var i = 0; i < items.length; i++) {
            var tr = "<tr" + " id=" + "tr" + i + ">";
            tr += "<td name='itemid'>" + items[i]['itemid'] + "</td>";
            tr += "<td name='itemname'>" + items[i]['name'] + "</td>";
            tr += "<td name='itemunitprice'><input type=\"number\" id=\"" + "up" + i + "\" value=\"" + items[i]['price'] + "\" disabled></td>";
            tr += "<td name='itemqty'><input type=\"number\" onchange=\"updateprice(" + i + ")\" id=\"" + "price" + i + "\" min=\"1\" value =\"1\" ></td>";
            tr += "<td name='itemprice'><input type=\"number\" id=\"" + "total" + i + "\" value=\"" + items[i]['price'] + "\" disabled></td>";
            tr += "<td><div class=\"btn\" name=\"add\" onClick=\"remove(" + i + ")\"><i class=\"fa-solid fa-trash-can\"></i></div></td>";
            tr += "</tr>";
            t += tr;
            console.log(i);
        }
        document.getElementById('tb').innerHTML += t;


    }

    function remove(id) {
        document.getElementById("tr" + id).remove();

        var cartitem = JSON.parse(localStorage.getItem('cart'));
        cartitem.splice(id, 1);

        console.log(cartitem);

        localStorage.setItem('cart', JSON.stringify(cartitem));

        var length = JSON.parse(localStorage.getItem('cart'));
        if (length.length == 0) {
            localStorage.removeItem('cart');
        }
        $('#totalp').val(0);
        $('td[name=itemprice]').each(function(idx, item) {
            $('#totalp').val(parseInt($('#totalp').val()) + parseInt(item.querySelectorAll('input')[0].value));
        })
        // var mystring =JSON.stringify(cartitem);
        // localStorage.setItem('cart',cartitem);
        // console.log(cartitem);
        location.reload();
    }

    function updateprice(row) {
        var count = document.getElementById("price" + row).value;
        var price = document.getElementById("up" + row).value;
        document.getElementById("total" + row).value = price * count;
        $('#totalp').val(0);
        $('td[name=itemprice]').each(function(idx, item) {
            $('#totalp').val(parseInt($('#totalp').val()) + parseInt(item.querySelectorAll('input')[0].value));
        })
        discountapi();
    }

    function iterate() {
        for (let [i, row] of [...table.rows].entries()) {
            for (let [j, cell] of [...row.cells].entries()) {
                console.log(`[${i},${j}] = ${cell.innerText}`)
            }
        }
        // $('#mytab1 tr').each(function() {
        //     $(this).find('td').each(function() {
        //         //do your stuff, you can use $(this) to get current cell
        //     })
        // })
    }

    var rowCount;
    $(document).ready(function() {

        rowCount = $("#table tr").length;
        $('#totalp').val(0);
        $('td[name=itemprice]').each(function(idx, item) {
            $('#totalp').val(parseInt($('#totalp').val()) + parseInt(item.querySelectorAll('input')[0].value));
        })
    })

    function btnsubmit() {
        if(checkinput()==false){
            return;
        };

        var submitable = true;
        $("td[name='itemqty'] input").each(function(idx, itemqty) {
            if (itemqty.value == "") {
                alert('Please input qty');
                submitable = false;
            }
        });
        if (submitable) {
            var data = [];
            $('tbody tr').each(function(idx, item) {
                console.log(item.querySelectorAll("[name='itemid']")[0].innerText);
                data.push({
                    "deliveryAddress": document.getElementById("deliveryAddress").value,
                    "deliveryDate": document.getElementById("deliveryDate").value, 
                    "totalprice": document.getElementById("discountp").value,
                    "cusemail": document.getElementById("cusemail").value,
                    "orderid": document.getElementById("oid").value,
                    "itemid": item.querySelectorAll("[name='itemid']")[0].innerText,
                    "itemname": item.querySelectorAll("[name='itemname']")[0].innerText,
                    "itemunitprice": item.querySelectorAll("[name='itemunitprice'] input")[0].value,
                    "itemqty": item.querySelectorAll("[name='itemqty'] input")[0].value,
                    "itemprice": item.querySelectorAll("[name='itemprice'] input")[0].value

                })
            });
            $.ajax({
                type: "POST",
                url: 'Action/submit_order.php',
                data: {
                    "data": JSON.stringify(data)
                },
                success: function(data) {
                    if (data == 'emailfail') {
                        alert("Email does not exist");
                        return;
                    } else if (localStorage.getItem('cart')) {
                        console.log(data);
                        localStorage.removeItem('cart');
                        alert("Order Create Success");
                        window.location.replace("./staff_order.php");
                    } else {
                        alert("please add item into the cart")
                    }

                }
            });
        }
    }

    function clearcart() {
        localStorage.removeItem('cart');
    }


    function discountapi() {
        var url = "http://127.0.0.1:3000/api/discountcaculator/";
        var old_price = document.getElementById("totalp").value;
        url += old_price;
        $.ajax({
            type: "GET",
            url: url,
            data: old_price,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                document.getElementById("discountp").value = data;
            },
            error: function(data) {
                alert('Cannot connect to API');
                document.location = 'staff_product.php'; 
            },
        });
    }
    updateprice(0);

    async function enabledelivery(){
        document.getElementById('deliveryAddress').value = "";
        document.getElementById('deliveryDate').value = "";
        var flag = document.getElementById('flexCheckDefault').checked;
        if(flag){
            document.getElementById('deliveryAddress').disabled = false;
            document.getElementById('deliveryDate').disabled = false;
        }else{
            document.getElementById('deliveryAddress').disabled = true;
            document.getElementById('deliveryDate').disabled = true;
        }
        

    }

    function checkinput(){
        var flag = document.getElementById('flexCheckDefault').checked;
        if(flag){
            var add = document.getElementById('deliveryAddress').value;
            var date = document.getElementById('deliveryDate').value;
            if(add !="" && date !=""){
                console.log("ok");
            }else{
                alert("Please Enter Delivery information");
                return false;
            }
        }
    }
</script>

</html>