<?php
session_start();
unset($_SESSION['User']);
unset($_SESSION['idUser']);
header("location: ../index.php");
?>