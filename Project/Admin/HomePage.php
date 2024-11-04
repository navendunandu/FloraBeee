<?php
ob_start();
include("Head.php");
?>
<style>
    body {
        background-color: #e5e5e5;
        color: white; /* Ensure the text is visible on the black background */
    }
</style>
<h2 class="main-title" style="color: #c49b63;">Dashboard</h2>
<div class="row stat-cards">
    <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
            <div class="stat-cards-icon primary">
                <i data-feather="bar-chart-2" aria-hidden="true"></i>
            </div>
            <div class="stat-cards-info">
                <p class="stat-cards-info__num">
                    <?php
                    $booking = "select sum(booking_amt) as sum from tbl_booking";
                    $result = $Con->query($booking);
                    $row = $result->fetch_assoc();
                    echo $row['sum'];
                    ?>
                </p>
                <p class="stat-cards-info__title">Total Sales</p>

            </div>
        </article>
    </div>
    <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
            <div class="stat-cards-icon warning">
                <i data-feather="file" aria-hidden="true"></i>
            </div>
            <div class="stat-cards-info">
                <p class="stat-cards-info__num">
                    <?php
                    $prd = "select count(*) as count from tbl_product";
                    $result = $Con->query($prd);
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </p>
                <p class="stat-cards-info__title">Total Products</p>

            </div>
        </article>
    </div>
    <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
            <div class="stat-cards-icon purple">
                <i data-feather="file" aria-hidden="true"></i>
            </div>
            <div class="stat-cards-info">
                <p class="stat-cards-info__num">
                    <?php
                    $prd = "select count(*) as count from tbl_userregistration";
                    $result = $Con->query($prd);
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </p>
                <p class="stat-cards-info__title">Total Users</p>

            </div>
        </article>
    </div>
    <div class="col-md-6 col-xl-3">
        <article class="stat-cards-item">
            <div class="stat-cards-icon success">
                <i data-feather="feather" aria-hidden="true"></i>
            </div>
            <div class="stat-cards-info">
                <p class="stat-cards-info__num">
                    <?php
                    $prd = "select count(*) as count from tbl_seller";
                    $result = $Con->query($prd);
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                    ?>
                </p>
                <p class="stat-cards-info__title">Total Sellers</p>

            </div>
        </article>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">

        <div class="users-table table-wrapper">
        <table class="table posts-table" style="color: white;">
    <thead>
    <tr class="users-table-info" style="color: #c49b63;">
    <th>Sl No</th>
    <th>Photo</th>
    <th>Product</th>
    <th>Amount</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Status</th>
</tr>

    </thead>
    <tbody>
        <?php
        $selcart = "SELECT * FROM tbl_booking b 
                     INNER JOIN tbl_cart c ON b.booking_id = c.booking_id 
                     INNER JOIN tbl_product p ON p.product_id = c.product_id 
                     WHERE booking_status = 2";
        $resultcart = $Con->query($selcart);
        $i = 0;
        while ($datacart = $resultcart->fetch_assoc()) {
            $i++;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <img src="../Assets/Files/Seller/Product/<?php echo $datacart['product_photo']; ?>" 
                         width="100" height="100" alt="<?php echo $datacart['product_name']; ?>" />
                </td>
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
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


        </div>
    </div>
</div>
<?php
include("Foot.php");
ob_flush();
?>
