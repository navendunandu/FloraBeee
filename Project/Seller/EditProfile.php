<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
	session_start();
$sellerid=$_SESSION['sid'];


if(isset($_POST["btn_edit"]))
{
	
	$name=$_POST["txt_name"];
	$email=$_POST["txt_email"];
	$contact=$_POST["txt_contact"];
	
		$upQry="update tbl_seller SET seller_name='$name', seller_email='$email',seller_contact='$contact' WHERE seller_id='".$_SESSION['sid']."'";
		if($Con->query($insQry))
	{
	?>
		<script>
					alert("Updated");
					window.location="EditProfile.php"
		</script>
	<?php
		}
	else
		{
			echo "Error";
		}


	}
	$SelSeller="select * from tbl_seller WHERE seller_id='".$_SESSION['sid']."'";
	$resSeller=$Con->query($SelSeller);
$data=$resSeller->fetch_assoc();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .form-container {
            background-color: #32383e;
            padding: 20px;
            margin: 30px auto;
            width: 50%;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .form-container table {
            width: 100%;
        }

        .form-container input[type="submit"] {
            background-color: #c49b6e;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-container input {
            width: 70%;
            padding: 8px;
        }

        .form-container td {
            padding: 10px;
        }
    </style>
<title>EditProfile</title>
</head>
<body>

<div class="form-container" >
    <form id="form1" name="form1" method="post" action="">
   
        <table border="0">
            <tr>
                <td>Name</td>
                <td>
                    <label for="txt_name"></label>
                    <input 
                        required 
                        type="text" 
                        name="txt_name" 
                        id="txt_name" 
                        pattern="^[A-Z][a-zA-Z ]*$" 
                        title="Name must start with a capital letter and can only contain alphabets and spaces" 
                        placeholder="Enter your name"
                    />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <label for="txt_email"></label>
                    <input 
                        required 
                        type="email" 
                        name="txt_email" 
                        id="txt_email" 
                        placeholder="Enter your email"
                    />
                </td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>
                    <label for="txt_contact"></label>
                    <input 
                        required 
                        type="text" 
                        name="txt_contact" 
                        id="txt_contact" 
                        pattern="[7-9]{1}[0-9]{9}" 
                        title="Phone number must start with 7-9 and contain 10 digits" 
                        placeholder="Enter your contact number"
                    />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="btn_edit" id="btn_edit" value="Edit" />
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
include("Foot.php");
ob_start();
?>