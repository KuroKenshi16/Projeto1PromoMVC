<?php

    // Carregar as credencias do banco de dados
    $hostname = "sql300.epizy.com";
    $database = "epiz_31642488_sistema_de_controle_de_rifas";
    $user = "epiz_31642488";
    $password = "ULuWksPalsBIWmI";

    try{
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $password);
        $pdo->setAttriute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexão com o banco de dados '.$database.', foi realizado com sucesso!';

    } catch (PDOException $e) {
       echo 'Erro: '.$e->getMessage();
    }