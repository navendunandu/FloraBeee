<?php
ob_start();
include("Head.php");
?>

<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST['btn_submit'])){
    $qry="update tbl_cart set cart_msg='".$_POST['txt_msg']."' where cart_id=".$_GET['pid'];
    if($Con->query($qry)){
        ?>
        <script>
		alert('Message Added')
		window.location="MyCart.php"
		</script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: white; /* White background */
        }

        .message-container {
            background-color: #32383e; /* Grey background for the form */
            padding: 20px;
            border-radius: 10px;
            color: white; /* White text */
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        .message-container label, .message-container textarea {
            color: white; /* White text for labels */
        }

        .message-container textarea {
            background-color: #333; /* Dark background for textarea */
            color: white; /* White text for textarea */
            border: 1px solid #555; /* Dark border */
            width: 100%; /* Full width for textarea */
            padding: 10px; /* Padding for better UX */
            margin: 5px 0; /* Margin for spacing */
            border-radius: 5px; /* Rounded corners */
            height: 100px; /* Set a height for the textarea */
            resize: none; /* Disable resizing */
        }

        .message-container input[type="submit"] {
            background-color: #c49b63; /* Button color */
            border: none; /* Remove border */
            color: white; /* White text for button */
            padding: 10px 15px; /* Padding for buttons */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
        }

        .message-container input[type="submit"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }

        .text-center {
            text-align: center; /* Center text */
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="message-container">
        <form action="" method="post">
            <div class="form-group">
                <label for="txt_msg">Message</label>
                <textarea name="txt_msg" id="txt_msg" placeholder="Type your message here..."></textarea>
            </div>
            <div class="text-center">
                <input type="submit" value="Submit" name="btn_submit">
            </div>
        </form>
    </div>
</body>
</html>

<?php
include("Foot.php");
ob_start();
?>