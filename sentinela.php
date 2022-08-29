<?php 
if (!isset($_SESSION['login'])) {
    header("Location: views/login/pages/forms/login.php");
}