<?php
session_start();

include 'conexao.php';

ob_start();

$arquivo = $_FILES['arquivo'];

$linhasImportadas = 0;
$linhasNaoImportadas = 0;
$usuariosNaoImportados = [];
$primeiraLinha = true;

function findOrCreateCrient($id, $name)
{
    global $conn;

    $query = "SELECT * FROM clients WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue('id', $id);
    $stmt->execute();

    $client = $stmt->fetchObject();
    if ($client) {
        return $client;
    }

    $query = "INSERT INTO clients(id, name) VALUES(:id, :name)";
    $stmt = $conn->prepare($query);

    if ($stmt->execute([':id' => $id, ':name' => $name])) {
        return $stmt->fetchObject();
    }

    return null;
}

function dateToTimestamp($date)
{
    // $date = DateTime::createFromFormat('d/m/Y', $date);
    $date = strtotime($date);
    return date('Y-m-d H:i:s', $date);
}

function convertAmount($value)
{
    $value = str_replace("R$", '', $value);
    return floatval(trim($value));
}

function slugify($string)
{
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = str_replace(' ', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');

    return $string;
}

function getPaymentStatus()
{
    global $conn;

    $query = "SELECT * FROM payment_status";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $formattedArray = [];
    foreach ($result as $row) {
        $formattedArray[slugify($row['name'])] = $row['id'];
    }

    return $formattedArray;
}

if ($arquivo['type'] == "text/csv") {
    $dadosArquivo = fopen($arquivo['tmp_name'], "r");
    $paymentStatus = getPaymentStatus();

    while ($linha = fgetcsv($dadosArquivo, 30000, ";")) {

        if ($primeiraLinha) {
            $primeiraLinha = false;
            continue;
        }

        $client = findOrCreateCrient($linha[0], $linha[4]);
        if (!$client) {
            // Não criou/encontrou o cliente, precisa fazer controle aqui.
            $linhasNaoImportadas++;
            $usuariosNaoImportados[] = $linha[0] ?? "NULL";
            continue;
        }

        $query = "INSERT 
            INTO clients_payments(client_id, status_id, maturity, amount, paid_amount, paid_at) 
            VALUES(:client_id, :status_id, :maturity, :amount, :paid_amount, :paid_at)";

        if (!isset($linha[1]) || !$linha[1]) {
            // Não pode importar sem status
            $linhasNaoImportadas++;
            $usuariosNaoImportados[] = $linha[0] ?? "NULL";
            continue;
        }

        $status_id = $paymentStatus[slugify($linha[1])];
        $maturity = isset($linha[2]) && $linha[2] ? dateToTimestamp($linha[2]) : null;
        $amount = isset($linha[3]) && $linha[3] ? convertAmount($linha[3]) : null;
        $paid_amount = isset($linha[5]) && $linha[5] ? convertAmount($linha[5]) : null;
        $paid_at = isset($linha[7]) && $linha[7] ? dateToTimestamp($linha[7]) : null;

        $stmt = $conn->prepare($query);
        $result = $stmt->execute([
            ':client_id' => $client->id,
            ':status_id' => $status_id,
            ':maturity' => $maturity,
            ':amount' => $amount,
            ':paid_amount' => $paid_amount,
            ':paid_at' => $paid_at,
        ]);

        if ($result) {
            $linhasImportadas++;
            continue;
        }

        $linhasNaoImportadas++;
        $usuariosNaoImportados[] = $linha[0] ?? "NULL";
    }

    header("Location: consultaCliente.php");

    echo "$linhasImportadas linhas importadas, $linhasNaoImportadas linhas não importadas. " . implode(",", $usuariosNaoImportados);
} else {

    echo "Arquivo não é do tipo CSV!";
}
