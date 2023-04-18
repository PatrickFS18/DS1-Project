<?php

session_start();
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
$UserID = $_SESSION["ID"];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
</script>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <title> </title>
   <!-- Favicon-->
   <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
   <!-- Bootstrap icons-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <!-- Core theme CSS (includes Bootstrap)-->
   <link href="/Css/index.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://a.pub.network/core/pubfig/cls.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="Css/bootstrap.min.css">

   <style>

      #buttons {

}
      #h3 {
         animation: animate 1.5s linear infinite;
         text-shadow: 0 0 0.2em #B0E0E6;
      }

      @keyframes animate {
         0% {
            opacity: 0.7;
         }

         50% {
            opacity: 2;
         }

         100% {
            opacity: 0.8;
         }
      }
      .botao {
  background-color: red;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
}
.botaoUp {
   background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
}  </style>
</head>

<body>
   <!-- Navigation-->
   <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:rgb(0, 7, 19);">
      <div class="container px-4 px-lg-5 ">
         <a class="navbar-brand" style="color:#380081;text-transform:uppercase;font-size:250%">JPW</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
               <li class="nav-item"><a class="nav-link active" aria-current="page" href="" style="color:gold">Home</a></li>
               <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php if($_SESSION['User']=='admin'){echo('/PHP/indexMaster.php');}?>" style="color:gold;">Research</a></li>
            </ul>

         </div>
      </div>
      <a href="/PHP/SessionRestart.php" class="btn btn-outline-danger" style="margin-right:1em">
         <span class="glyphicon glyphicon-log-out"></span> <i class="fa fa-sign-out" aria-hidden="true" style="margin-right:5px"></i></a>
   </nav>
   <!-- Header-->
   <header class=" py-5" style="background-color:darkgoldenrod">
      <div class="container px-4 px-lg-5 my-5">
         <div class="text-center text-white">
            <i>
               <h1 class="has-text-align-center homepagetitle2 has-text-color" style="color:white;font-size:50px;text-transform:uppercase" id="h3">GamerX</h1>
            </i>
            <p class="lead fw-normal text-white-50 mb-0" style="color:gold">
               <?php echo ("Hello, " . $_SESSION["User"] . "! <br> Here you can add games that you want, <br> preferencially games that you played before. <br>It is possible <b> Clicking the <b> Add Button</b>, in the final of this page");
               ?>
            </p>
         </div>
      </div>
   </header>
   <!-- Count Games-->
   <h3 style="margin-left:45%;color:aquamarine;margin-top:10px;" id="h3">Games:
      <?php
      $GamesCount = $conexao->query("SELECT `Titulo` FROM `registergame` WHERE `UsuarioID`='$UserID[ID]'");
      $ResultCount = $GamesCount->fetch_all();
      echo(count($ResultCount));
      ?>
   </h3>
   <form id ="buttons" method="post"> 
               <div class="botao" >Delete</div>
               <div class="botaoUp" onclick="showthis()">Update</div>
         </form>
         <div id="UpdateForm" style= "display:none">
           <form id='update' method="post"  action="update.php" > 
           <label for="games">Edite o game:</label>
         <select class="form-control" id="chooseGame" style="max-width: 49%;" name="editGame" required>
<?php $selectGame = $conexao->query("SELECT * FROM `registergame` WHERE UsuarioID='$UserID[ID]' "); 
   while ($resultado = $selectGame->fetch_assoc()) {
?>
                  <option><?php echo $resultado["Titulo"]?>,<?php echo $resultado["Ano"] ?>  </option>
   <input value="<?php echo $resultado["Titulo"]?>" name="NameGameUP">
  <input value="<?php echo $resultado["Ano"]?>" name="YearGameUP">
  <input value="<?php echo $resultado["Plataforma"]?>" name="SystemGameUP">

               <?php
   }
   ?>
</select>
  <input type="submit" class="botaoUp" value="Enviar">

         </form>
   <!-- Section-->
   <section class="py-5">

      <?php
      $Games = $conexao->query("SELECT * FROM `registergame` WHERE UsuarioID='$UserID[ID]' ");
      while ($Result = $Games->fetch_assoc()) {
      ?>
         <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" >
               <div class="col mb-5 border border-warning">
                  <div class="card h-30">
                     <!-- Product image-->
                     <img class="card-img-top" src="<?php echo $Result["Image"]; ?>" alt="..." />
                     <!-- Product details-->
                     <div class="card-body p-4">
                        <div class="text-center">
                           <!-- Product name-->
                           <h5 class="fw-bolder"><?php echo $Result["Titulo"]; ?>
                           </h5>
                           <!-- Product system-->
                           <p>
                              <span class="console"><i class="fa-brands fa-playstation fa-beat"></i>
                                 <?php echo ($Result["Plataforma"]); ?>
                                 <i class="fa-brands fa-playstation fa-beat"></i>
                              </span>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--FALTA ESTILIZAR--> 
            
      </div>
   </div>


           </form>
           </div>
   </div>
         <?php }  ?>
      
         <button class="glow-on-hover" id="add-btn" onclick="ShowForm()" style="position: relative;left: 50%;margin: -25px 0 0 -25px;background-color:rgba(0, 7, 19,0.0);text-align: center; z-index:10;border-radius:1em "><img src="/image/add.png" style="width: 50px; height: 50px;"></button>
         </div>
   </section>
   <!-- Div Section -> Form Add Game-->
   <div id="ADD_CD" class="section" style="display: none">
      <div class="add_form">
         <form method="post" action="add_cd.php" enctype="multipart/form-data">
            <div class="form-group">
               <span class="form-label">System</span>
               <select class="form-control" id="system" style="max-width: 49%;" name="SystemGame" required>
                  <option>PS1</option>
                  <option>PS2</option>
                  <option>PS3</option>
                  <option>Xbox</option>
                  <option>Nintendo</option>
                  <option>MSX</option>
                  <option>Odyssey</option>
                  <option>MegaDrive</option>
                  <option>Atari</option>
               </select>
               <span class="select-arrow"></span>
            </div>
            <!--Game Name-->
            <div class="form-group">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <span class="form-label">Game</span>
                        <input class="form-control" id="game" name="NameGame" type="text" placeholder="Ex.:Super Mário World" required>
                     </div>
                  </div>                  <!--Game Year-->
                  <div class="col-md-6">
                     <div class="form-group">
                        <span class="form-label">Year of the Game</span>
                        <input class="form-control" id="year" type="text" name="YearGame" placeholder="Ex.:80,90,20" required>
                     </div>
                  </div>
               </div>
               <div class="col-md-2">
               </div>
            </div>
            <!--Game Image-->
            <div class="row">
               <div class="form">
                  <div class="file btn btn-lg btn-primary" style="margin-top:10px">
                     <label for="Img" class="form-label">Game Image</label> <br>
                     <div class="file btn btn-lg btn-primary">
                        <input type="file" name="Img" style="opacity: 1;" required>
                     </div>
                     <span class="select-arrow"></span>
                  </div>
               </div>
               <div class="col-md-3" style="margin-left:34%;margin-bottom:1em">
                  <div class="form-btn">
                     <button class="submit-btn">Add Game</button>
                  </div>
               </div>
         </form>
      </div>
   </div>
   <!-- Footer-->
   <footer class="py-5 bg-dark">
      <div class="container">
         <p class="m-0 text-center text-white">Copyright &copy; JPW 2023</p>
      </div>
   </footer>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- Show Form function-->
<script src="https://kit.fontawesome.com/3c9095add8.js" crossorigin="anonymous"></script>
<script>
   function ShowForm() {
      if (document.getElementById("ADD_CD").style.display !== "block") {
         document.getElementById("ADD_CD").style.display = "block";
         document.getElementById("cancel").innerHTML = "Cancel";

      } else {
         document.getElementById("ADD_CD").style.display = "none";
      }
   }
</script>
<script>
   let url = window.location.href;
   if (url.indexOf("msg=err") > 0) {

      alert("Este jogo já foi adicionado!");
      window.location.href = "index.php";
   }
</script>
   <script>
      function showthis(){
      if (document.getElementById("UpdateForm").style.display !== "block") {
         document.getElementById("UpdateForm").style.display = "block";
         
      } else {
         document.getElementById("UpdateForm").style.display = "none";
      }
   }
</script>
</html>

<!--Close conection DB-->

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

mysqli_close($conexao);
?>