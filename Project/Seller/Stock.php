<?php
ob_start();
include("Head.php");
?>

<?php

include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_submit"]))

{

	$pid=$_GET["pid"];
	$stock=$_POST["txt_stock"];
	$insQry="insert into tbl_stock(stock_qty,stock_date,product_id)values('$stock',curdate(),'$pid')";
if($Con->query($insQry))
	  {
		  ?>
	<script>
				//alert("Inserted");
				//window.location="Stock.php";
				</script>
    <?php
	  }
	  else
	  {
		  echo "Error";
	  }
  }
  
 if(isset($_GET["delID"]))
 {
	 $StockID=$_GET["delID"];
	 $delQry="delete from tbl_stock where stock_id=$StockID";
	 if($Con->query($delQry))
 
{
?>
	<script>
				alert("Deleted");
				window.location="Stock.php";
	</script>
 <?php     
 }
	  else
	  {
		  echo "Error";
	  }	 
 }
	  
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: white; /* White background */
        }

        .stock-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .stock-container label {
            color: white; /* White text for labels */
        }

        .stock-container input[type="text"] {
            background-color: #333; /* Dark background for input */
            color: white; /* White text for input */
            border: 1px solid #555; /* Dark border */
        }

        .stock-container input[type="submit"] {
            background-color: #c49b63; /* Bootstrap primary color */
            border: none; /* Remove border */
            color: white; /* White text for button */
        }

        .stock-container input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .stock-table {
            margin-top: 20px; /* Space between form and table */
            color: white; /* White text for table */
        }

        .stock-table th, .stock-table td {
            color: white; /* White text in table headers and cells */
        }

        a {
            color: #c49b63; /* Blue text for links */
        }

        a:hover {
            color: #0056b3; /* Darker shade on hover */
        }
        
    </style>
<title>Stock</title>
</head>

<body>
    <div class="container mt-5">
        <div class="stock-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <td><label for="txt_stock">Stock Quantity</label></td>
                        <td><input type="text" name="txt_stock" id="txt_stock" class="form-control" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
                        </td>
                    </tr>
                </table>
            </form>
            <table class="table table-bordered stock-table">
                <tr>
                    <th>Sl No</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                <?php
                    $selQry = "SELECT * FROM tbl_stock WHERE product_id=" . $_GET['pid'];
                    $result = $Con->query($selQry);
                    $i = 0;
                    $total = 0;
                    while ($data = $result->fetch_assoc()) {
                        $i++;
                        $total+=(int)$data['stock_qty'];
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['stock_date']; ?></td>
                    <td><?php echo $data['stock_qty']; ?></td>
                    <td><a href="Stock.php?delID=<?php echo $data['stock_id']; ?>">Delete</a></td>
                </tr>
                <?php
                    }
                    $id =  $_GET['pid'];
        
                    // Get total cart quantity
                    $cart = "SELECT SUM(cart_qty) AS cart_total FROM tbl_cart WHERE product_id = '$id'";
                    $cresult = $Con->query($cart);
                    $cdata = $cresult->fetch_assoc();
            
                    // Get total stock quantity
                    $Stock = "SELECT SUM(stock_qty) AS total_stock FROM tbl_stock WHERE product_id = '$id'";
                    $sresult = $Con->query($Stock);
                    $sdata = $sresult->fetch_assoc();
                    
                    $rem = $sdata['total_stock'] - $cdata['cart_total'];
                ?>
                 <tr>
                 <td colspan="2" align="right" style="font-size: 2em; padding: 10px;">Total</td>

                    <td ><?php echo $total; ?></td>
                    
                </tr>
                <tr>
                 <td colspan="2" align="right" style="font-size: 2em; padding: 10px;">Remaining</td>

                    <td ><?php echo $rem; ?></td>
                    
                </tr>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>