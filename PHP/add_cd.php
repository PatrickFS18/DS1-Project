<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$User = $_SESSION['User'];
if (isset($_POST["NameGame"], $_POST["YearGame"], $_POST["SystemGame"], $_FILES["Img"])) {
    $Query = $conexao->query("SELECT * FROM `registergame` WHERE UsuarioID='$User' /* AND Plataforma = $_POST[SystemGame] Why err?*/ AND Ano = $_POST[YearGame] AND Titulo=$_POST[NameGame]");
    $row = $Query->fetch_assoc();
 if(!$row){
    $NameGame = $_POST["NameGame"];
    $YearGame = $_POST["YearGame"];
    $SystemGame = $_POST["SystemGame"];
    $tela = $_FILES["Img"];
    $dir = '';
    $nameimage = $dir . time() . '.jpg';
    $nameimageBD = time() . '.jpg';
   move_uploaded_file($tela['tmp_name'], $nameimage); //Fazer upload do arquivo
   $Insert = mysqli_prepare($conexao, "INSERT INTO `registergame` (`Titulo`,`Plataforma`,`Ano`,`Image`,`UsuarioID`) VALUES (?, ?, ?, ?, ?)");
    $Insert->bind_param("ssisi", $NameGame, $SystemGame, $YearGame, $nameimageBD, $User);
    $Insert->execute();
    // Insere os dados no banco de dados
    //mysqli_query($conexao, $Insert);
       header("location:/PHP/index.php");
}else{
    header("location:/PHP/index.php?msg=err");
    
}
}
mysqli_close($conexao);
?>