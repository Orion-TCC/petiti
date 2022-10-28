
<?php
@session_start();
if (!isset($_SESSION['id-cadastro'])) {
    header("Location: /petiti/");
}
