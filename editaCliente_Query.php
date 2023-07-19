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
<form action="atualizaCliente.php" method="POST" id="form">
                <?php
                    $sql = "SELECT * FROM `tblclientes` WHERE idCliente = $id";
                        $resultado = $conn->prepare($sql);
                        $resultado->execute();

                    while($array = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $idCliente = $array['idCliente'];
                    $statusPg = $array['statusPg'];
                ?>

                <div class="form-group">
                    <label>ID CLIENTE</label>
                    <input type="number" class="form-control" name="idCliente" value="<?php echo $idCliente?>" disabled>
                     <input type="number" class="form-control" name="id" value="<?php echo $id?>" style="display: none" >    
                </div>

                
                <div class="form-group">
                    <label>STATUS DO PAGAMENTO</label>
                    <select class="form-control" id="" name="statusPg" value="<?php echo `$statusPg`?>">
                    <option>Recebido</option>
                    <option>A Receber</option>
                    </select>
                </div>

                <button type="submit" id="botaoCad" class="btn btn-sm">Atualizar</button>
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