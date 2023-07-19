<?php

session_start();

ob_start();

include 'conexao.php';

    $arquivo = $_FILES['arquivo'];

        $linhasImportadas = 0;
        $linhasNaoImportadas = 0;
        $usuariosNaoImportados = "";
        $primeiraLinha = true;

    if($arquivo['type'] == "text/csv"){
        $dadosArquivo = fopen($arquivo['tmp_name'], "r");
        
        while($linha = fgetcsv($dadosArquivo, 30000, ";")){
            if($primeiraLinha){
                $primeiraLinha = false;
                continue;
            }
            $queryUsuario = "INSERT INTO tblclientes(idCliente, statusPg, vencimentoPg, valorAberto, nomeCliente, valorRecebido, dataPg, prevPagamento) VALUES (:idCliente, :statusPg, :vencimentoPg, :valorAberto, :nomeCliente, :valorRecebido, :dataPg, :prevPagamento)";
            
  
            $importaUsuario = $conn->prepare($queryUsuario);
            $importaUsuario->bindValue('idCliente', ($linha[0] ?? "NULL"));
            $importaUsuario->bindValue('statusPg', ($linha[1] ?? "NULL"));

                    //  Faço a formatação das datas para ler no banco de dados.
                    $vencimentoPg = $linha[2] ? DateTime::createFromFormat('d/m/Y', $linha[2])->format('Y-m-d') : null;
                        $importaUsuario->bindValue('vencimentoPg', $vencimentoPg);      
            
            $importaUsuario->bindValue('valorAberto', ($linha[3] ?? "NULL"));
     
            $importaUsuario->bindValue('nomeCliente', ($linha[4] ?? "NULL"));

            $importaUsuario->bindValue('valorRecebido', ($linha[5] ?? "NULL"));
                     //  Faço a formatação das datas para ler no banco de dados.
                    $dataPg = $linha[6] ? DateTime::createFromFormat('d/m/Y', $linha[6])->format('Y-m-d') : null;
                        $importaUsuario->bindValue('dataPg', $dataPg);
                        
                    //  Faço a formatação das datas para ler no banco de dados.
                        $prevPagamento = $linha[7] ? DateTime::createFromFormat('d/m/Y', $linha[7])->format('Y-m-d') : null;
                      $importaUsuario->bindValue('prevPagamento', $prevPagamento);

            $importaUsuario->execute();

            if($importaUsuario->rowCount()){
                $linhasImportadas++;                
            }else{
                $linhasNaoImportadas++;
                $usuariosNaoImportados = $usuariosNaoImportados . "," ($linha[0] ?? "NULL");
            }
        }

        if(!empty($usuariosNaoImportados)){
            $usuariosNaoImportados = "Usuários não importados: $usuariosNaoImportados.";
        }

        header("Location: consultaCliente.php");
        
        echo "$linhasImportadas linhas importadas, $linhasNaoImportadas linhas não importadas. $usuariosNaoImportados";

    }else{
    
        echo "Arquivo não é do tipo CSV!";
    }

?>