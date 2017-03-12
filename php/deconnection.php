<?php
require("bibli_html.php");
session_start();
if(!isset($_SESSION['id'])) {
    header('location: connection.php');
    exit();
}
session_destroy();
header("location:../index.php");

exit();
?>