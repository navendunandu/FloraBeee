<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
$selQry="select MAX(booking_id) as id from tbl_booking where booking_status='0'";
	  $res=$Con->query($selQry);
	  if($data=$res->fetch_assoc()){
	  $bid=$data["id"];
	  }
	if(isset($_GET["delID"]))
	{
		$cartID=$_GET["delID"];
		$delQry="delete from tbl_cart where cart_id=$cartID";
		
		if($Con-> query($delQry))
		{
			?>
            <script>
				alert("Deleted");
				window.location="MyCart.php";
			</script>
			<?php
			
		}
		else
		{
			echo "Error";
		}
		
	}
	if(isset($_POST["btncheckout"]))
	{
		$total=$_POST["txt_total"];
		
	$upQry=" update tbl_booking set booking_status ='1', booking_amt='$total' where booking_id='$bid' ";
	if($Con->query($upQry))
	{
		$updateQry=" update tbl_cart set cart_status ='1' where booking_id='$bid' ";
		if($Con->query($updateQry))
		{
		header("location:paymentgateway.php");
		}
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

        .profile-container {
            background-color: #32383e; /* Grey background for the table */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .profile-container table {
            width: 100%; /* Ensure the table takes up full width */
            border-collapse: collapse; /* Ensure there is no space between borders */
        }

        .profile-container th, .profile-container td {
            padding: 10px; /* Add some padding to the table cells */
            text-align: left; /* Align text to the left */
            color: white; /* White text in table cells */
            border-bottom: 1px solid #ddd; /* Add a light bottom border */
        }

        .profile-container img {
            width: 100px; /* Set product photo width */
            height: auto; /* Auto height based on width */
        }

        a {
            color: #c49b63; /* White text for links */
        }

        a:hover {
            color: #ddd; /* Slightly lighter on hover */
        }

        input[type="number"] {
            width: 60px; /* Set width for quantity input */
            padding: 5px; /* Add some padding */
        }

        input[type="submit"] {
            background-color: #c49b63; /* Bootstrap primary color */
            color: white; /* White text */
            border: none; /* No border */
            padding: 10px 20px; /* Add padding */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
<title>My Cart</title>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <th>Sl.No</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Message</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (isset($bid)) {
                        $selQry = "SELECT * FROM tbl_cart c INNER JOIN tbl_product p ON c.product_id = p.product_id WHERE booking_id = " . $bid;
                        $result = $Con->query($selQry);
                        $i = 0;
                        $checkout = 0;
                        while ($data = $result->fetch_assoc()) {
                            $total_price = intval($data['cart_qty']) * intval($data['product_price']);
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><img src="../Assets/Files/Seller/Product/<?php echo $data['product_photo']; ?>" alt="Product Photo"></td>
                                <td><?php echo $data['product_name']; ?></td>
                                <td>
                                    <input type="number" value="<?php echo $data['cart_qty']; ?>" onChange="cart(this.value, '<?php echo $data['cart_id']; ?>')" />
                                </td>
                                <td><?php echo $data['product_price']; ?></td>
                                <td>
                                    <?php 
                                    if ($data['cart_msg'] == "") {
                                    ?>
                                        <a href="AddMsg.php?pid=<?php echo $data['cart_id']; ?>">Add Message</a>
                                    <?php
                                    } else {
                                        echo $data['cart_msg'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $total_price; ?></td>
                                <td><a href="MyCart.php?delID=<?php echo $data['cart_id']; ?>">DELETE</a></td>
                            </tr>
                    <?php
                            $checkout += $total_price;
                        }
                    ?>
                        <tr>
                            <td><input type="hidden" name="txt_total" value="<?php echo $checkout; ?>" />Checkout Price</td>
                            <td colspan='5'>
                                <?php 
                                echo $checkout; 
                                ?>
                            </td>
                            <td>
                                <input type="submit" value="Check Out" name="btncheckout" />
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
function cart(qty,cid){
    $.ajax({
        url: '../Assets/AjaxPages/AjaxCart.php?qty=' + qty +"&cid="+cid,
        success: function(res) {
			console.log(res)
			window.location="MyCart.php"
        }
    });
}

</script>
</html>

<?php
include("Foot.php");
ob_start();
?>