<?php
class Usuarios{

    public function cadastrar($nome, $email, $senha, $telefone){
        global $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":telefone", $telefone);
            $sql->execute();

            return true;
        }else{
            return false;
        }
        
    }

    public function logar($email, $senha){
        global $pdo;

        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $_SESSION["cLogin"] = $sql["id"];
            
            return true;
        }else{
            return false;
        }
    }

    public static function getNome($id){
        global $pdo;

        $sql = $pdo->prepare("SELECT nome From usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            return $sql["nome"];

        }
           
    }

    public function getTotalUsuarios(){
        global $pdo;

        $sql = $pdo->prepare("SELECT COUNT(*) as u FROM usuarios");
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();

            $sql = $row["u"];
        }

        return $sql;
    }
}
?>