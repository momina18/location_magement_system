<?php 

if (!isset($_SESSION['id'])){
    header('Location:index.php');
}
$id_session=$_SESSION['id'];
?>