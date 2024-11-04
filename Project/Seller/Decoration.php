<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$description=$_POST['txt_desc'];
	$photo=$_FILES['txt_photo']['name'];
	$tempphoto=$_FILES['txt_photo']['tmp_name'];
	$seller=$_SESSION['sid'];
	move_uploaded_file($tempphoto,'../Assets/Files/Seller/Decoration/'.$photo);
	
$insQry = "insert into tbl_decoration(decoration_description,decoration_photo,seller_id)values('".$description."','".$photo."','".$seller."')";

 if($Con->query($insQry))
	{
		echo "Inserted";
	}
}
if (isset($_GET['did'])) {
    $delQry = "DELETE FROM tbl_decoration WHERE decoration_id=" . $_GET['did'];
    if ($Con->query($delQry)) {
        echo "Deleted";
    }
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: white; /* White background for the page */
        }

        .form-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text for all form elements */
        }

        .form-container label, .form-container td {
            color: white; /* White text for labels and table cells */
        }

        .table-container {
            margin-top: 20px;
            color: white; /* White text for the table content */
        }

        .table-container td, .table-container th {
            color: white; /* White text for the table content */
        }

        .table-container img {
            width: 200px;
            height: 200px;
        }
    </style>
<title>Decoration</title>
</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div class="form-group">
                    <label for="txt_desc">Description</label>
                    <textarea class="form-control" name="txt_desc" id="txt_desc" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="txt_photo">Photo</label>
                    <input required type="file" class="form-control-file" name="txt_photo" id="txt_photo" />
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit" value="Submit" />
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="table table-bordered table-dark mt-4">
                <thead>
                    <tr>
                        <th>SlNo</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $selQry = "select * from tbl_decoration";
                    $result = $Con -> query($selQry);
                    $i = 0;
                    while($data = $result -> fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['decoration_description']; ?></td>
                        <td><img src="../Assets/Files/Seller/Decoration/<?php echo $data['decoration_photo'];?>" alt="Decoration Photo"/></td>
                        <td><a href="Decoration.php?did=<?php echo $data['decoration_id'];?>" class="btn btn-primary">Delete</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
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