<?php
session_start();
if (isset($_SESSION['usuario'])) {

    header('location:formularios/index.php');
}
else {
    header('Location:frmlogin.php');
}

?>

