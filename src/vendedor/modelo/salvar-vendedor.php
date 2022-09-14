<?php

//obter a conexão com o banco
include('../../conexao/conn.php');

//obter os dados enviados do formulario
$requestData = $_REQUEST;

//vrificação de campos obrigatorios
if(empty($requestData['NOME'])){
    //variavel vazia retornar erro
    $dados  = array(
        "tipo" => 'error',
        "mensagem" => 'O meu consagrado me ajuda a te ajudar completa os bagui.'

    );


} else {
    //se estiver preenchidos
    $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
    $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

    //verificação cadastro
    if($operacao == 'insert'){
        //insert banco
        try{
            $stmt = $pdo->prepare('INSERT INTO VENDEDOR (NOME, CELULAR, LOGIN, SENHA, TIPO_ID) VALUES (:a,
            :b, :c, :d, :e)');
            $stmt->execute(array(
                    ':a' =>  $requestData['NOME'],
                    ':b' =>  $requestData['CELULAR'],
                    ':c' =>  $requestData['LOGIN'],
                    ':d' =>  md5 ($requestData['SENHA']),
                    ':e' =>  $requestData['TIPO_ID']
            ));
$dados  = array(
    "tipo" => 'success',
    "mensagem" => 'Ta registrado meu consagrado'

);
        } catch(PDOException $e){
            $dados  = array(
                "tipo" => 'erro',
                "mensagem" => 'Não deu pra salvar: '.$e        
            );
        }
    } else {
        //Se minha variavel operação estiver vazia então devo gerar os scripts de update
        try{
            $stmt = $pdo->prepare('UPDATE VENDEDOR SET NOME = :a, CELULAR = :b, LOGIN = :c, SENHA = :d,
            TIPO_ID = :e WHERE ID = :id');
            $stmt->execute(array(
                ':id' => $ID,
                ':a' =>  $requestData['NOME'],
                ':b' =>  $requestData['CELULAR'],
                ':c' =>  $requestData['LOGIN'],
                ':d' =>  md5 ($requestData['SENHA']),
                ':e' =>  $requestData['TIPO_ID']
            ));

//converter o nossa array para json
echo json_encode($dados);