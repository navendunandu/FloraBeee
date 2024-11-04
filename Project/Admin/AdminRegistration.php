<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

$name = '';
$email = '';
$password = '';
$aId = 0;

if (isset($_POST["btn_submit"])) {
    $aId = $_POST['txt_aid'];
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];

    if ($aId != 0) {
        $upQry = "UPDATE tbl_admin SET admin_name = '$name', admin_email = '$email', admin_password = '$password' WHERE admin_id = '$aId'";
        if ($Con->query($upQry)) {
            echo "<script>alert('Updated'); window.location='AdminRegistration.php';</script>";
        } else {
            echo "Error";
        }
    } else {
        $insqry = "INSERT INTO tbl_admin(admin_name, admin_email, admin_password) VALUES('$name', '$email', '$password')";
        if ($Con->query($insqry)) {
            echo "<script>alert('Inserted'); window.location='AdminRegistration.php';</script>";
        } else {
            echo "Error";
        }
    }
}

if (isset($_GET["delID"])) {
    $adminID = $_GET["delID"];
    $delQry = "DELETE FROM tbl_admin WHERE admin_id = $adminID";
    if ($Con->query($delQry)) {
        echo "<script>alert('Deleted'); window.location='AdminRegistration.php';</script>";
    } else {
        echo "Error";
    }
}

if (isset($_GET["eID"])) {
    $aId = $_GET["eID"];
    $selqry = "SELECT * FROM tbl_admin WHERE admin_id = '$aId'";
    $result = $Con->query($selqry);
    $data = $result->fetch_assoc();
    $name = $data['admin_name'];
    $email = $data['admin_email'];
    $password = $data['admin_password'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Registration</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    body {
        background-color: #f5f5f5;
    }
    .container {
        background-color: #32383e;
        padding: 20px;
        border-radius: 10px;
        color: white;
    }
    .table {
        color: white;
    }
    .form-control, .btn {
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .btn-primary {
        background-color: #c49b63;
        border: none;
    }
    .btn-primary:hover {
        background-color: #b08b4a;
    }
    .btn-secondary {
        background-color: #474f57;
        border: none;
        color: white;
    }
    .btn-secondary:hover {
        background-color: #5a656e;
    }
    table {
        color: white;
        background-color: #474f57;
        border: 1px solid #c49b63;
        width: 100%;
        margin-top: 10px;
    }
    th, td {
        padding: 10px;
        text-align: center;
    }
</style>
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center">Admin Registration</h2>
    <form method="post" action="">
        <input type="hidden" name="txt_aid" id="txt_aid" value="<?php echo $aId; ?>">
        
        <div class="form-group">
            <label for="txt_name">Name</label>
            <input type="text" name="txt_name" id="txt_name" class="form-control" required pattern="^[A-Z]+[a-zA-Z ]*$" title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter" value="<?php echo $name; ?>">
        </div>
        
        <div class="form-group">
            <label for="txt_email">Email</label>
            <input type="email" name="txt_email" id="txt_email" class="form-control" required value="<?php echo $email; ?>">
        </div>
        
        <div class="form-group">
            <label for="txt_password">Password</label>
            <input type="password" name="txt_password" id="txt_password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $password; ?>">
        </div>
        
        <div class="form-group text-center">
            <input type="submit" name="btn_submit" class="btn btn-primary" value="Submit">
            <input type="reset" name="btn_cancel" class="btn btn-secondary" value="Cancel">
        </div>
    </form>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $selqry = "SELECT * FROM tbl_admin";
        $result = $Con->query($selqry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            echo "<tr>";
            echo "<td>{$i}</td>";
            echo "<td>{$data['admin_name']}</td>";
            echo "<td>{$data['admin_email']}</td>";
            echo "<td>{$data['admin_password']}</td>";
            echo "<td><a href='AdminRegistration.php?delID={$data['admin_id']}' class='btn btn-danger btn-sm'>Delete</a>
                  <a href='AdminRegistration.php?eID={$data['admin_id']}' class='btn btn-warning btn-sm'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include("Foot.php");
ob_end_flush();
?>
