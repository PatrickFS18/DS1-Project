<?php
//sessao iniciada
session_start();

$User=$_POST['User'];
$Pwd = $_POST['Pwd'];

if (isset($_SESSION['User'],$_SESSION['Pwd'])){
   

}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty(trim($User) && trim($Pwd))){
    $_SESSION['User'] = trim($User);
    $_SESSION['Pwd'] = trim($Pwd);
    header("location:index.php");    
}
        }
//conexao
$conexao = mysqli_connect("localhost","root","","gamerx") or print(mysqli_connect_error());

//Verificar usuario

$Query = $conexao->query ("SELECT * FROM `login` WHERE Usuario='$User'");

$row=$Query->fetch_row();
if ($row[0]>0){
    $Hashed_password = $conexao->query ("SELECT `Senha` FROM `login` WHERE `Usuario`='$User'");
    $Pass=$Hashed_password->fetch_row();
if (password_verify($Pwd,$Pass[0])){
    if($row[0]>0) {
        header("location:/PHP/index.php");
    }else{
        header("location:/HTML/Login.html");
}
} else{
    header("location:/HTML/Login.html");
} 
    }else{
        header("location:/HTML/Login.html");
    }


/*
elseif($_SERVER['REQUEST_METHOD']=="POST"){
$trimUser= trim($_POST['User']);
if(!empty($trimUser)){
$_SESSION['User']=$_POST['User'];
}
*/ 
//$QSession= $conexao->query ("SELECT count(1) FROM `Login` WHERE Usuario='$_SESSION[User]' AND Senha /*Usar mesma validação de Login*/ ='$_SESSION[Pwd]'");
//$Qrow=$QSession->fetch_row();
//

/*
Criar -> tabela Cartuchos adicionados -> 
Criar -> tablela Pessoas com cartuchos 
-Adaptar tela a epoca
*/
?>