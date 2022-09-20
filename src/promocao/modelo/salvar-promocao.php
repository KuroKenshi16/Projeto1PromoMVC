<?php

   // obter a conexão com o banco de dados
   include('../../conexao/conn.php');

   // obter os dados enviados do formulário via $_REQUEST
   $requestData = $_REQUEST;

   // verificação de campos obrigatórios
   if(empty($requestData['TITULO']) || empty($requestData['DESCRICAO']) || empty($requestData['DATA_INICIO'])
   || empty($requestData['DATA_FIM']) || empty($requestData['DATA_SORTEIO'])
   || empty($requestData['VALOR_RIFA'])){
       // caso a variável venha vazia do formulário, devolver/retornar um erro
       $dados = array(
           "tipo" => 'error',
           "mensagem" => 'Existe campos obrigatórios não preenchidos.'
       );
   } else {
       // caso os campos obrigatórios estejam preenchidos, iremos realizar o cadastro
       $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
       $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';


       // verificação para cadastro ou avaliação de registro
       if($operacao == 'insert') {
           // comandos para o INSERT no banco de dados ocorrerem
           try{
               $stmt = $pdo->prepare('INSERT INTO PROMOCAO (TITULO, DESCRICAO, DATA_INICIO, DATA_FIM,
               DATA_SORTEIO, VALOR_RIFA) VALUES (:a, :b, :c, :d, :e, :f)');
               $stmt->execute(array(
                   ':a' => utf8_decode($requestData['TITULO']),
                   ':b' => utf8_decode($requestData['DESCRICAO']),
                   ':c' => utf8_decode($requestData['DATA_INICIO']),
                   ':d' => utf8_decode($requestData['DATA_FIM']),
                   ':e' => utf8_decode($requestData['DATA_SORTEIO']),
                   ':f' => utf8_decode($requestData['VALOR_RIFA']),
               ));
               $dados = array(
                "tipo" => 'success',
                "mensagem" => 'Registro salvo com sucesso'
            );
           } catch(PDOException $e) {
            $dados = array(
                "tipo" => 'error',
                "mensagem" => 'Não foi possível salvar o registro: '.$e
            );
           }
       } else {
           // se a operação vir vazia, então iremos realizar um UPDATE
           try{
            $stmt = $pdo->prepare('UPDATE PROMOCAO SET TITULO = :a WHERE ID = :id, DESCRICAO = :b WHERE ID = :id,
            DATA_INICIO = :c WHERE ID = :id, DATA_FIM = :d WHERE ID = :id, DATA_SORTEIO = :e WHERE ID = :id,
        VALOR_RIFA = :f WHERE ID = :id');
            $stmt->execute(array(
                ':id' => $ID,
                ':a' => utf8_decode($requestData['TITULO']),
                ':b' => utf8_decode($requestData['DESCRICAO']),
                ':c' => utf8_decode($requestData['DATA_INICIO']),
                ':d' => utf8_decode($requestData['DATA_FIM']),
                ':e' => utf8_decode($requestData['DATA_SORTEIO']),
                ':f' => utf8_decode($requestData['VALOR_RIFA']),
            ));
            $dados = array(
             "tipo" => 'success',
             "mensagem" => 'Registro atualizado com sucesso'
         );
        } catch(PDOException $e) {
         $dados = array(
             "tipo" => 'error',
             "mensagem" => 'Não foi possível atualizar o registro: '.$e
         );
       }
   }
}


   // converter o array de retorno em uma representação JSON
   echo json_encode($dados);