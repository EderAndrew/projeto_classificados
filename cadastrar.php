<?php require "templates/header.php";?>

<div class="container">
<div class="cad">
<h1>Cadastre-se</h1>
</div>

<?php
require "classes/usuarios.class.php";
$u = new Usuarios($pdo);

if(isset($_POST["nome"]) && !empty($_POST["nome"])){
    $nome = addslashes($_POST["nome"]);
    $email = addslashes($_POST["email"]);
    $senha = md5(addslashes($_POST["senha"]));
    $telefone = addslashes($_POST["telefone"]);
    
    if(!empty($nome) && !empty($email) && !empty($senha)){
        if($u->cadastrar($nome, $email, $senha, $telefone)){
            ?>
            <div class="alert alert-success" role="alert">
                Usuário cadastrado com sucesso. <a href="login.php">Vá para a página de login</a>
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-warning" role="alert">
                Usuário ja esta cadastrado. <a href="login.php">Vá para a página de login</a>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="alert alert-warning" role="alert">
            Preencha todos os campos
        </div>
       <?php
    }
    
}
?>
<form method="POST" class="formulario">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" class="form-control"/>
    </div>
    <div class="form-group">
    <input type="submit" value="Cadastrar" class="btn btn-primary"/>
    </div>

</form>
</div>


<?php require "templates/footer.php"?>