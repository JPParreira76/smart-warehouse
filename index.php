<?php
session_start();
// usernames
$_SESSION["username_1"] = "joao";
$_SESSION["username_2"] = "francisco";
$_SESSION["username_3"] = "safadinho";
// password hashes
$_SESSION["hash_1"] = '$2y$10$xLtOBtlN3A0DmXUczhFJZ.p3s.uksedkpILPg4Q.zGCzA.p8Ptq6G'; //joao
$_SESSION["hash_2"] = '$2y$10$OMD7sTbUcmd.u3UyuRt40OV/m6zctp6HwzPH88LhLdzVZQvY6Vid.'; //francisco
$_SESSION["hash_3"] = '$2y$10$Ua30KI25.venLjQq/9bH.OryFZ0Kcom9/0kYbD06GHIcF2SyNnAEu'; //safadinho
// to login page
header("refresh:0;url=login.php");
?>