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
      <style>
         form {
         margin-left: 29%;
         border: 2px solid #ccc;
         padding: 20px;
         border-radius: 10px;
         width: 500px;
         display: flex;
         flex-direction: column;
         align-items: center;
         }
         label {
         margin-bottom: 10px;
         color: #380081;
         }
         input[type="submit"] {
         background-color: #4CAF50;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
         }
         input[type="submit"]:hover {
         background-color: rgba(76, 175, 80, 0.5);
         }
         input[type="radio"] {
         -webkit-appearance: none;
         -moz-appearance: none;
         appearance: none;
         border: 2px solid #4CAF50;
         border-radius: 50%;
         width: 20px;
         height: 20px;
         transition: 0.3s;
         outline: none;
         }
         input[type="radio"]:checked {
         background-color: #4CAF50;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(0, 5, 19);">
         <div class="container px-4 px-lg-5 ">
            <a class="navbar-brand" style="color:#380081;text-transform:uppercase;font-size:250%">JPW</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                  <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php" style="color:gold">Home</a></li>
                  <li class="nav-item"><a class="nav-link active" aria-current="page" href="add_sys-Home.php" style="color:white">Back</a></li>
               </ul>
            </div>
         </div>
         <a href="/PHP/SessionRestart.php" class="btn btn-outline-danger" style="margin-right:1em">
         <span class="glyphicon glyphicon-log-out"></span> <i class="fa fa-sign-out" aria-hidden="true" style="margin-right:5px"></i></a>
      </nav>
      <form action="" method="post" style="margin-top:1em">
         <label for="newname">Editar Sistema</label>
         <select class="form-control" id="system" style="max-width: 49%;margin-bottom:5px" name="SystemEdit" required>
            <?php
               $Plataforms = $conexao->query("SELECT `name` FROM `System`");
               $Plataforms = $Plataforms->fetch_all();
               $pos = 0;
               while ($Plataforms[$pos] != null) {
               ?>
            <option><?php echo implode($Plataforms[$pos]);
               ?>
            </option>
            <?php
               $pos = $pos + 1;
               }
               var_dump($Plataforms);
               ?>
         </select>
         <input type="text" name="newname" required>
         <input type="text" value="<?php echo $SystemEdit ?>" required hidden>
         <input class="btn btn-tech" type="submit" value="Enviar" style="margin-top:10px">
      </form>
      <?php
         $conexao = mysqli_connect("localhost", "root", "", "gamerx") or print(mysqli_connect_error());
         if (isset($_POST["SystemEdit"])) {
             $SystemEdit = $_POST["SystemEdit"];
         }
         ?>
   </body>
</html>
<?php
($conexao = mysqli_connect("localhost", "root", "", "gamerx")) or
    (print mysqli_connect_error());

if (isset($_POST["newname"]) && trim($_POST["newname"]) !== "") {
    $System = $_POST["newname"];
    $Plataforms = $conexao->query(
        "SELECT `name` FROM `system` WHERE `name`='$_POST[newname]'"
    );
    $Plataforms = $Plataforms->fetch_row();
    if ($Plataforms[0] != $_POST["newname"]) {
        $Udpate = "UPDATE `System` SET `name`='$System' WHERE `name` = '$SystemEdit'";
        if (mysqli_query($conexao, $Udpate)) { ?>
<script>
   // erro ao usar header("location:/PHP/index.php");. substituido por script
   let url = window.location.href;
   window.location.href = "add_sys-Home.php";
</script>
<?php }
        mysqli_close($conexao);
    }
}
?>
