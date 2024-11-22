<?php
require_once 'conexao.class.php';

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $permissoes;
    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }
    
    public function verificarEmail($email) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        return $sql->rowCount() > 0;
    }

    // Atualiza a senha no banco
    public function atualizarSenha($email, $novaSenha) {
        $sql = $this->con->conectar()->prepare("UPDATE usuarios SET senha = :senha WHERE email = :email");
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT); // Usa o password_hash
        $sql->bindValue(":senha", $senhaHash); // Armazena a senha criptografada
        $sql->bindValue(":email", $email);
        return $sql->execute();
    }
    

    public function fazerLogin($email, $senha){
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
    
        if ($sql->rowCount() > 0) {
            $usuario = $sql->fetch();
            // Verifica a senha utilizando password_verify
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['logado'] = $usuario['id'];
                return true;
            }
        }
        return false;
    }

    public function setUsuario($id){
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $this->permissoes = explode(',', $sql['permissoes']); // transforma em array
        }
    }

    public function getPermissoes(){
        return $this->permissoes;
    }

    public function temPermissoes($p){
        return in_array($p, $this->permissoes);
    }

    // Elimina métodos redundantes e usa `temPermissoes` para verificar permissões

    public function adicionarUsuario($nome, $email, $senha, $permissoes) {
        if (empty($this->existeEmail($email))) {
            try {
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = md5($senha); // Criptografa a senha com MD5
                $this->permissoes = $permissoes;

                $sql = $this->con->conectar()->prepare("INSERT INTO usuarios (nome, email, senha, permissoes) VALUES (:nome, :email, :senha, :permissoes)");
                $sql->bindParam(":nome", $this->nome);
                $sql->bindParam(":email", $this->email);
                $sql->bindParam(":senha", $this->senha);
                $sql->bindParam(":permissoes", $this->permissoes);
                $sql->execute();

                return true;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        }
        return false;
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscar($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return $sql->rowCount() > 0 ? $sql->fetch() : [];
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editarUsuario($nome, $email, $senha, $permissoes, $id) {
        $emailExistente = $this->existeEmail($email);
        if (!empty($emailExistente) && $emailExistente['id'] != $id) {
            return false;
        }

        try {
            $senha = md5($senha); // Criptografa a senha com MD5

            $sql = $this->con->conectar()->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, permissoes = :permissoes WHERE id = :id");
            $sql->bindParam(':nome', $nome);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':senha', $senha);
            $sql->bindParam(':permissoes', $permissoes);
            $sql->bindParam(':id', $id);
            $sql->execute();

            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function deletar($id) {
        $sql = $this->con->conectar()->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    private function existeEmail($email) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuarios WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();

        return $sql->rowCount() > 0 ? $sql->fetch() : [];
    }
}
