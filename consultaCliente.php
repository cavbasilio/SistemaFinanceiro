  <?php
  include 'conexao.php';
  
  session_start();
   ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
            <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <!-- Only CSS -->
    <link rel="stylesheet" href="css/style.css"/>  
            <!--FONT AWESOME ICONS-->
    <script src="https://kit.fontawesome.com/ead2b86abf.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="txtCliente">
        LISTA DE CLIENTES
    </div>
      <?php
        if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        };

     
?>

<form method="POST" action="consultaCliente.php">
      <div class="container">
        <label class="switch"> 
          <span class="switch-text">Recebido</span>
            <div class="switch-wrapper">
              <input type="checkbox" name="statusPagamento" value="Recebido"/>
              <span class="switch-button">
            </span>
          </div>
        </label>
      </div>

      <div class="container">
        <label class="switch2"> 
          <span class="switch-text2">A Receber</span>
            <div class="switch-wrapper2">
              <input type="checkbox" name="statusPagamento" value="A Receber"/>
            <span class="switch-button2"></span>
          </div>
        </label>
      </div>
      <input type="submit" value="GO">
</form>
<?php

include ('conexao.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $filtraRecebido = $_POST['statusPagamento'];

      if (in_array('Recebido', $filtraRecebido)) {
            // Adiciona o where para o 'recebido'
          $where = '';
          $params = [];
              if (!empty($valorStatusPagamento)) {
                $where .= 'AND statusPg = :statusPg';
                $params['Recebido'] = $valorStatusPagamento;
        }
      }
        
        if (in_array('A Receber', $filtraRecebido)) {
            // Adiciona o where para o 'a receber'
            $where = '';
            $params = [];
                if (isset($valorStatusPagamento)) {
                  $where .= 'AND statusPg = :statusPg';
                  $params['A Receber'] = $valorStatusPagamento;
        }
      }

        $sql = "SELECT * FROM tblclientes WHERE (1=1) {$where}";
        $resulStatus = $conn->prepare($sql);
        $resulStatus->execute($params);

while($linha = $resulStatus->fetch(PDO::FETCH_ASSOC)){
        $statusPg = $linha['statusPg'];
    }
    
    var_dump($dados);
  
?>

</form>
<!--<form method="POST" action="processa.php" enctype="multipart/form-data">
      <span class="filtraNome">Nome:</span>
      <input type="text"  name="nomeaa" placeholder="Digite o nome...">
      <span class="filtraNome">ID:</span>
      <input type="text" name="id" placeholder="Digite o ID...">
      <input type="submit" value="Enviar">
</form>-->

<form method="POST" action="processa.php" enctype="multipart/form-data">

    <div class="input-group">
        <div class="custom-file">
          <input type="file" name="arquivo" class="custom-file-input">
          <label class="custom-file-label">Seleciona Arquivo</label>
    </div>
    
    <div class="input-group-append">
      <button class="btn btn-success" type="submit">Enviar</button>
    </div>
</form>
    </div>

    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Status</th>
      <th scope="col">Vencimento</th>
      <th scope="col">Valor Aberto</th>
      <th scope="col">Cliente</th>
      <th scope="col">Valor Recebido</th>
      <th scope="col">Data do pagamento</th>
      <th scope="col">Previsão de Pagamento</th>
      <th scope="col">Editar</th>
      <th scope="col">Atualizar</th>
    </tr>
    </thead>
  <tr>
<?php
      include 'conexao.php';
        
        $sql= "SELECT * FROM `tblclientes` ORDER BY idCliente";
          $resultadoContado = $conn->prepare($sql);
          $resultadoContado->execute();

      while($array = $resultadoContado->fetch(PDO::FETCH_ASSOC)){
          $idCliente = $array['idCliente'];
          $statusPg = $array['statusPg'];
          $vencimentoPg = $array['vencimentoPg'];
          $valorAberto = $array['valorAberto'];
          $nomeCliente = $array['nomeCliente'];
          $valorRecebido = $array['valorRecebido'];
          $dataPg = $array['dataPg'];
          $prevPagamento = $array['prevPagamento'];
?>
    
    <tr>
            <td><?php echo $idCliente ?></td>
            <td><?php echo $statusPg ?></td>
            <td><?php echo $vencimentoPg ?></td>
            <td><?php echo $valorAberto ?></td>
            <td><?php echo $nomeCliente ?></td>
            <td><?php echo $valorRecebido ?></td>
            <td><?php echo $dataPg ?></td>
            <td><?php echo $prevPagamento ?></td>

            <td><a class="btn btn-warning" href="editaCliente_Query.php?id=<?php echo $idCliente ?>" role="button"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Editar</a></td>
            <td><a class="btn btn-info" href="atualPagam_Query.php?id=<?php echo $idCliente ?>" role="button"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Atualiza Prev.</a></td>
            <td><a class="btn btn-danger btn-sm" href="deletaCliente.php?id=<?php echo $idCliente ?>" role="button"><i class="far-fa-trash-alt"></i>&nbsp;Excluir</a></td>

          </tr>
   <?php } 
 ?>

    </tr>
</table>
</table>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
