<?php
session_start();
include("../Assets/Connection/Connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function generateOTP($length = 6) {
    $digits = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }
    return $otp;
}

function otpEmail($email, $otp) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'florabeeez@gmail.com'; // Your gmail
    $mail->Password = ''; // Your gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
  
    $mail->setFrom('florabeeez@gmail.com'); // Your gmail
    $mail->addAddress($email);
  
    $mail->isHTML(true);
    $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Your OTP Code
        </div>
        <p>Hello,</p>
        <p>Here is your One-Time Password (OTP) for verification:</p>
        <h2 style="font-size: 36px; color: #333;">' . $otp . '</h2>
        <p>This OTP is valid for the next 5 minutes. Please use it to complete your verification process.</p>
        <p>If you did not request this OTP, please ignore this email or contact support if you have concerns.</p>
        <p>Best regards,<br>TinyRoots</p>
        <div class="footer">
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
';
    $mail->Subject = "Reset your password"; // Your Subject goes here
    $mail->Body = $message; // Mail Body goes here

    if($mail->send()) {
        ?>
        <script>
            alert("Email Sent");
            window.location="OTP_validator.php"; // Redirect to OTP validation
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Email Failed");
        </script>
        <?php
    }
}

if(isset($_POST['btn_submit'])) {
    $email = $_POST['txt_email'];
    $selUser = "select * from tbl_userregistration where user_email='".$email."'";	
    $selSeller = "select * from tbl_seller where seller_email='".$email."'";
    $resUser = $Con->query($selUser);
    $resSeller = $Con->query($selSeller);
    $otp = generateOTP();
    $_SESSION['otp'] = $otp;
    
    if($userData = $resUser->fetch_assoc()) {
        $_SESSION['ruid'] = $userData['user_id'];
        otpEmail($email, $otp);
    } else if($sellerData = $resSeller->fetch_assoc()) {
        $_SESSION['rsid'] = $sellerData['seller_id'];
        otpEmail($email, $otp);
    } else {
        ?>
        <script>
            alert("Account Doesn't Exist");
        </script>
        <?php	
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

        .password-container input[type="text"] {
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
                <label for="txt_email">Email</label>
                <input type="text" name="txt_email" id="txt_email" required placeholder="Enter your email" />
            </div>
            <div class="text-center">
                <input type="submit" value="Reset" name="btn_submit" />
            </div>
        </form>
    </div>
</body>
</html>
