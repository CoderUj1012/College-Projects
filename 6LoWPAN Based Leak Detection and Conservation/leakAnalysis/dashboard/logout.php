<?php
//session_start();
session_start();
unset($_SESSION["remember"]);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
header("Location: ../welcome");
?>
