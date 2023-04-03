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
      
      // Procurar Usuarios por Cartucho 

      if(isset($_POST['Search']) && trim($_POST['Search'])!==""){
      $Cartucho = $_POST['Search'];
      $Query = mysqli_query($conexao, "SELECT `UsuarioID` FROM `registergame` WHERE  `Titulo` =trim('$Cartucho')");
      $Row = $Query->fetch_all();
      
      $c=0; 
      foreach($Row as $value){
       foreach($value as $ID){
         $UsuariosLogin = $conexao -> query("SELECT `Usuario` FROM `login` WHERE `ID`='$ID'");
$list[$c]=   $UsuariosLogin = $UsuariosLogin->fetch_row();
    }
 $c++;
   }
   
      foreach($list as $key => $Usuario){
         
         echo ("
         <tbody>
         <tr>
            <td>".$Cartucho."</td>
            <td>".implode($Usuario)."</td>
         <tr>

      </tbody>
      ");
      }
     /*
      $i=0;
      $UsuariosLogin = $conexao -> query("SELECT `Usuario` FROM `login`");
      
      $UsuariosLogin = $UsuariosLogin->fetch_assoc();
      
      while($UsuariosLogin = $conexao -> query("SELECT `Usuario` FROM `login` WHERE `ID` ='$Row[$i]'")){
         $Resultado = $UsuariosLogin -> fetch_row();
         echo ("<tbody>         <tr>         <td>".$Cartucho."</td>            <td>".$Resultado[$i]."</td>         <tr>      </tbody>");
 $i++;
 if($Resultado[$i]==null){
   die;
 }
       
}
*/
      
 }
      
   
      ?>
    <!--  <tbody>
         <tr>
            <td>"Mario"</td>
            <td>User</td>
         <tr>

      </tbody>
-->
   </table>


</body>

</html>