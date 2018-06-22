<?php require "templates/header.php"; ?>
<?php
    if(empty($_SESSION["cLogin"])){
        header("Location: login.php");
        exit;
    }

    require "classes/anuncios.class.php";
    $a = new Anuncios();

    if(isset($_POST["titulo"]) && !empty($_POST["titulo"])){
        $titulo = addslashes($_POST["titulo"]);
        $categoria = addslashes($_POST["categoria"]);
        $valor = addslashes($_POST["valor"]);
        $descricao = addslashes($_POST["descricao"]);
        $estado = addslashes($_POST["estado"]);
        //caso não ocorra nenhum envio de fotos...
        if(isset($_FILES["fotos"])){
            $fotos = $_FILES["fotos"];
        } else{//ja conseidera como vazio
            $fotos = array();
        }
    
        $a->editAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']);
        ?>
        <div class="alert alert-success">Produto editado com sucesso!</div>
        <?php
    }

    //Verificar se tem algum produto pra editar
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $info = $a->getAnuncio($_GET["id"]);
    } else{
        ?>
    <script type="text/javascript">window.location.href="login.php";</script>
    <?php
    exit;
    }
    
?>

<section>
    <div class="container">
        <h1>Meus Anúncios - Editar Anúncio</h1>
        <!-- enctype é para que o formulário aceite imagens -->
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" class="form-control">
                    <?php
                    require "classes/categorias.class.php";
                    $c = new Categorias();
                    $cats = $c->getLista();

                    foreach($cats as $cat):
                        ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo ($info['id_categoria']==$cat['id'])?'selected="selected"':''; ?>><?php echo utf8_encode($cat['nome']); ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>">
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="text" name="valor" id="valor" class="form-control" value="<?php echo $info['valor']; ?>">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" class="form-control"><?php echo utf8_encode($info['descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="estado">Estado de Conservação:</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="0" <?php echo ($info['estado']=='0')?'selected="selected"':''; ?>>Ruim</option>
                    <option value="1" <?php echo ($info['estado']=='1')?'selected="selected"':''; ?>>Bom</option>
                    <option value="2" <?php echo ($info['estado']=='2')?'selected="selected"':''; ?>>Ótimo</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="add_foto">Fotos do anúncio:</label><br>
                <input type="file" name="fotos[]" multiple/>
                <br><br>
                <div class="card">
                    <div class="card-header">Fotos do Anúncio</div>
                    <div class="card-body">
                        <?php foreach($info['fotos'] as $foto):?>
                            <div class="foto_item">
                                <img src="assets/images/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail" border="0" />
                                <a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-success">Excluir imagem</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <input type="submit" value="Salvar" class="btn btn-primary" />
        </form>
    </div>
</section>

<?php require "templates/footer.php"; ?>