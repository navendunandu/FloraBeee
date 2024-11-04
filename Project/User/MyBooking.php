<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
session_start();
$selcart="select * from tbl_booking b inner join tbl_cart c on b.booking_id=c.booking_id inner join tbl_product p on p.product_id=c.product_id where booking_status=2 and user_id=".$_SESSION['uid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: #b2b2b2; /* White background */
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
            color: white; /* White text for links */
        }

        a:hover {
            color: #ddd; /* Slightly lighter on hover */
        }
    </style>
<title>MyBooking</title>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <th>SlNo</th>
                        <th>Photo</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $resultcart = $Con->query($selcart);
                    $i = 0;
                    while ($datacart = $resultcart->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../Assets/Files/Seller/Product/<?php echo $datacart['product_photo']; ?>" alt="Product Photo"></td>
                            <td><?php echo $datacart['product_name']; ?></td>
                            <td><?php echo $datacart['booking_amt']; ?></td>
                            <td><?php echo $datacart['cart_qty']; ?></td>
                            <td><?php echo $datacart['booking_amt'] * $datacart['cart_qty']; ?></td>
                            <td>
                                <?php
                                if ($datacart['cart_status'] == 1) {
                                    echo "Item has not packed";
                                } else if ($datacart['cart_status'] == 2) {
                                    echo "Item Packed, Ready for shipping";
                                } else if ($datacart['cart_status'] == 3) {
                                    echo "Item has been Shipped";
                                } else if ($datacart['cart_status'] == 4) {
                                    echo "Item Delivery completed";
                                }
                                ?>
                            </td>
                            <td><a href="PostComplaint.php?pid=<?php echo $datacart['product_id']; ?>" class="btn btn-primary">Complaint</a></td>
                            <td><a href="Rating.php?pid=<?php echo $datacart['product_id']; ?>" class="btn btn-primary">Rating</a></td>
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