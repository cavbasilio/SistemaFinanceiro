<?php
    include 'conexao.php';
    $id = $_GET['id'];


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
              <!--Fonte Poppins-->
   <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />

                <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"/>
               
                <!-- Only CSS -->
    <link rel="stylesheet" href="css/styleCurso.css"/>  

</head>
<body>
        <div class="container" id="divCenter">
                <h4>Formulário de Cadastro</h4>
            <form action="inserirProduto.php" method="POST" id="form">
                <?php
                    $sql = "SELECT * FROM `estoque` WHERE idEstoque = $id";
                    $buscar = mysqli_query($conexao, $sql);
                    while($array = mysqli_fetch_array($buscar)){
                     $idEstoque = $array['idEstoque'];
                     $nroProduto = $array['nroProduto'];
                     $nomeProduto = $array['nomeProduto'];
                     $categoria = $array['categoria'];
                     $quantidade = $array['quantidade'];
                     $fornecedor = $array['fornecedor'];
                    
                ?>
                <div class="form-group">
                    <label>Número do Produto</label>
                    <input type="number" class="form-control" name="nroProduto" value="<?php echo $nroProduto?>" disabled>
                </div>
            
                <div class="form-group">
                    <label>Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" value="<?php echo $nomeProduto?>">
                </div>
                
                <div class="form-group">
                    <label>Categoria</label>
                    <select class="form-control" id="" name="categoria" value="<?php echo $categoria?>">
                    <option>Periféricos</option>
                    <option>Hardwares</option>
                    <option>Softwares</option>
                    <option>Mobiles</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" name="quantidade"value="<?php echo $quantidade?>">
                </div>

                <div class="form-group">
                    <label>Fornecedor</label>
                    <select class="form-control" value="<?php echo $fornecedor?>">
                    <option>Fornecedor A</option>
                    <option>Fornecedor B</option>
                    <option>Fornecedor C</option>
                    <option>Fornecedor D</option>
                    </select>
                </div>
                <button type="submit" id="botaoCad"class="btn btn-sm">Cadastrar</button>
            <?php
                }
            ?>
            </form>
        </div>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>