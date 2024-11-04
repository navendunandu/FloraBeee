<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
include("../Assets/Connection/Connection.php");
if (isset($_POST['btn_signup'])) {
    $email = $_POST['txt_email'];
    $selSeller = "SELECT * FROM tbl_seller WHERE seller_email='" . $email . "' ";

    $resSeller = $Con->query($selSeller);
    
    if ($sellerData = $resSeller->fetch_assoc()) {
        echo "<div class='alert alert-success'>This Email Is Already Exist!</div>";

        
    } 
    else{
       
    
        $name = $_POST['txt_name'];
        $password = $_POST['txt_password'];
        $address = $_POST['txt_address'];
        $contact = $_POST['txt_contact'];
        $gender = $_POST['txt_gender'];
        $proof = $_FILES['txt_proof']['name'];
        $tempproof = $_FILES['txt_proof']['tmp_name'];
        move_uploaded_file($tempproof, '../Assets/Files/Seller/Proof/' . $proof);
        $logo = $_FILES['txt_logo']['name'];
        $templogo = $_FILES['txt_logo']['tmp_name'];
        move_uploaded_file($templogo, '../Assets/Files/Seller/Logo/' . $logo);
        $place = $_POST['txt_place'];
    
        $insQry = "INSERT INTO tbl_seller (seller_name, seller_email, seller_password, seller_address, seller_contact, seller_gender, seller_proof, seller_logo, place_id)
                   VALUES ('$name', '$email', '$password', '$address', '$contact', '$gender', '$proof', '$logo', '$place')";
    
        if ($Con->query($insQry)) {
            echo "<div class='alert alert-success'>Inserted successfully!</div>";

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'florabeeez@gmail.com'; // Your gmail
            $mail->Password = 'avraqsvsncwhixke'; // Your gmail app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
          
            $mail->setFrom('florabeeez@gmail.com'); // Your gmail
          
            $mail->addAddress($email);
          
            $mail->isHTML(true);
          
            $mail->Subject = "FloraBeee";
            $mail->Body = "A new Request has recieved for you   ";
          if($mail->send())
          {
            echo "Sended";
          }
          else
          {
            echo "Failed";
          }

        } else {
            echo "<div class='alert alert-danger'>Error: " . $Con->error . "</div>";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
    body {
        background-color: #f5f5f5; /* Light background */
    }

    .navbar {
        background-color: #32383e; /* Dark navbar background */
    }

    .navbar-brand, .nav-link {
        color: white; /* White text for links */
    }

    .nav-link:hover {
        color: #c49b63; /* Golden hover effect */
    }

    .container {
        background-color: #32383e; /* Dark form background */
        padding: 20px;
        border-radius: 10px;
        color: white; /* White text */
    }

    label {
        color: white; /* White text for labels */
    }

    .form-control, .form-control-file, .form-control:focus, .custom-select, .custom-select:focus {
        background-color: #474f57; /* Darker input background */
        color: white; /* White text for inputs */
        border: 1px solid #c49b63; /* Golden border */
    }

    .btn-primary {
        background-color: #c49b63; /* Golden buttons */
        border: none;
    }

    .btn-primary:hover {
        background-color: #b08b4a; /* Darker golden hover */
    }

    .btn-secondary {
        background-color: #474f57; /* Grey cancel button */
        border: none;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a656e; /* Slightly lighter hover */
    }

    .invalid-feedback {
        color: #ffcccb; /* Light red error messages */
    }
</style>

    <title>Registration Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Your Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Sign Up</h2>
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="txt_name">Name</label>
                <input required type="text" class="form-control" name="txt_name" id="txt_name" pattern="^[A-Z]+[a-zA-Z ]*$" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" />
                <div class="invalid-feedback">Please provide a valid name.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_email">Email</label>
                <input required type="email" class="form-control" name="txt_email" id="txt_email" />
                <div class="invalid-feedback">Please provide a valid email.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_contact">Contact</label>
                <input required type="text" class="form-control" name="txt_contact" id="txt_contact" pattern="[6-9]{1}[0-9]{9}" title="Phone number must start with 7-9 followed by 9 digits." />
                <div class="invalid-feedback">Please provide a valid contact number.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="txt_address">Address</label>
                <input required type="text" class="form-control" name="txt_address" id="txt_address" />
                <div class="invalid-feedback">Please provide an address.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_gender">Gender</label><br>
                <input required type="radio" name="txt_gender" value="Male"> Male
                <input required type="radio" name="txt_gender" value="Female"> Female
                <div class="invalid-feedback">Please select a gender.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_district">District</label>
                <select name="txt_district" class="form-control" id="txt_district" onchange="getPlace(this.value)">
                    <option value="">---Select---</option>
                    <?php
                    // PHP code for fetching district goes here
                    $sel = "SELECT * FROM tbl_district";
                    $result = $Con->query($sel);
                    while ($data = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name'] ?></option>
                    <?php 
                    }
                    ?>
                </select>
                <div class="invalid-feedback">Please select a district.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="txt_place">Place</label>
                <select name="txt_place" class="form-control" id="txt_place">
                    <option value="">---Select---</option>
                </select>
                <div class="invalid-feedback">Please select a place.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_password">Password</label>
                <input required type="password" class="form-control" name="txt_password" id="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                <div class="invalid-feedback">Please provide a password.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_confirmpassword">Confirm Password</label>
                <input required type="password" class="form-control" name="txt_confirmpassword" id="txt_confirmpassword" />
                <div class="invalid-feedback">Please confirm your password.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="txt_logo">Logo</label>
                <input required type="file" class="form-control-file" name="txt_logo" id="txt_logo" />
                <div class="invalid-feedback">Please upload a logo.</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="txt_proof">Proof</label>
                <input required type="file" class="form-control-file" name="txt_proof" id="txt_proof" />
                <div class="invalid-feedback">Please upload proof.</div>
            </div>
            <div class="col-md-4 mb-3 d-flex align-items-end">
                <input type="submit" class="btn btn-primary" name="btn_signup" id="btn_signup" value="Sign Up" />
                <input type="button" class="btn btn-secondary ml-2" name="btn_cancel" id="btn_cancel" value="Cancel" onclick="window.location.href='your_cancel_url_here';" />
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function getPlace(cid) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + cid,
            success: function (result) {
                $("#txt_place").html(result);
            }
        });
    }

    // Bootstrap validation
    (function () {
        'use strict'
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation')
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        }, false)
    })();
</script>

</body>
</html>
