<?php
class Anuncios{
    public function getMeusAnuncios(){
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *, (
            select anuncios_imagens.url 
            from anuncios_imagens 
            where anuncios_imagens.id_anuncio = anuncio.id limit 1
            ) as url FROM anuncios WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION["cLogin"]);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function addAnuncio($categoria, $titulo, $descricao,  $valor, $estado){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO anuncios SET id_usuario = :id_usuario, id_categoria = :id_categoria, titulo = :titulo, descricao = :descricao, valor = :valor, estado = :estado");
        $sql->bindValue(":id_usuario", $_SESSION["cLogin"]);
        $sql->bindValue(":id_categoria", $categoria);
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":estado", $estado);
        $sql->execute();
    }
}