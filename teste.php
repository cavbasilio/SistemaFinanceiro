<?php

  include 'conexao.php';

  $id = $_POST['id'];
  $nomeCliente = $_POST['nomeCliente'];
  
  $sql = "SELECT * FROM tblclientes";

  $retorno = $conn->prepare($sql);

  while($registro = $retorno->fetchAll()){
    $id = $registro['id'];
    $nomeCliente = $registro['nomeCliente'];

    echo "<tr>
        <td>$id</td>
        <td>$nomeCliente</td>
    </tr>";
  }
?>