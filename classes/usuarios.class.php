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

        $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $_SESSION["cLogin"] = $sql["nome"];
            
            return true;
        }else{
            return false;
        }
    }
}
?>