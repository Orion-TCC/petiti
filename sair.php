<?php 
session_start();
session_destroy();
header("Location: views/login/pages/forms/login.php");