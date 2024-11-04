<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php"); 
session_start();
	$SelQry="select * from tbl_userregistration u inner join tbl_place p on u.place_id=p.place_id inner JOIN tbl_district d on d.district_id=p.district_id where user_id='".$_SESSION['uid']."' ";
	$result=$Con->query($SelQry);
	$data=$result->fetch_assoc();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
        body {
            background-color: white; /* White background */
        }

        .profile-container {
            background-color: #32383e; /* Grey background for the table */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .profile-container table {
            width: 100%; /* Ensure the table takes up full width */
        }

        .profile-container td {
            padding: 10px; /* Add some padding to the table cells */
            color: white; /* White text in table cells */
        }

        .profile-container img {
            width: 300px; /* Set logo width */
            height: auto; /* Auto height based on width */
        }

        a {
            color: white; /* White text for links */
        }

        a:hover {
            color: #ddd; /* Slightly lighter on hover */
        }
    </style>
<title>My Profile</title>
</head>

<body>
    <div class="container mt-5">
        <div class="profile-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <td colspan="2">
                            <img src="../Assets/Files/User/Photo/<?php echo $data['user_photo']; ?>" alt="User Photo" />
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?php echo $data['user_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td><?php echo $data['user_email']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact</strong></td>
                        <td><?php echo $data['user_contact']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><?php echo $data['user_address']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><?php echo $data['district_name']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Place</strong></td>
                        <td><?php echo $data['place_name']; ?></td>
                    </tr>
                    <tr>
                        <td><a href="EditProfile.php" class="btn btn-primary">Edit Profile</a></td>
                        <td><a href="ChangePassword.php" class="btn btn-primary">Change Password</a></td>
                    </tr>
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