<?php
session_start();
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$UserID = $_SESSION["ID"];

if (!empty($_POST["Delete"])) {
    $GameID = $_POST["Delete"];
    $query = "DELETE FROM `registergame` WHERE `ID` = '$GameID'";
    if(mysqli_query($conexao, $query)){
        header("location:/PHP/index.php");
    }else{
        header("location:/PHP/index.php?msg=err_del");
    }
}
 mysqli_close($conexao);
?>