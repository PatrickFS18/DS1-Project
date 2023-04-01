<?php

session_start();

$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());

$User = $_POST["User"];
$Pwd = $_POST['Pwd'];
$PwdHashed = password_hash($_POST['Pwd'], PASSWORD_DEFAULT);
$Query = $conexao->query("SELECT `Usuario` FROM `login` WHERE Usuario='$User'");
$Hashed_password = $conexao->query("SELECT `Senha` FROM `login` WHERE `Usuario`='$User'");
$Pass = $Hashed_password->fetch_row();

$row = $Query->fetch_row();

if (!password_verify($Pwd, $Pass[0]) && $row[0] < 1) {
    $Insert = "INSERT INTO `login` (Usuario,Senha) VALUES ('$User','$PwdHashed')";

    if (mysqli_query($conexao, $Insert)) {

        header("Location:/HTML/Login.html?msg=Y");
    } else {

        header("Location:/HTML/Login.html?msg=N");
    }
}else{
    header("Location:/HTML/Register.html");

}
mysqli_close($conexao);
?>