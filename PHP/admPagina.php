<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="adm.css">
</head>
<body>
    <div id='white'>
        <form method="post">
            <input type="text" name="cartucho">
            <input type="text" name="date">
            <input type="text" name="numeroSistemas">
            <input type="submit">
        </form>
        <?php
        //conexao com o banco de dados gamerx
        $conexao = mysqli_connect("localhost", "root", "", "gamerx") or die(mysqli_connect_error());
        //ver se há o name
        if (isset($_POST['cartucho'])) {
            $cartuchoDemanda = $_POST['cartucho'];
            //seleciona o usuarioid do cartucho que o adm solicitou
            $cartuchoBanco = $conexao->query("SELECT `UsuarioID` FROM `registergame` WHERE `Titulo`='$cartuchoDemanda'");
            if ($cartuchoBanco->num_rows > 0) {
                while ($row = $cartuchoBanco->fetch_assoc()) {
                    $userID =  $row["UsuarioID"] ;
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
            //seleciona o nome do usuario com base no usuarioid anterior
           $nomeUser = $conexao->query("SELECT `Usuario` FROM `login` WHERE `UsuarioID` = '$userID'");
                       if ($nomeUser->num_rows > 0) {
                while ($row = $nomeUser->fetch_assoc()) {
                    echo $row["Usuario"] ;
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        }
        ?>
<?php
//conexao com banco
$conexao = mysqli_connect("localhost", "root", "", "gamerx");
//função do sql para encontrar o maior numero dentro de uma coluna/tabela
$resultado = mysqli_query($conexao, "SELECT MAX(ano) AS max_ano FROM registergame");
if ($resultado) {
    $linha = mysqli_fetch_assoc($resultado);
    $max_ano = $linha['max_ano'];
            if (isset($_POST['cartucho'])) {
            $userAno= $conexao->query("SELECT `UsuarioID` FROM `registergame` WHERE `Ano`='$max_ano'");
            if ($userAno->num_rows > 0) {
                while ($row = $userAno->fetch_assoc()) {
                    $useranoMaior =  $row["UsuarioID"] ;
                }
            }
           $nomeUser = $conexao->query("SELECT `Usuario` FROM `login` WHERE `UsuarioID` = '$useranoMaior'");
                       if ($nomeUser->num_rows > 0) {
                while ($row = $nomeUser->fetch_assoc()) {
                    echo $row["Usuario"] ;
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        }
    echo "O maior ano encontrado na tabela é: " . $max_ano." e o Usuario do Game é:".$row["Usuario"];
} else {
    echo "Erro ao consultar o banco de dados";
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
    </div>
</body>
</html>

