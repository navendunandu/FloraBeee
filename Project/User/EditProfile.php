<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
session_start();
 $SelQry="select * from tbl_userregistration u inner join tbl_place p on u.place_id=p.place_id inner JOIN tbl_district d on d.district_id=p.district_id where user_id='".$_SESSION['uid']."' ";
 $result=$Con->query($SelQry);
 $data=$result->fetch_assoc();
if(isset($_POST['btn_submit']))
{
	$Name = $_POST['txt_name'];
	$Email = $_POST['txt_email'];
	$Contact = $_POST['txt_contact'];
	$Address= $_POST['txt_address'];
	$upQry = " update tbl_userregistration set user_name='".$Name."',user_email='".$Email."',user_contact='".$Contact."',user_address='".$Address."'";
	if($Con->query($upQry))
	{
		?>
        <script>
		alert("Updated")
		window.location="EditProfile.php"
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

        .user-info-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        .user-info-container label, .user-info-container input[type="text"], .user-info-container input[type="email"], .user-info-container textarea {
            color: white; /* White text for labels and inputs */
        }

        .user-info-container input[type="text"], .user-info-container input[type="email"], .user-info-container textarea {
            background-color: #333; /* Dark background for inputs */
            color: white; /* White text for inputs */
            border: 1px solid #555; /* Dark border */
            width: 100%; /* Full width for inputs */
            padding: 10px; /* Padding for better UX */
            margin: 5px 0; /* Margin for spacing */
            border-radius: 5px; /* Rounded corners */
        }

        .user-info-container textarea {
            resize: none; /* Disable resizing */
            height: 100px; /* Fixed height for textarea */
        }

        .user-info-container input[type="submit"] {
            background-color: #c49b63; /* Button color */
            border: none; /* Remove border */
            color: white; /* White text for button */
            padding: 10px 15px; /* Padding for buttons */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            margin-top: 10px; /* Margin for spacing */
        }

        .user-info-container input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .text-center {
            text-align: center; /* Center text */
        }
    </style>

<title>Edit Profile</title>
</head>


<body>
    <div class="user-info-container">
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input required type="text" value="<?php echo htmlspecialchars($data['user_name']); ?>" name="txt_name" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" />
            </div>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input required type="email" value="<?php echo htmlspecialchars($data['user_email']); ?>" name="txt_email" id="txt_email" />
            </div>
            <div class="form-group">
                <label for="txt_contact">Contact</label>
                <input required type="text" value="<?php echo htmlspecialchars($data['user_contact']); ?>" name="txt_contact" id="txt_contact" pattern="[7-9]{1}[0-9]{9}" title="Phone number starting with 7-9 followed by 9 digits." />
            </div>
            <div class="form-group">
                <label for="txt_address">Address</label>
                <textarea name="txt_address" id="txt_address" cols="45" rows="5"><?php echo htmlspecialchars($data['user_address']); ?></textarea>
            </div>
            <div class="text-center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Edit" />
            </div>
        </form>
    </div>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>