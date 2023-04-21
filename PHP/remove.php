<?php
session_start();
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$UserID = $_SESSION["ID"];

if (!empty($_POST["Delete"])) {
    $GameID = $_POST["Delete"];
    date_default_timezone_set("America/Sao_Paulo");
    $DeletedG = date('d-m-Y H:i:s');
    $DataToSave = $conexao->query("SELECT * FROM `registergame` WHERE `UsuarioID`='$UserID[ID]' AND `ID` = '$GameID'");
    $row = $DataToSave->fetch_assoc();
    $IDG = $row["ID"];
    $TituloG = $row["Titulo"];
    $PlataformaG = $row["Plataforma"];
    $AnoG =  $row["Ano"];
    $ImageG =  $row["Image"];
    # Inserir ao histórico o jogo a ser excluído
    $Insert = mysqli_prepare(
        $conexao,
        "INSERT INTO `Historico` (`ID`,`Titulo`,`Plataforma`,`Ano`,`UsuarioID`,`Image`,`DeleteAT`) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $Insert->bind_param(
        "issiiss",
        $GameID,
        $TituloG,
        $PlataformaG,
        $AnoG,
        $UserID["ID"],
        $ImageG,
        $DeletedG
    );
    $Insert->execute();
   
    $query = "DELETE FROM `registergame` WHERE `ID` = '$GameID'";
    if(mysqli_query($conexao, $query)){
         header("location:/PHP/index.php");
    }else{
         header("location:/PHP/index.php?msg=err_del");
    }
}
 mysqli_close($conexao);
?>