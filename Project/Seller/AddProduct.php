<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit'])){
    $name=$_POST['txt_name'];
    $details=$_POST['txt_details'];
    $price=$_POST['txt_price'];
    $occassion=$_POST['txt_occa'];
    $type=$_POST['txt_type'];
    $colour=$_POST['txt_colour'];
    $flower=$_POST['txt_flower'];
    $seller=$_SESSION['sid'];
    $photo=$_FILES['txt_photo']['name'];
    $tempphoto=$_FILES['txt_photo']['tmp_name'];
    move_uploaded_file($tempphoto, '../Assets/Files/Seller/Product/'.$photo);

    $insQry = "INSERT INTO tbl_product (product_name, product_details, product_price, product_photo, occassion_id, type_id, colour_id, flower_id, seller_id) VALUES ('".$name."','".$details."','".$price."','".$photo."','".$occassion."','".$type."','".$colour."','".$flower."','".$seller."')";

    if($Con->query($insQry))
    {
    ?>
        <script>
            alert("Inserted");
            window.location="AddProduct.php"
        </script>
    <?php
    }
    else
    {
        echo "Error";
    }
}

if(isset($_GET["did"]))
{
    $productID=$_GET["did"];
    $delQry="DELETE FROM tbl_product WHERE product_id=$productID";
    if($Con->query($delQry))
    {
    ?>
        <script>
            alert("Deleted");
            window.location="AddProduct.php";
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

        .form-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
            margin: 20px auto; /* Center the form */
            max-width: 800px; /* Limit the width */
        }

        .form-container label, .form-container input, .form-container select, .form-container textarea {
            color: white; /* White text for inputs and labels */
        }

        .form-container input[type="text"], 
        .form-container textarea, 
        .form-container select {
            background-color: #32383e !important; /* Dark background for inputs */
            color: white; /* White text for input */
            border: 1px solid #555; /* Dark border */
        }

        .form-container input[type="submit"] {
            background-color: #c49b63; /* Set your desired button color */
            border: none; /* Remove border */
            color: white; /* White text for button */
            padding: 10px 20px; /* Add some padding */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Change cursor on hover */
        }

        .form-container input[type="submit"]:hover {
            background-color: #b38a54; /* Darker shade on hover */
        }

        .product-table {
            margin: 20px auto; /* Center the table */
            width: 100%; /* Full width */
        }

        .product-table img {
            width: 100px; /* Set a smaller size for images in table */
            height: auto; /* Maintain aspect ratio */
        }

        /* Set text color in the product table to black */
        .product-table th, .product-table td {
            color: black; /* Black text for table headers and cells */
        }
    </style>
    <title>Add Product</title>
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input type="text" class="form-control" name="txt_name" id="txt_name" />
            </div>
            <div class="form-group">
                <label for="txt_details">Details</label>
                <textarea class="form-control" name="txt_details" id="txt_details" cols="45" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="txt_price">Price</label>
                <input type="text" class="form-control" name="txt_price" id="txt_price" />
            </div>
            <div class="form-group">
                <label for="txt_photo">Photo</label>
                <input type="file" class="form-control-file" name="txt_photo" id="txt_photo" />
            </div>
            <div class="form-group">
                <label for="txt_occa">Occasion</label>
                <select class="form-control" name="txt_occa" id="txt_occa">
                    <option>---Select---</option>
                    <?php
                    $selOc = "SELECT * FROM tbl_occassion";
                    $resultOc = $Con->query($selOc);
                    while ($dataOc = $resultOc->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $dataOc['occassion_id'] ?>"><?php echo $dataOc['occassion_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="txt_type">Type</label>
                <select class="form-control" name="txt_type" id="txt_type">
                    <option>---Select---</option>
                    <?php
                    $selTyp = "SELECT * FROM tbl_type";
                    $resultTyp = $Con->query($selTyp);
                    while ($dataTyp = $resultTyp->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $dataTyp['type_id'] ?>"><?php echo $dataTyp['type_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="txt_colour">Colour</label>
                <select class="form-control" name="txt_colour" id="txt_colour">
                    <option>---Select---</option>
                    <?php
                    $selClr = "SELECT * FROM tbl_colour";
                    $resultClr = $Con->query($selClr);
                    while ($dataClr = $resultClr->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $dataClr['colour_id'] ?>"><?php echo $dataClr['colour_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="txt_flower">Flower</label>
                <select class="form-control" name="txt_flower" id="txt_flower">
                    <option>---Select---</option>
                    <?php
                    $selFlw = "SELECT * FROM tbl_flower";
                    $resultFlw = $Con->query($selFlw);
                    while ($dataFlw = $resultFlw->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $dataFlw['flower_id'] ?>"><?php echo $dataFlw['flower_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
            </div>
            <div class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
            </div>
        </form>
    </div>

    <div class="product-table">
        <table class="table table-bordered">
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
            $selPrdct = "SELECT * FROM tbl_product p 
                         INNER JOIN tbl_occassion o ON p.occassion_id = o.occassion_id 
                         INNER JOIN tbl_type t ON p.type_id = t.type_id 
                         INNER JOIN tbl_colour c ON p.colour_id = c.colour_id 
                         INNER JOIN tbl_flower f ON p.flower_id = f.flower_id 
                         WHERE seller_id = '".$_SESSION['sid']."'"; 
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
                    <td><img src="../Assets/Files/Seller/Product/<?php echo $dataPrdct['product_photo']; ?>" width="100" height="100" /></td>
                    <td><?php echo $dataPrdct['occassion_name']; ?></td>
                    <td><?php echo $dataPrdct['type_name']; ?></td>
                    <td><?php echo $dataPrdct['colour_name']; ?></td>
                    <td><?php echo $dataPrdct['flower_name']; ?></td>
                   <p> <td><a href="AddProduct.php?did=<?php echo $dataPrdct['product_id']; ?>">Delete</a></P>
                   <p> <a href="Stock.php?pid=<?php echo $dataPrdct['product_id']; ?>">Add Stock</a></td></p>
                </tr>
            <?php 
            }
            ?>
        </table>
    </div>
</body>
</html>
