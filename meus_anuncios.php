<?php require "templates/header.php"; ?>
<?php 
//Para que outros usuários não acessem a página
if(empty($_SESSION["cLogin"])){
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
    <?php
}
?>
<div class="container">
    <h1>Meus Anúncios</h1>

    <a href="add_anuncio.php" class="btn btn-primary">Adicionar Anúncio</a><br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulos</th>
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
                <td><img src="assets/images/anuncios/<?php echo $anuncio['url']?>" border="0" /></td>
                <td><?php echo $anuncio["titulo"]; ?></td>
                <td><?php echo number_format($anuncio["valor"], 2);?></td>
            </tr>
            <?php endforeach; ?>
    </table>
</div>
<?php require "templates/footer.php"; ?>