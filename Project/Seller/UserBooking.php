<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_GET['id'])){
	$updQry="update tbl_cart set cart_status=".$_GET['st']." where cart_id=".$_GET['id'];
	if($Con->query($updQry)){
		?>
        <script>
		alert('Updated');
		window.location='UserBooking.php'
		</script>	
        <?php
	}
	else{
		?>
        <script>
		alert('Failed');
		window.location='UserBooking.php'
		</script>	
        <?php
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

        .cart-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .cart-container th, .cart-container td {
            color: white; /* White text for table headers and cells */
        }

        .cart-container img {
            width: 100px; /* Consistent image size */
            height: 100px;
        }

        a {
            color: #c49b63; /* Blue text for links */
        }

        a:hover {
            color: #0056b3; /* Darker shade on hover */
        }
    </style>
<title>Untitled Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="cart-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl No</th>
                        <th>Photo</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Message</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $selQry = "SELECT * FROM tbl_cart c 
                                INNER JOIN tbl_product p ON c.product_id = p.product_id 
                                INNER JOIN tbl_booking b ON c.booking_id = b.booking_id 
                                WHERE booking_status = '2' AND seller_id = " . $_SESSION['sid'];
                    $result = $Con->query($selQry);
                    $i = 0;
                    while ($data = $result->fetch_assoc()) {
                        $total_price = $data['cart_qty'] * $data['product_price'];
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><img src="../Assets/Files/Seller/Product/<?php echo $data['product_photo']; ?>" alt="<?php echo $data['product_name']; ?>"></td>
                        <td><?php echo $data['product_name']; ?></td>
                        <td><?php echo $data['product_price']; ?></td>
                        <td><?php echo $data['cart_qty']; ?></td>
                        <td><?php echo $data['cart_msg']; ?></td>
                        <td><?php echo $total_price; ?></td>
                        <td>
                            <?php
                            switch ($data['cart_status']) {
                                case 1:
                                    echo "New Order";
                                    break;
                                case 2:
                                    echo "Item Packed";
                                    break;
                                case 3:
                                    echo "Item Shipped";
                                    break;
                                case 4:
                                    echo "Item Delivered";
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($data['cart_status'] == 1) {
                                ?><a href="UserBooking.php?st=2&id=<?php echo $data['cart_id'] ?>">Item Packed</a><?php
                            } elseif ($data['cart_status'] == 2) {
                                ?><a href="UserBooking.php?st=3&id=<?php echo $data['cart_id'] ?>">Shipped</a><?php
                            } elseif ($data['cart_status'] == 3) {
                                ?><a href="UserBooking.php?st=4&id=<?php echo $data['cart_id'] ?>">Delivered</a><?php
                            }
                            ?>
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
</html>


<?php
include("Foot.php");
ob_start();
?>