<?php require "templates/header.php"; ?>
<?php 
//Para que outros usuários não acessem a página
if(empty($_SESSION["cLogin"])){
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
    <?php
    exit;
}
?>
<div class="container">
    <h1>Meus Anúncios</h1>

    <a href="add_anuncio.php" class="btn btn-primary">Adicionar Anúncio</a><br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php
        require "classes/anuncios.class.php";
        $a = new Anuncios();
        $anuncios = $a->getMeusAnuncios();

        foreach($anuncios as $anuncio):
            ?>
            <tr>
                <td>
                    <?php if(!empty($anuncio['url'])):?>
                        <img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" />
                    <?php else:?>
                        <img src="assets/images/anuncios/default.jpg" height="50" border="0" />
                    <?php endif;?>
                </td>
                <td><?php echo $anuncio["titulo"]; ?></td>
                <td>R$ <?php echo number_format($anuncio["valor"], 2);?></td>
                <td>
                    <a href="editar-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="excluir-anuncio.php?id=<?php echo $anuncio['id']; ?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
</div>
<?php require "templates/footer.php"; ?>