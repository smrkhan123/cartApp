<?php  
include('config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location:login.php");
} else {
    header("location:products.php");
}
