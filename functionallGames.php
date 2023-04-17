<?php
session_start();

($conexao = mysqli_connect("localhost", "root", "mysqluser", "gamerx")) or
    (print mysqli_connect_error());
$User = $_SESSION["User"];
$UserID = $_SESSION["ID"];