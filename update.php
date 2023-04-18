<?php
($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
    (print mysqli_connect_error());
$name = $_POST['NameGame'];
echo ($name);
if (isset($_POST['NameGame'], $_POST['NameGameUP'], $_POST['SystemGameUP'], $_POST['YearGameUP'])) {
   $GameTitulo = $_POST['NameGame'];
   $Titulo = $_POST['NameGameUP'];
   $Plataforma = $_POST['SystemGameUP'];
   $Ano = $_POST['YearGameUP'];

   $query = "SELECT * FROM registergame WHERE Titulo = '$GameTitulo' AND UsuarioID = '$UserID[ID]'";
   $result = mysqli_query($conexao, $query);
   $row = mysqli_fetch_assoc($result);

   if ($row) {
      $query = "UPDATE registergame SET Titulo='$Titulo', Plataforma='$Plataforma', Ano='$Ano' WHERE Titulo='$GameTitulo' AND UsuarioID = '$UserID[ID]'";
      if (mysqli_query($conexao, $query)) {
         header("Location:index.php");
         exit;
      } else {
         echo "Erro ao atualizar registro: " . mysqli_error($conexao);
      }
   } else {
      echo "Jogo não encontrado!";
   }
} else {
   echo "Algum dos campos não foi preenchido!";
}
?>
