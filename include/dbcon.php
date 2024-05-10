<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$con = mysqli_connect('localhost','locationdatabee_admin','cp*#M&Q)~h5*','locationdatabee_lms')or die(mysqli_error());
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   
// echo "<pre>";
// print_r($_SESSION);
// exit;
?>