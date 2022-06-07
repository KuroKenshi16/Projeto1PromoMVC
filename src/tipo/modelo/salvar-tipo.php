<?php

   //Obtem a conexão com o banco de dados
   include('../../conexao/conn.php');

   //Recebe dados enviados do formulário via $_REQUEST
   $requestData = $_REQUEST;

   //Verifica campos obrigatórios 
   if(empty($requestData['NOME'])){
       //Caso variavel esteja vazia
       $dados = array(
           "tipo" => 'error',
           "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
       );
    } else {
        //Caso os campos obrigatórios venham preenchidos, iremos reaizar o cadastro
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao - isset($requestData['operacao']) ? $requestData['operacao'] : '';

        //Verifica cadastro ou atualização de registro
        if($operacao == 'insert') {
            //Comando INSERT para SQL
            try{
                $stmt = $pdo->('INSERT INTO TIPO (NOME) VALUES (:a)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'sucess',
                    "mensagem" => 'Salvo com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível salvar registro: '.$e
                );
            }
        } else {
            //Se operação vir vazia será realizado um UPDATE
            try{
                $stmt = $pdo->('UPDATE TIPO SET NOME = :a WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'sucess',
                    "mensagem" => 'Salvo com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível atualizar registro: '.$e
                );
            }
        }
    }

   //Converte array de retorno em JSON
   echo json_encode($dados);