<?php require "templates/header.php";?>
<?php
    require "classes/anuncios.class.php";
    require "classes/categorias.class.php";

    $a = new Anuncios();
    $u = new Usuarios();//o require ja esta no header
    $c = new Categorias();

    $filtros = array(
        'categoria' => '',
        'preco' => '',
        'estado' => ''
    );

    if(isset($_GET['filtros'])){
        $filtros = $_GET['filtros'];
    }

    $total_anuncios = $a->getTotalAnuncios($filtros);
    $total_usuarios = $u->getTotalUsuarios();

    //Pegar página atual
    $p = 1;
    if(isset($_GET['p']) && !empty($_GET['p'])){
        $p = addslashes($_GET['p']);
    }
    $por_pagina = 2;
    $total_paginas = ceil($total_anuncios / $por_pagina);

    $anuncios = $a->getUltimosAnuncios($p, $por_pagina, $filtros);//pegar página como parâmetro
    $categorias = $c->getLista();
?>
<section>
    <div class="container">
        <div class="row classificados">
            <div class="col-sm-6">
                <h1>Hoje nós temos mais de <?php echo $total_anuncios; ?> anúncios</h1>
            </div>
            <div class="col-sm-6">
                <h5>E mais de <?php echo $total_usuarios; ?> usuários cadastrados</h5>
            </div>
        </div>
        <div class="row pesquisa_anuncio">
            <div class="col-sm-4">
                <h4>Pesquisa Avançada</h4>
                <form method="GET">
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="filtros[categoria]" class="form-control">
                            <option></option>
                            <?php foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id']==$filtros['categoria'])?'selected="selected"':'';?>><?php echo utf8_encode($cat['nome'])?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="preco">Preço:</label>
                        <select id="preco" name="filtros[preco]" class="form-control">
                            <option></option>
                           <option value="0-50" <?php echo ($filtros['preco']=='0-50')?'selected="selected"':'';?>>R$ 0 - 50</option>
                           <option value="51-100" <?php echo ($filtros['preco']=='51-100')?'selected="selected"':'';?>>R$ 51 - 100</option>
                           <option value="101-200" <?php echo ($filtros['preco']=='101-200')?'selected="selected"':'';?>>R$ 101 - 200</option>
                           <option value="201-500" <?php echo ($filtros['preco']=='201-500')?'selected="selected"':'';?>>R$ 201 - 500</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado de Conservação:</label>
                        <select id="estado" name="filtros[estado]" class="form-control">
                            <option></option>
                           <option value="0" <?php echo ($filtros['estado']=='0')?'selected="selected"':'';?>>Ruim</option>
                           <option value="1" <?php echo ($filtros['estado']=='1')?'selected="selected"':'';?>>Bom</option>
                           <option value="2" <?php echo ($filtros['estado']=='2')?'selected="selected"':'';?>>Ótimo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-info" value="Buscar" />
                    </div>
                </form>
            </div>
            <div class="col-sm-8">
                <h4>Últimos Anúncios</h4>
                <table class="table table-striped">
                    <tbody>
                        <?php foreach($anuncios as $anuncio):?>
                        <tr>
                            <td>
                                <?php if(!empty($anuncio['url'])):?>
                                    <img src="assets/images/anuncios/<?php echo $anuncio['url']; ?>" height="50" border="0" />
                                <?php else:?>
                                    <img src="assets/images/anuncios/default.jpg" height="50" border="0" />
                                <?php endif;?>
                            </td>
                            <td>
                                <a href="produto.php?id=<?php echo $anuncio['id']; ?>"><?php echo $anuncio["titulo"]; ?></a><br>
                                <?php echo utf8_encode($anuncio['categoria']); ?>
                            </td>
                            <td>R$ <?php echo number_format($anuncio["valor"], 2);?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
                <ul class="pagination">
                    <?php for($q=1;$q<=$total_paginas;$q++): ?>
                    <li class="page-item"><a class="page-link" href="index.php?<?php
                     $w = $_GET;
                     $w['p'] = $q; 
                     echo http_build_query($w);
                    ?>"><?php echo $q?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require "templates/footer.php";?>