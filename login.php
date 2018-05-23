<?php require "templates/header.php";?>
<div class="container">
    <div class="log">
    <h1>Fazer login</h1>
    </div>
    
    <?php
    require "classes/usuarios.class.php";
    $u = new Usuarios();

    if(isset($_POST["email"]) && !empty($_POST["email"])){
        $email = addslashes($_POST["email"]);
        $senha = md5(addslashes($_POST["senha"]));

        if($u->logar($email, $senha)){
            ?>
            <script type="text/javascript">window.location.href="./"</script>
            <?php
        }else{
            ?>
            <div class="alert alert-danger">
                Usuário e/ou senha incorretos
            </div>
            <?php
        }
    }
    ?>
    <form method="POST" class="formulario">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" class="form-control" />
    </div>
    <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="senha" name="senha" id="senha" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" value="Acessar" class="btn btn-primary" />
    </div>
    </form>
</div>


<?php require "templates/footer.php";?>