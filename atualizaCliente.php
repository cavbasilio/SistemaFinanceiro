<?php

include 'conexao.php';

    $id = $_POST['id'];
    $statusPg = $_POST['statusPg'];
       $sql = "UPDATE `tblclientes` SET `statusPg` = '$statusPg' WHERE idCliente = $id";
       
        $queryUsuario = $conn->prepare($sql);
        $queryUsuario->execute();

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
<div class="container" style="width: 400px">
<center>
    <h3>DADOS ATUALIZADOS COM SUCESSO!</h3>
    <div style="margin-top: 10px">
    <a href="consultaCliente.php" class="btn btn-sm btn-warning" style="color:#fff"> Voltar</a>
</center>
          
</div>
