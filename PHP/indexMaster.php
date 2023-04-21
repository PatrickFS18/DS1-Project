<?php
   ($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
       (print mysqli_connect_error()); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Adm</title>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
      <!-- Bootstrap icons-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="/Css/index.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://a.pub.network/core/pubfig/cls.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="Css/bootstrap.min.css">
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(0, 5, 19);">
         <div class="container px-4 px-lg-5 ">
            <a class="navbar-brand" style="color:#380081;text-transform:uppercase;font-size:250%">JPW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                  <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php" style="color:gold">Home</a></li>
               </ul>
            </div>
         </div>
         <a href="/PHP/SessionRestart.php" class="btn btn-outline-danger" style="margin-right:1em">
         <span class="glyphicon glyphicon-log-out"></span> <i class="fa fa-sign-out" aria-hidden="true" style="margin-right:5px"></i></a>
      </nav>
      <div style="text-align:left">
         <form method="post" action="indexMaster.php">
            <div style="margin-left:3em;margin-top:3em">
               <label for="Search" style='color:white'>Procurar Usuários por Cartucho:<br>
               <input type="text" name="Search">
               <input type="submit">
               </label>
            </div>
         </form>
         <table id="SearchUser" class="table table-striped" style="width:50%;margin-left:2em">
            <thead>
               <tr>
                  <th style="color:white">Cartucho</th>
                  <th style="color:white">Usuários</th>
               </tr>
            </thead>
            <?php
               // Quem tem o cartucho X?
               if (isset($_POST["Search"])) {
                  $Cartucho = $_POST["Search"];
                  $Query = mysqli_query(
                      $conexao,
                      "SELECT `UsuarioID` FROM `registergame` WHERE  `Titulo` =trim('$Cartucho')"
                  );
                  $Row = $Query->fetch_all();
               }
               
               if (
                  isset($_POST["Search"]) &&
                  trim($_POST["Search"]) !== "" &&
                  $Row == true
               ) {
                  $c = 0;
                  foreach ($Row as $value) {
                      foreach ($value as $ID) {
                          $UsuariosLogin = $conexao->query(
                              "SELECT `Usuario` FROM `login` WHERE `ID`='$ID'"
                          );
                          $list[$c] = $UsuariosLogin = $UsuariosLogin->fetch_row();
                      }
                      $c++;
                  }
                  foreach ($list as $key => $Usuario) {
                      echo "
                          <tbody>
                              <tr>
                                  <td style='color:white'>" .
                                      $Cartucho .
                                      "</td>
                                  <td style='color:white'>" .
                                  #se for array retorna implode, se não, apenas entra usuario
                                      (is_array($Usuario) ? implode($Usuario) : $Usuario) .
                                      "</td>
                              <tr>
                          </tbody>
                      ";
                  }
               } elseif (isset($_POST["Search"]) && trim($_POST["Search"]) !== "") {
                   echo "
               <tbody>
               <tr>
               <td>" .
                       $Cartucho .
                       "</td>
               <td>Não encontrado</td>
               <tr>
               
               </tbody>
               ";
               }
               ?>
         </table>
         <!--Qual é o cartucho mais antigo? Quem é o dono?-->
         <div style="margin-left:3em;margin-top:2em">
            <?php
               $resultado = mysqli_query(
                   $conexao,
                   "SELECT MIN(ano) AS min_ano FROM `registergame`"
               );
               
               if ($resultado) {
                   $linha = mysqli_fetch_assoc($resultado);
                   $min_ano = $linha["min_ano"];
               
                   $UsuID = mysqli_query(
                       $conexao,
                       "SELECT `UsuarioID` FROM `registergame` WHERE Ano ='$min_ano'"
                   );
                   $UserMin = "";
                   foreach ($UsuID as $key => $value) {
                       foreach ($value as $valu) {
                           if (
                               $Usu = mysqli_query(
                                   $conexao,
                                   "SELECT `Usuario` FROM `login` WHERE ID ='$valu'"
                               )
                           ) {
                               $Usu = trim($Usu->fetch_column());
                               $UserMin .= $Usu;
                           }
                       }
                       $UserMin .= " ";
                   }
                   $UserMin = explode(" ", $UserMin);
                   $UserMin = array_unique($UserMin);
                   $UserMin = implode(",", $UserMin);
               
                   echo '<p style="color:white">' .
                       "O menor ano encontrado na tabela é: " .
                       $min_ano .
                       " e o(s) Usuario(s) do Game é/São: " .
                       rtrim($UserMin, ",") .
                       "</p>";
               } else {
                   echo "Erro ao consultar o banco de dados";
               }
               ?>
            <form action="" method="post">
               <label for="System" style="color:white">número de games para uma dada plataforma. Escolha uma plataforma: </label> <br>
               <input type="text" placeholder="PS1; Nintendo" name="System">
               <input type="submit">
            </form>
            <?php
               //  número de games para uma dada plataforma/sistema.
               if (isset($_POST["System"])) {
                   $System = $_POST["System"];
                   $CountGames = mysqli_query(
                       $conexao,
                       "SELECT count(Titulo) FROM `registergame` WHERE `Plataforma` = '$System'"
                   );
                   $CountGames = $CountGames->fetch_column();
                   echo '<p style="color:white">' .
                       "O número de Cartuchos com o sistema: " .
                       $System .
                       " é: " .
                       $CountGames .
                       "</p>";
               }
               
               mysqli_close($conexao);
               ?>
            <h3 style="color:white; margin-top:2em">Relatório de todos os Usuarios e seus jogos:</h3>
            <a class="nav-link active" aria-current="page" href="" style="color:gold;">
               <form action="/pdf.php" method="post">
                  <input type="hidden" name="IDUSER" value="admin"  >
                  <input type="submit" value="Gerar Relatório -> Todos Jogos (PDF)"  style="color:gold; background:none">
               </form>
               <form action="/pdfEx.php" method="post" style="margin-top:10px">
                  <input type="hidden" name="Admin" value="admin"  >
                  <input type="submit" value="Gerar Relatório -> Jogos Excluídos (PDF)"  style="color:gold; background:none">
               </form>
            </a>
         </div>
      </div>
   </body>
</html>