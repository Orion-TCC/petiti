<?php 
if (!isset($_SESSION['login'])) {
    header("Location: /petiti/login");
}