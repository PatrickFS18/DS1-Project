<?php
session_start();

($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
    (print mysqli_connect_error());
$User = $_SESSION["User"];
$UserID = $_SESSION["ID"];
if (
    isset(
        $_POST["NameGame"],
        $_POST["YearGame"],
        $_POST["SystemGame"],
        $_FILES["Img"]
    )
) {
    $Query = $conexao->query(
        "SELECT * FROM `registergame` WHERE `UsuarioID`='$UserID[ID]' /* AND Plataforma = $_POST[SystemGame] Why err?*/ AND `Ano` = '$_POST[YearGame]' AND `Titulo`='$_POST[NameGame]'"
    );
    $row = $Query->fetch_assoc();
    if (!$row) {
        $NameGame = $_POST["NameGame"];
        $YearGame = $_POST["YearGame"];
        $SystemGame = $_POST["SystemGame"];
        $tela = $_FILES["Img"];
        $dir = "../Image/ImageBD/";
        $nameimage = $dir . $NameGame . $YearGame . $SystemGame . ".jpg";
        $nameimageBD = $dir . $NameGame . $YearGame . $SystemGame .".jpg";
       move_uploaded_file($tela["tmp_name"], $nameimage); //Fazer upload do arquivo
        $Insert = mysqli_prepare(
            $conexao,
            "INSERT INTO `registergame` (`Titulo`,`Plataforma`,`Ano`,`Image`,`UsuarioID`) VALUES (?, ?, ?, ?, ?)"
        );
        $Insert->bind_param(
            "ssisi",
            $NameGame,
            $SystemGame,
            $YearGame,
            $nameimageBD,
            $UserID["ID"]
        );
        $Insert->execute();
        header("location:/PHP/index.php");
    } else {
        header("location:/PHP/index.php?msg=err");
    }
}
mysqli_close($conexao);
?>
