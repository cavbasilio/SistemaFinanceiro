<?php
session_start();

ob_start();

include 'conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);



if(empty($id)){
    $_SESSION['msg'] = "ERR: campo vazio.";
    header("Location: consultaCliente.php");
    exit();
}

$queryUsuario = "DELETE FROM `tblclientes` WHERE idCliente = $id LIMIT 1";
$resultUsuario = $conn->prepare($queryUsuario);
$resultUsuario->execute();

if(($resultUsuario)AND($resultUsuario->rowCount() != 0)){
        $queryUsuarioCmd = "DELETE FROM `tblclientes` WHERE idCliente = $id";
        $apagarUsuario = $conn->prepare($queryUsuarioCmd);

    if($apagarUsuario->execute()){
        $_SESSION['msg'] = "ERR: Usuário Apagado.";
        header("Location: consultaCliente.php");
    
    }else{
    $_SESSION['msg'] = "ERR: Usuário PODE SER APAGADO.";
    header("Location: consultaCliente.php");
        }
    } else{
    $_SESSION['msg'] = "ERR: Usuário não encontrado.";
    header("Location: consultaCliente.php");
   
}

//$cmdDelete = $conn->prepare("DELETE FROM `tblclientes` WHERE idCliente = :id");

//$cmdDelete->bindValue('idCliente', ($linha[0] ?? "NULL"));

//$cmdDelete->execute();
?>