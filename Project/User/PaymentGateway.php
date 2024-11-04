
<?php 
session_start();
include("../Assets/Connection/Connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Payment Gateway</title>
        <link rel="stylesheet" href="./style.css">
        <style>
        body {
            background-color: white; /* White background */
            font-family: Arial, sans-serif; /* Font styling */
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height */
        }

        .payment {
            background-color: #32383e; /* Grey background for payment section */
            padding: 40px; /* Increase padding for more space */
            border-radius: 10px;
            width: 600px; /* Set a larger width for the payment box */
            color: white; /* White text */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }

        .payment-logo {
            text-align: center;
            margin-bottom: 20px; /* Space below logo */
        }

        h2 {
            text-align: center; /* Center heading */
            margin-bottom: 20px; /* Space below heading */
        }

        .form {
            text-align: center; /* Center heading */
            margin-top: 20px; /* Space above form */
        }

        .card {
            text-align: center; /* Center heading */
            margin-bottom: 20px; /* Space between card fields */
        }

        .label {
            text-align: center; /* Center heading */
            display: block; /* Make label block level */
            margin-bottom: 10px; /* Space below label */
        }

        .input {
            width: 100%; /* Full width for inputs */
            padding: 15px; /* Increase padding for larger input fields */
            border: 1px solid #ddd; /* Light border */
            border-radius: 5px; /* Rounded corners */
            background-color: #444; /* Darker background for input */
            color: white; /* White text in input */
            font-size: 16px; /* Increase font size */
        }

        .input:focus {
            outline: none; /* Remove outline on focus */
            border-color: #007bff; /* Blue border on focus */
        }

        .icon-relative {
            position: relative; /* Position for icons */
        }

        .icon-relative i {
            position: absolute; /* Position icons */
            top: 50%; /* Center vertically */
            left: 10px; /* Space from left */
            transform: translateY(-50%); /* Center vertically */
            color: white; /* White color for icons */
        }

        .card-grp {
            display: flex;
            justify-content: space-between;
        }

        .card-item {
            width: 48%; /* Width of the expiry date and CVV fields */
        }

        .btn {
            text-align: center; /* Center the button */
            margin-top: 20px;
        }

        .btn input {
            background-color: #c49b6e; /* Background for button */
            color: white; /* White text */
            border: none; /* Remove border */
            padding: 15px 25px; /* Increase padding for a bigger button */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer on hover */
            transition: background-color 0.3s; /* Transition effect */
            font-size: 16px; /* Increase font size for button */
        }

        .btn input:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        </style>
    </head>

<?php
    if(isset($_POST["btnpay"])!="") {
        $selQry = "SELECT MAX(booking_id) AS id FROM tbl_booking WHERE booking_status='1'";
        $res = $Con->query($selQry);
        $data = $res->fetch_assoc();
        $bid = $data["id"];
        $upD = "UPDATE tbl_booking SET booking_status ='2', booking_date=CURDATE() WHERE booking_id='$bid' ";
        if($Con->query($upD)) {
            ?>
            <script>
                window.location = "Success.html";
            </script>
            <?php
        }
    }
?>
    <body>
    <div class="wrapper">
        <div class="payment">
            <div class="payment-logo">
                <p>Payment Logo</p>
            </div>
            <h2>Payment Gateway</h2>
            <div class="form">
                <form method="post">
                    <div class="card space icon-relative">
                        <label class="label">Card holder:</label>
                        <input type="text" class="input" placeholder="Card Holder" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card space icon-relative">
                        <label class="label">Card number:</label>
                        <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number" required>
                        <i class="far fa-credit-card"></i>
                    </div>
                    <div class="card-grp space">
                        <div class="card-item icon-relative">
                            <label class="label">Expiry date:</label>
                            <input type="text" name="expiry-date" class="input" data-mask="00 / 00" placeholder="MM / YY" required>
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div class="card-item icon-relative">
                            <label class="label">CVV:</label>
                            <input type="text" class="input" data-mask="000" placeholder="CVV" required>
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <div class="btn">
                        <input type="submit" name="btnpay" id="btnpay" value="Pay">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js'></script>
    <script src="./script.js"></script>
</body>
</html>
