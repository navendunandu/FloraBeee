<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/connection.php");
if(isset($_POST['btn_reply']))
{
	$reply=$_POST['txt_reply'];
	$UpQry="update tbl_complaint set complaint_reply='$reply' where complaint_id=".$_GET['cid'];
	if($Con->query($UpQry))
	{
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
            background-color: #151111; /* White background */
        }

        .reply-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
        }

        .reply-container label {
            color: white; /* White text for labels */
        }

        .reply-container input[type="text"] {
            background-color: #333; /* Dark background for input */
            color: white; /* White text for input */
            border: 1px solid #555; /* Dark border */
        }

        .reply-container input[type="submit"] {
            background-color: #c49b6e; /* Bootstrap primary color */
            border: none; /* Remove border */
            color: #333; /* White text for button */
        }

        .reply-container input[type="submit"]:hover {
            background-color: #c49b6e; /* Darker shade on hover */
        }
    </style>
<title>Reply</title>
</head>

<body>
    <div class="container mt-5">
        <div class="reply-container">
            <form id="form1" name="form1" method="post" action="">
                <table class="table table-borderless">
                    <tr>
                        <td><label for="txt_reply">Reply</label></td>
                        <td>
                            <input required type="text" name="txt_reply" id="txt_reply" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="btn_reply" id="btn_reply" value="Reply" class="btn btn-primary" />
                        </td>
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