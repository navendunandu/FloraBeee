<?php
session_start();
include('../Assets/Connection/Connection.php');

if (isset($_POST['btn_submit'])) {
    $email = $_POST['txt_email'];
    $pass = $_POST['txt_password'];
    
    $selAdmin = "SELECT * FROM tbl_admin WHERE admin_email='" . $email . "' AND admin_password='" . $pass . "'";
    $selUser = "SELECT * FROM tbl_userregistration WHERE user_email='" . $email . "' AND user_password='" . $pass . "'";
    $selSeller = "SELECT * FROM tbl_seller WHERE seller_email='" . $email . "' AND seller_password='" . $pass . "'";
    
    $resAdmin = $Con->query($selAdmin);
    $resUser = $Con->query($selUser);
    $resSeller = $Con->query($selSeller);
    
    if ($adminData = $resAdmin->fetch_assoc()) {
        $_SESSION['aid'] = $adminData['admin_id'];
        $_SESSION['aname'] = $adminData['admin_name'];
        header('location:../Admin/Homepage.php');
    } else if ($userData = $resUser->fetch_assoc()) {
        $_SESSION['uid'] = $userData['user_id'];
        $_SESSION['uname'] = $userData['user_name'];
        header('location:../User/Homepage.php');
    } else if ($sellerData = $resSeller->fetch_assoc()) {
        $_SESSION['sid'] = $sellerData['seller_id'];
        $_SESSION['sname'] = $sellerData['seller_name'];
        header('location:../Seller/Homepage.php');
    } else {
        ?>
        <script>
            alert("Invalid Credentials");
        </script>
        <?php    
    }
}
?>

<?php include('Head.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center">Login</h2>
            <form id="form1" name="form1" method="post" action="">
                <div class="form-group">
                <label for="txt_email" style="color: black;">Email</label>

                    <input required type="text" name="txt_email" id="txt_email" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="txt_password" style="color: black;">Password</label>
                    <input required type="password" name="txt_password" id="txt_password" class="form-control" />
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Login" class="btn btn-primary" />
                </div>
                <div class="form-group text-center">
                <a href="ForgetPassword.php" style="color: black;">Forget Password?</a>

                </div>
            </form>
        </div>
    </div>
</div>
