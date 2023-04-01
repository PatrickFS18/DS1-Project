<?php
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$User = 1;
if (isset($_POST["NameGame"], $_POST["YearGame"], $_POST["SystemGame"], $_FILES["Img"])) {
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
}

?>