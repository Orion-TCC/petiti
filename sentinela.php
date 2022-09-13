<?php 
if (!isset($_SESSION['login'])) {
    header("Location: views/login/login.php");
}