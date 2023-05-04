<?php
//esse codigo irá enviar o admin para onde vai editar, excluir ou adicionar system

$System= $_POST["System"];

if(isset($System)){

    if($System=="adicionar"){
        header("Location:/PHP/add_system.php");
    }
    if($System=="excluir"){
        header("Location:/PHP/exc_system.php");

    }
    if($System=="editar"){
        header("Location:/PHP/edit_system.php");
    }
}
?>