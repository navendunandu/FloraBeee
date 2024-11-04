<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
if(isset($_POST['btn_submit']))
{
	$title=$_POST['txt_title'];
	$des=$_POST['txt_des'];
	$file=$_FILES['file_complaint']['name'];
	$tempfile=$_FILES['file_complaint']['tmp_name'];
	move_uploaded_file($tempfile, '../Assets/Files/User/Complaint/'.$file);
	$pid=$_GET['pid'];
	$uid=$_SESSION['uid'];
	$InsQry="insert into tbl_complaint(complaint_title,complaint_details,complaint_date,user_id,product_id,complaint_file) values('$title','$des',curdate(),'$uid','$pid','$file')";
	if($Con->query($InsQry))
	{
		?>
        <script>
		alert('Inserted')
		window.location="PostComplaint.php"
		</script>
        <?php
	}
	else{
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
        font-family: Arial, sans-serif; /* Font styling */
    }

    .container-m {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full height to vertically center the form */
    }

    form {
        background-color: #32383e; /* Grey background for the form */
        padding: 30px;
        border-radius: 10px; /* Rounded corners */
        width: 400px; /* Set fixed width for the form */
        color: white; /* White text */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect for depth */
    }

    table {
        width: 100%; /* Table takes full width of form */
    }

    td {
        padding: 10px; /* Add padding inside table cells */
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%; /* Inputs take full width */
        padding: 10px; /* Padding inside the inputs */
        border: 1px solid #ddd; /* Light border for inputs */
        border-radius: 5px; /* Rounded corners */
        background-color: #444; /* Darker background for inputs */
        color: white; /* White text inside inputs */
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none; /* Remove the default outline when inputs are focused */
        border-color: #007bff; /* Blue border when focused */
    }

    input[type="submit"] {
        background-color: #c49b63; /* Changed button background to #c49b63 */
        color: white; /* White text */
        border: none; /* Remove borders */
        padding: 10px 20px; /* Padding inside the button */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor on hover */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
        width: 100%; /* Button takes full width */
    }

    input[type="submit"]:hover {
        background-color: #b08754; /* Slightly darker shade on hover */
    }

    label {
        display: block; /* Make label a block-level element */
        margin-bottom: 5px; /* Space below the label */
    }
</style>
<title>Untitled Document</title>
</head>

<body>
    <div class="container-m">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table>
                <tr>
                    <td>Title</td>
                    <td>
                        <label for="txt_title"></label>
                        <input required type="text" name="txt_title" id="txt_title" />
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>
                        <label for="txt_des"></label>
                        <textarea name="txt_des" id="txt_des" cols="45" rows="5" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td>File</td>
                    <td>
                        <label for="file_complaint"></label>
                        <input required type="file" name="file_complaint" id="file_complaint" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>