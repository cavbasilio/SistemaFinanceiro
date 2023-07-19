<?php

include 'conexao.php';

$nroProduto = $_POST['nroProduto'];
$nomeProduto = $_POST['nomeProduto'];
$categoria = $_POST['categoria'];
$quantidade = $_POST['quantidade'];
$fornecedor = $_POST['fornecedor'];

$sql = "INSERT INTO `estoque` (`nroProduto`, `nomeProduto`, `categoria`, `quantidade`, `fornecedor`) VALUES ($nroProduto, '$nomeProduto', '$categoria', '$quantidade', '$fornecedor')";

$inserir = mysqli_query($conexao, $sql); 
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <center>
        <h4>Produto adicionado com sucesso!</h4>
    </center>
    <div>
        <center>
            <a href="indexCurso.php" role="button" class="btn btn-sm btn-primary">Cadastrar Novo Item</a>
        </center>
    </div>