<?php
//PDO - PHP Data Objects
//Credenciais do Banco 
$host = '10.127.0.185';
$dbname = 'phpt_julio_a';
$usarname = 'phpt_julio_a';
$password = '2024@julio';

//Criar e instanciar a conexão
try{
    //Criar a conexão com o banco
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Configura o modo de erro para permitir exceções
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Define o modo de fetch para associativo
        PDO::ATTR_EMULATE_PREPARES => false,
        //Desativa a emulação de prepared statements por segurança
    ];
    //Instanciar a conexão
    $pdo = new PDO($dsn, $usarname, $password, $options);
} catch (PDOException $e){
    //Captura e Exibi os erros da conexão
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}