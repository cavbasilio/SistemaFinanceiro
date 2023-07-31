<?php
session_start();
require_once('conexao.php');
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
  <link rel="stylesheet" href="css/style.css" />
  <!--FONT AWESOME ICONS-->
  <script src="https://kit.fontawesome.com/ead2b86abf.js" crossorigin="anonymous"></script>

</head>

<body>
  <div class="txtCliente">
    LISTA DE CLIENTES
  </div>

  <?php
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  };
  ?>

  <form method="POST" action="consultaCliente.php">
    <div class="container">
      <label class="switch">
        <span class="switch-text">Recebido</span>
        <div class="switch-wrapper">
          <input type="checkbox" name="statusPagamento" value="Recebido" />
          <span class="switch-button">
          </span>
        </div>
      </label>
    </div>

    <div class="container">
      <label class="switch2">
        <span class="switch-text2">A Receber</span>
        <div class="switch-wrapper2">
          <input type="checkbox" name="statusPagamento" value="A Receber" />
          <span class="switch-button2"></span>
        </div>
      </label>
    </div>
    <input type="submit" value="GO">
  </form>

  <?php

  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
  $filtraRecebido = $_POST['statusPagamento'] ?? null;

  $where = '';
  $params = [];

  if ($filtraRecebido) {

    if (in_array('1', $filtraRecebido)) {
      // Adiciona o where para o 'recebido'
      $params = [];
      if (!empty($valorStatusPagamento)) {
        $where .= 'AND status_id = :status_id';
        $params['1'] = $valorStatusPagamento;
      }
    }

    if (in_array('2', $filtraRecebido)) {
      // Adiciona o where para o 'a receber'
      $where = '';
      $params = [];
      if (isset($valorStatusPagamento)) {
        $where .= 'AND status_id = :status_id';
        $params['2'] = $valorStatusPagamento;
      }
    }
  }

  $sql = "SELECT * FROM clients_payments WHERE (1=1) {$where}";
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);

  $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
  var_dump($dados);
  ?>

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
        <th scope="col">Ações</th>
      </tr>
      
    </thead>
    <?php if (count($dados) == 0) : ?>
      <tr>
        <td colspan="8" style="text-align: center;">Nenhum registro encontrado</td>
      </tr>
    <? else : ?>
      <?php foreach ($dados as $payment => $value):?>
        <tr>
          <td><?php echo $payment['id']; ?></td>
          <td><?php echo $payment['status_id']; ?></td>
          <td><?php echo $payment['maturity']; ?></td>
          <td><?php echo $payment['amount']; ?></td>
          <td><?php echo $payment['client_id']; ?></td>
          <td><?php echo $payment['paid_amount']; ?></td>
          <td><?php echo $payment['paid_at']; ?></td>
          <td><?php echo $payment['forecast_pay'];?></td>
          <td>
            <td><a class="btn btn-warning" href="editaCliente_Query.php?id=<?php echo $payment['id'] ?>" role="button"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Editar</a></td>
           <td> <a class="btn btn-info" href="atualPagam_Query.php?id=<?php echo $payment['id'] ?>" role="button"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Atualiza Prev.</a></td>
            <td><a class="btn btn-danger btn-sm" href="deletaCliente.php?id=<?php echo $payment['id'] ?>" role="button"><i class="far-fa-trash-alt"></i>&nbsp;Excluir</a></td>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tr>
</table>
</table>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
