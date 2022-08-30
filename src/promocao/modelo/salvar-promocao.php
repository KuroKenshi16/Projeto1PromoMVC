<?php
    //Obter nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    //Obter os dados enviados do formulario via $_REQUEST
    $requestData = $_REQUEST;

    //Verificção de campos obrigatórios do formulario
    if(empty($requestData['TITULO DESCRICAO DATA_INICIO DATA_FIM DATA_SORTEIO ARRECADACAO VALOR_RIFA'])){
        //Caso a variavel venha vazia do formulario, iremos retornar um erro
        $dados = array(
            "tipo" => 'error', 
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    }else {
        //Caso os campos obrigatório venham preenchido, iremos realizar o cadastro 
        $ID = isset($requestData['ID']) ? $requestData['ID'] :'';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        //Verificação para cadastro ou atualização de requistro 
        if($operacao == 'insert'){
            //Comandos para o INSERT no banco de dados se ocorerem
            try{
                $stmt = $pdo->prepare('INSERT INTO PROMOCAO (TITULO DESCRICAO DATA_INICIO DATA_FIM DATA_SORTEIO ARRECADACAO VALOR_RIFA) VALUES (:a :b :c :d :e :f :g)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['TITULO'])
                    ':b' => utf8_decode($requestData['DESCRICAO'])
                    ':c' => utf8_decode($requestData['DATA_INICIO'])
                    ':d' => utf8_decode($requestData['DATA_FIM'])
                    ':e' => utf8_decode($requestData['DATA_SORTEIO'])
                    ':f' => utf8_decode($requestData['ARRECADACAO'])
                    ':g' => utf8_decode($requestData['VALOR_RIFA'])
                    
                ));
                $dados = array(
                    "tipo" => 'success', 
                    "mensagem" => 'Registro salvo com sucesso!' 
                ); 
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error', 
                    "mensagem" => 'Não foi passível salvar o registro:'.$e 
                );
            }
        } else {
            //Se a nossa operação vir vazia, então iremos realizar UPDATE
            try{
                $stmt = $pdo->prepare('UPDATE TIPO SET TITULO = :a DESCRICAO = :b  DATAINICIO = :c DATAFIM = :d DATASORTEIO = :e ARRECADACAO = :f VALORRIFA = :g WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['TITULO'])
                    ':b' => utf8_decode($requestData['DESCRICAO'])
                    ':c' => utf8_decode($requestData['DATAINICIO'])
                    ':d' => utf8_decode($requestData['DATAFIM'])
                    ':e' => utf8_decode($requestData['DATASORTEIO'])
                    ':f' => utf8_decode($requestData['ARRECADACAO'])
                    ':g' => utf8_decode($requestData['VALORRIFA'])
                ));
                $dados = array(
                    "tipo" => 'success', 
                    "mensagem" => 'Registro atualizado com sucesso!' 
                ); 
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error', 
                    "mensagem" => 'Não foi passível atualizar o registro:'.$e 
                );
            }
        }
    }

//Converter o nosso array de retorno em uma representação JSON
echo json_encode($dados);