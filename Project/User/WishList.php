<?php
ob_start();
include("Head.php");
include("../Assets/Connection/connection.php");
session_start();
if(isset($_GET["did"]))
	{
		$productID=$_GET["did"];
		$delQry="delete from tbl_wishlist where wishlist_id=$productID";
		if($Con-> query($delQry))
		{
	?>
		<script>
					alert("Deleted");
					window.location="Wishlist.php";
		</script>
	<?php
	
		}
	else
		{
			echo "Error";
		}
	}		
?>
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
    body {
        background-color: white; /* White background */
    }

    .product-table {
        background-color: #32383e; /* Grey background for the table */
        padding: 20px;
        border-radius: 10px;
        color: white; /* White text */
    }

    .product-table table {
        width: 100%; /* Full width for table */
        border-collapse: collapse; /* No space between borders */
    }

    .product-table th, .product-table td {
        padding: 10px; /* Padding for cells */
        text-align: left; /* Align text left */
        color: white; /* White text */
        border-bottom: 1px solid #ddd; /* Light bottom border */
    }

    .product-table img {
        width: 100px; /* Product image size */
        height: auto; /* Maintain aspect ratio */
    }

    a {
        color: #c49b63; /* White links */
    }

    a:hover {
        color: #ddd; /* Lighter color on hover */
    }

    input[type="submit"] {
        background-color: #007bff; /* Bootstrap primary color */
        color: white; /* White text */
        border: none; /* No border */
        padding: 10px 20px; /* Padding */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker on hover */
    }
</style>
<title>WishList</title>
</head>

<body>
    <div class="product-table">
        <table class="table table-borderless">
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Details</th>
                <th>Price</th>
                <th>Photo</th>
                <th>Occasion</th>
                <th>Type</th>
                <th>Colour</th>
                <th>Flower</th>
                <th>Action</th>
            </tr>
            <?php
            $selPrdct = "SELECT * FROM tbl_wishlist w inner join tbl_product p on w.product_id=p.product_id
                         INNER JOIN tbl_occassion o ON p.occassion_id = o.occassion_id 
                         INNER JOIN tbl_type t ON p.type_id=t.type_id 
                         INNER JOIN tbl_colour c ON p.colour_id=c.colour_id 
                         INNER JOIN tbl_flower f ON p.flower_id=f.flower_id 
                         WHERE user_id='".$_SESSION['uid']."'"; 
            $resultPrdct = $Con->query($selPrdct);
            $i = 0;
            while ($dataPrdct = $resultPrdct->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $dataPrdct['product_name']; ?></td>
                    <td><?php echo $dataPrdct['product_details']; ?></td>
                    <td><?php echo $dataPrdct['product_price']; ?></td>
                    <td><img src="../Assets/Files/Seller/Product/<?php echo $dataPrdct['product_photo']; ?>" /></td>
                    <td><?php echo $dataPrdct['occassion_name']; ?></td>
                    <td><?php echo $dataPrdct['type_name']; ?></td>
                    <td><?php echo $dataPrdct['colour_name']; ?></td>
                    <td><?php echo $dataPrdct['flower_name']; ?></td>
                    <td>
                        <a href="Wishlist.php?did=<?php echo $dataPrdct['wishlist_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>