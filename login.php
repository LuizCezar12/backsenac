<?php
session_start();
require 'class/usuario.class.php';

if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    
    $senha = md5($_POST['senha']);
    
    $usuarios = new Usuario();
    if($usuarios->fazerLogin($email, $senha)){
        header("Location: index.php");
        exit;
    }else{
        echo '<span style="color: red">'."Usuario e/ou senha incorretos!".' </span>';
    }
}
?>
<h1>LOGIN</h1>
<form method="POST" >
    email: <br>
    <input type="email" name="email"><br><br>

    Senha: <br>
    <input type="password" name="senha"><br><br>
    <a href="esqueceuSenha.php">Esqueceu sua senha ? CLICK AQUI</a><br>
    <input type="submit" value="Entrar">
    
</form>


