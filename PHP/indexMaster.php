<?php
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
   <form method="post" action="indexMaster.php">
      <div style="margin-left:3em;margin-top:3em">
         <label for="Search">Procurar Usuários por Cartucho:
            <input type="text" name="Search">
            <input type="submit">
         </label>
      </div>
   </form>

   <table id="SearchUser" class="table table-striped" style="width:50%;margin-left:2em">


      <thead>

         <tr>
            <th>Cartucho</th>
            <th>Usuários</th>
         </tr>
      </thead>

      <?php

      // Quem tem o cartucho X?
      if(isset( $_POST['Search'])){
      $Cartucho = $_POST['Search'];
      $Query = mysqli_query($conexao, "SELECT `UsuarioID` FROM `registergame` WHERE  `Titulo` =trim('$Cartucho')");
      $Row = $Query->fetch_all();
   }
      if (isset($_POST['Search']) && trim($_POST['Search']) !== "" && $Row == true) {
         $c = 0;
         foreach ($Row as $value) {
            foreach ($value as $ID) {
               $UsuariosLogin = $conexao->query("SELECT `Usuario` FROM `login` WHERE `ID`='$ID'");
               $list[$c] =   $UsuariosLogin = $UsuariosLogin->fetch_row();
            }
            $c++;
         }
         foreach ($list as $key => $Usuario) {
            echo ("
         <tbody>
         <tr>
            <td>" . $Cartucho . "</td>
            <td>" . implode($Usuario) . "</td>
         <tr>

      </tbody>
      ");
         }
      } else if (isset($_POST['Search']) && trim($_POST['Search']) !== "") {
         echo ("
 <tbody>
 <tr>
    <td>" . $Cartucho . "</td>
    <td>Não encontrado</td>
 <tr>

</tbody>
");
      }
      ?>
   </table>
<!--Qual é o cartucho mais antigo? Quem é o dono?-->
<?php

$resultado = mysqli_query($conexao, "SELECT MIN(ano) AS min_ano FROM `registergame`");

if ($resultado) {
   $linha = mysqli_fetch_assoc($resultado);
   $min_ano = $linha['min_ano'];

   $UsuID = mysqli_query($conexao, "SELECT `UsuarioID` FROM `registergame` WHERE Ano ='$min_ano'");
   $UserMin='';
   foreach($UsuID as $key =>$value){
  foreach ($value as $valu){
   
   if ($Usu = mysqli_query($conexao, "SELECT `Usuario` FROM `login` WHERE ID ='$valu'")){
      $Usu = trim($Usu->fetch_column());
$UserMin.=$Usu;
   }
  }
  $UserMin.=' ';
   }
   $UserMin= explode(' ',$UserMin);
   $UserMin = array_unique($UserMin);
   $UserMin = implode(',',$UserMin);   
  
   echo "O menor ano encontrado na tabela é: " . $min_ano . " e o(s) Usuario(s) do Game é/São: " . rtrim($UserMin,',');
} else {
   echo "Erro ao consultar o banco de dados";
}
?>

<form action="" method="post">
   <label for="System">número de games para uma dada plataforma. Escolha uma plataforma: </label>
     <input type="text" placeholder="PS1; Nintendo" name="System">
   <input type="submit">

</form>


   <?php 

    //  número de games para uma dada plataforma/sistema.
    if(isset($_POST['System'])){
    $System =$_POST['System'];
    $CountGames = mysqli_query($conexao, "SELECT count(Titulo) FROM `registergame` WHERE `Plataforma` = '$System'");
    $CountGames = $CountGames -> fetch_column();
   echo('O número de Cartuchos com o sistema: '.$System.' é: '.$CountGames); 
   } 
  
   ?>

</body>

</html>