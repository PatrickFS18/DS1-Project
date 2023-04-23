<?php
session_start();
($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
    (print mysqli_connect_error());
$UserID = $_SESSION["ID"];
$UserID = $UserID["ID"];

if (isset($UserID) && is_string($UserID)) {
    $UserID = $_SESSION["ID"];
    $UserID = $UserID["ID"];
}
if (!empty($_POST["UpdateHidden"]) || !empty($_SESSION["GameID"])) {
    if (!empty($_POST["UpdateHidden"])) {
        $_SESSION["GameID"] = $_POST["UpdateHidden"];
    }
    $GameID = $_SESSION["GameID"];

    $query = "SELECT * FROM registergame WHERE ID = '$GameID'";
    $result = mysqli_query($conexao, $query);
    $row = mysqli_fetch_array($result);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>

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

  

label {
width: 100px;
margin-right: 3em;
font-family: Arial, sans-serif;
font-weight: bold;
color:antiquewhite
}

header {
      background-color: #191970;
      color: #fff;
      position:absolute;
      z-index: 1;
      display: inline-block;
      position: static;
      top: 70px;
      bottom:70px;
      left: 0;
    
      padding: 20px 0;
      background-color:#B0E0E6;

  }

  h1 {
color: #ffd700;
font-size: 36px;
margin: 0 auto;
white-space: nowrap;
overflow: hidden;
text-align: center;
animation: move-text 6s linear infinite;
position: static;
}
ul {
    list-style-type: none; /* remove a bolinha */
  margin: auto;
  width: 50%;
  background-size: cover;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:rgb(0, 7, 19);">
      <div class="container px-4 px-lg-5 ">
         <a class="navbar-brand" style="color:#380081;text-transform:uppercase;font-size:250%">JPW</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
               <li class="nav-item"><a class="nav-link active" aria-current="page" href="" style="color:gold">Home</a></li>
               <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php if (
                   $_SESSION["User"] == "admin"
               ) {
                   echo "/PHP/indexMaster.php";
               } ?>" style="color:gold;">Research</a></li>
            </ul>

         </div>
      </div>
      <a href="/PHP/SessionRestart.php" class="btn btn-outline-danger" style="margin-right:1em">
         <span class="glyphicon glyphicon-log-out"></span> <i class="fa fa-sign-out" aria-hidden="true" style="margin-right:5px"></i></a>
   </nav>
<div id="UpdateForm">
           <form id='update' method="post" action="update.php" enctype="multipart/form-data"> 
           <ul>
  <li style="margin-bottom: 10px;">
    <label for="NameGameUP" style="font-family: Arial, sans-serif; font-weight: bold; display: inline-block; width: 80px;">Título:</label>

<input value="<?php if (isset($row["Titulo"])) {
       echo $row["Titulo"];
   } elseif (isset($_POST["NameGameUP"])) {
       echo $_POST["NameGameUP"];
   } ?>" name="NameGameUP" required>
</li>
  <li style="margin-bottom: 10px;">
  <label for="YearGameUP" style="font-family: Arial, sans-serif; font-weight: bold; display: inline-block; width: 80px;">Ano:</label>
  <input value="<?php if (isset($row["Ano"])) {
      echo $row["Ano"];
  } elseif (isset($_POST["YearGameUP"])) {
      echo $_POST["YearGameUP"];
  } ?>" name="YearGameUP" required>

</li>
  <li style="margin-bottom: 10px;">
  <label for="SystemGameUP" style="font-family: Arial, sans-serif; font-weight: bold; display: inline-block; width: 80px;">Plataforma:</label>
  <input value="<?php if (isset($row["Plataforma"])) {
      echo $row["Plataforma"];
  } elseif (isset($_POST["SystemGameUP"])) {
      echo $_POST["SystemGameUP"];
  } ?>" name="SystemGameUP" required>

</li>
 
  <input type="file"  name="ImageGameUP">
  <input type="hidden" value ="<?php echo $_SESSION["GameID"]; ?>" name="IDgame" required>

  <input type="hidden" value ="<?php echo $row["Image"]; ?>" name="ImgBD">


<input type="submit" class="botaoUp" value="Enviar">
         </form>
        
         <h1><img src="<?php echo $row["Image"]?>" alt="" name="ImgBD"></h1>
</body>
</html>

<?php if (
    isset($_POST["YearGameUP"], $_POST["SystemGameUP"], $_POST["NameGameUP"]) AND (isset($_POST["ImgBD"]) or isset($_FILES["ImageGameUP"])))
 {
    if (!empty($_SESSION["GameID"])) {
        $NameGame = $_POST["NameGameUP"];
        $YearGame = $_POST["YearGameUP"];
        $SystemGame = $_POST["SystemGameUP"];
        $tela = $_FILES["ImageGameUP"];
        $dir = "../Image/ImageBD/";
        if(isset($tela)){
            $nameimage = $dir . $NameGame . $YearGame . $SystemGame . ".jpg";
            $nameimageBD = $dir . $NameGame . $YearGame . $SystemGame .".jpg";
              move_uploaded_file($tela["tmp_name"], $nameimage); //Fazer upload do arquivo
        
            $Insert = "UPDATE `registergame` SET `Titulo`= '$NameGame', `Plataforma` = '$SystemGame', `Ano` = '$YearGame', `Image`= '$nameimageBD' WHERE `ID` = '$GameID'";

        }else{
            $Insert = "UPDATE `registergame` SET `Titulo`= '$NameGame', `Plataforma` = '$SystemGame', `Ano` = '$YearGame' WHERE `ID` = '$GameID'";

        } 
        
        
        if (mysqli_query($conexao, $Insert)) { 
         header("Location:/PHP/index.php?msg=Y");
        
     
     }
    }
}
?>


