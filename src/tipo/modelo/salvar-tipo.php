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
            $stmt = $pdo->prepare('INSERT INTO TIPO (NOME) VALUES (:a)');
            $stmt->execute(array(
    ':a' => $requestData['NOME']
));
$dados  = array(
    "tipo" => 'success',
    "mensagem" => 'Ta registrado meu consagrado'
);
        }catch(PDOException $e){
            $dados  = array(
                "tipo" => 'erro',
                "mensagem" => 'Não deu pra salvar: '.$e

        
            );
        }
    } else{
        //se a operação vir vazia fazer update
        try{
            $stmt = $pdo->prepare('UPDATE TIPO SET NOME = :a WHERE ID = :id');
            $stmt->execute(array(
                ':id' => $ID, 
    ':a' => utf8_decode($requestData['NOME'])
));
$dados  = array(
    "tipo" => 'success',
    "mensagem" => 'registro atualizado meu consagrado'

);


        }catch(PDOException $e){
            $dados  = array(
                "tipo" => 'error',
                "mensagem" => 'Não foi possivel atualizar: '.$e

        
            );
        }
    }
}

//converter o nossa array para json
echo json_encode($dados);