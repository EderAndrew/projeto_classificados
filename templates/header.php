<?php require "config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Classificados</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/normalize.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container" id="menu">
                    <a class="navbar-brand" href="index.php">Classificados</a>
                    <div class="navbar-nav ml-auto">
                        <?php
                            require "classes/usuarios.class.php";
                            $u = new Usuarios();
                            
                            if(isset($_SESSION["cLogin"]) && !empty($_SESSION["cLogin"])):
                        ?>
                        <p class="cliente">Olá, <?= Usuarios::getNome($_SESSION['cLogin']);?></p>
                        <a class="nav-item nav-link" href="meus_anuncios.php">Meus Anúncios</a>
                        <a class="nav-item nav-link" href="sair.php">Sair</a>
                        <?php else:?>
                        <a class="nav-item nav-link" href="cadastrar.php">Cadastre-se</a>
                        <a class="nav-item nav-link" href="login.php">Login</a>
                        <?php endif;?>
                    </div>
                </div>
            </nav>
    </header>
    