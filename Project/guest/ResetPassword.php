<?php
session_start();
include("../Assets/Connection/Connection.php");

if(isset($_POST['btn_submit'])){
    $pass = $_POST['txt_pass'];
    $cpass = $_POST['txt_cpass'];
    if($pass == $cpass){
        if(isset($_SESSION['ruid'])) { // User
            $updQry = "update tbl_userregistration set user_password='".$pass."' where user_id=".$_SESSION['ruid'];
            if($Con->query($updQry)){
                ?>
                <script>
                    alert("Password Updated");
                    window.location="Login.php";
                </script>
                <?php
            }
        } else if(isset($_SESSION['rsid'])) { // Seller
            $updQry = "update tbl_seller set seller_password='".$pass."' where seller_id=".$_SESSION['rsid'];
            if($Con->query($updQry)){
                ?>
                <script>
                    alert("Password Updated");
                    window.location="Login.php"; // Redirect to login after update
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Something went wrong');
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            background-color: #f0f0f0; /* Gray background */
        }

        .password-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 30px; /* Increased padding for a larger form */
            border-radius: 10px;
            color: white; /* White text */
            max-width: 700px; /* Increased max-width */
            margin: auto;
            margin-top: 50px;
        }

        .password-container label {
            color: white; /* White text for labels */
            font-size: 18px; /* Larger font size for labels */
        }

        .password-container input[type="password"] {
            background-color: #333; /* Dark background for input */
            color: white; /* White text for input */
            border: 1px solid #555; /* Dark border */
            width: 100%; /* Full width for inputs */
            padding: 12px; /* Increased padding for better UX */
            margin: 10px 0; /* Increased margin for spacing */
            border-radius: 5px; /* Rounded corners */
            font-size: 16px; /* Larger font size for inputs */
        }

        .password-container input[type="submit"] {
            background-color: #c49b63; /* Button color */
            border: none; /* Remove border */
            color: white; /* White text for button */
            margin-right: 10px;
            padding: 12px 20px; /* Increased padding for buttons */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Larger font size for buttons */
        }

        .password-container input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .text-center {
            text-align: center; /* Center text */
        }
    </style>
</head>
<body>
    <div class="password-container">
        <form action="" method="post">
            <div class="form-group">
                <label for="txt_pass">New Password</label>
                <input type="password" name="txt_pass" id="txt_pass" required placeholder="Enter New Password" />
            </div>
            <div class="form-group">
                <label for="txt_cpass">Confirm Password</label>
                <input type="password" name="txt_cpass" id="txt_cpass" required placeholder="Confirm New Password" />
            </div>
            <div class="text-center">
                <input type="submit" name="btn_submit" value="Change Password" />
            </div>
        </form>
    </div>
</body>
</html>
