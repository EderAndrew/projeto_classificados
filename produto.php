<?php require "templates/header.php";?>
<?php
    require "classes/anuncios.class.php";
    
    $a = new Anuncios();
    $u = new Usuarios();

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = addslashes($_GET["id"]);
    }else{
        ?>
        <script type="text/javascript">window.location.href="index.php";</script>
        <?php
        exit;
    }
    
    $info = $a->getAnuncio($id);

?>

<section>
    <div class="container">
        <h1><?php echo $info['titulo']; ?></h1>
        <div class="row">
            <div class="col-sm-4">
                <div id="carousel_product" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php foreach($info['fotos'] as $chave => $foto): ?>
                        <div class="carousel-item <?php echo ($chave=='0')?'active':''; ?>">
                            <img class="d-block w-100" src="assets/images/anuncios/<?php echo $foto['url']; ?>" style="width: 250px; height: 250px"/>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carousel_product" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel_product" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-sm-8">
                <h2><?php echo $info['titulo']; ?></h2>
                <h4><?php echo utf8_encode($info['categoria']); ?></h4>
                <p><?php echo utf8_encode($info["descricao"]); ?></p>
                <br>
                <h3>R$ <?php echo number_format($info["valor"], 2); ?></h3>
                <h4>Telefone: <?php echo $info["telefone"]; ?></h4>
            </div>
        </div>
    </div>
</section>
<?php require "templates/footer.php";?>