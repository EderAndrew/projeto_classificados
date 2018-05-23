<?php
session_start();

global $pdo;
try{
    $pdo = new PDO("mysql:dbname=classificados;host=localhost", "root", "");
}catch(PDOException $e){
    echo "Erro de conexão - ".$e->getMessage();
    exit;
}
?>