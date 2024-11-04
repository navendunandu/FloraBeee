<?php
ob_start();
include("Head.php");
?>

<?php 
include("../Assets/Connection/Connection.php");
session_start();
$userid=$_SESSION['uid'];
$selUser="select * from tbl_userregistration where user_id = ".$userid;
$resUser=$Con->query($selUser);
$data=$resUser->fetch_assoc();
if(isset($_POST['btn_changepass']))
{
	$Oldpassword = $_POST["txt_oldpass"];
	$Newpassword = $_POST["txt_newpass"];
	$Retypepassword = $_POST["txt_retypepass"];
if($data['user_password']==$Oldpassword)
{
	if($Newpassword==$Retypepassword)
	{
		$upQry="update tbl_userregistration SET user_password='$Newpassword' WHERE user_id='".$_SESSION['uid']."'";
		if($Con->query($upQry))
		{
			?>
            <script>
			window.location="MyProfile.php";
		
			</script>
           <?php 
		    }
		else
		    {
			   echo"Error";
		}
	}
	else
	{
?> 
           <script>
		   alert('New Password and Re_type Password does not match!!');
		   </script>
		   <?php
	}
}
else
{
?>
           <script>
		   alert('Incorrect Old Password');
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

        .password-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        .password-container label, .password-container input[type="text"] {
            color: white; /* White text for inputs and labels */
        }

        .password-container input[type="text"] {
            background-color: #333; /* Dark background for input */
            color: white; /* White text for input */
            border: 1px solid #555; /* Dark border */
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Padding for better UX */
            margin: 5px 0; /* Margin for spacing */
            border-radius: 5px; /* Rounded corners */
        }

        .password-container input[type="submit"] {
            background-color: #c49b63; /* Bootstrap primary color */
            border: none; /* Remove border */
            color: white; /* White text for button */
            margin-right: 10px;
            padding: 10px 15px; /* Padding for buttons */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
        }

        .password-container input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .text-center {
            text-align: center; /* Center text */
        }
    </style>
<title>Change Password</title>
</head>
<body>
    <div class="password-container">
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_oldpassword">Old Password</label>
                <input required type="text" class="form-control" name="txt_oldpassword" id="txt_oldpassword" placeholder="Enter Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            </div>
            <div class="form-group">
                <label for="txt_newpassword">New Password</label>
                <input required type="text" class="form-control" name="txt_newpassword" id="txt_newpassword" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            </div>
            <div class="form-group">
                <label for="txt_retypepassword">Re-Type Password</label>
                <input required type="text" class="form-control" name="txt_retypepassword" id="txt_retypepassword" placeholder="Retype New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
            </div>
            <div class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Change Password" class="btn btn-primary" />
                <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn btn-secondary" />
            </div>
        </form>
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