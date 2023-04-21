<?php
//sessao iniciada

session_start();

//conexao
$conexao = mysqli_connect("localhost", "root", "", "gamerx") or (print mysqli_connect_error());
if(isset($_POST["User"])){
$User = $_POST["User"];
$Pwd = $_POST["Pwd"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trimUser = trim($_POST["User"]);
    if (!empty($trimUser)) {
        //criar variaveis na session
        $_SESSION["User"] = $User;   
      
    }
}

}
//Verifica se existe a variavel User na session
//se nao existir a variavel User na session


//Verificar usuario
if (isset($_SESSION["User"]) && $_SESSION["User"]==trim($User)) {
    $UID = $conexao -> query("SELECT `ID` FROM `login`WHERE `Usuario` ='$_SESSION[User]'");       
    $UserID = $UID ->fetch_assoc();
    $_SESSION["ID"] = ($UserID);
    $Query = $conexao->query("SELECT * FROM `login` WHERE Usuario='$User'");

    $row = $Query->fetch_row();
    if ($row[0] > 0) {
        $Hashed_password = $conexao->query("SELECT `Senha` FROM `login` WHERE `Usuario`='$User'");
        $Pass = $Hashed_password->fetch_row();
        if (password_verify($Pwd, $Pass[0])) {
            
            if ($row[0] > 0) {
               if($row[1]=="Admin"){
                header("location:/PHP/indexMaster.php");
            }else{
                header("location:/PHP/index.php");
            }
            }
             else {
                header("location:/HTML/Login.html");
            }
        } else {
            header("location:/HTML/Login.html");
        }
    } else {
        header("location:/HTML/Login.html");
    }
} else {
    header("location:/HTML/Login.html");
}



mysqli_close($conexao);
?>