<?php
//sessao iniciada
session_destroy();
session_start();

$User = $_POST["User"];
$Pwd = $_POST["Pwd"];
$_SESSION["User"] = $User;

//Verifica se existe a variavel User na session
//se nao existir a variavel User na session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trimUser = trim($_POST["User"]);
    if (!empty($trimusuario)) {
        //criar variaveis na session
        $_SESSION["User"] = $User;
    }
}

//conexao
($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
    (print mysqli_connect_error());

//Verificar usuario
if (isset($_SESSION["User"])) {
    $Query = $conexao->query("SELECT * FROM `login` WHERE Usuario='$User'");

    $row = $Query->fetch_row();
    if ($row[0] > 0) {
        $Hashed_password = $conexao->query(
            "SELECT `Senha` FROM `login` WHERE `Usuario`='$User'"
        );
        $Pass = $Hashed_password->fetch_row();
        if (password_verify($Pwd, $Pass[0])) {
            if ($row[0] > 0) {
                header("location:/PHP/index.php");
            } else {
                header("location:/HTML/Login.html");
            }
        } else {
            header("location:/HTML/Login.html");
        }
    } else {
        header("location:/HTML/Login.html");
    }
} else {
    $trimUser = trim($_POST["User"]);
    $_SESSION["User"] = $User;
}


mysqli_close($conexao);

?>

