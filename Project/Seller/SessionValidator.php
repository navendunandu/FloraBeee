<?php
session_start();
if(!isset($_SESSION['sid'])){
    header("location:../Guest/Login.php");
}
?>