<?php
include 'class/usuario.class.php'; // Supondo que a classe Usuario está neste caminho
$usuario = new Usuario();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Adicionado para capturar a nova senha
    $permissoes = isset($_POST['permissoes']) ? implode(',', $_POST['permissoes']) : ''; // Capturando permissões como array

    $id = $_POST['id'];

    if (!empty($email)) {
        $usuario->editarUsuario($nome, $email, $senha, $permissoes, $id); // Chamada ao método de edição
    }
    
    header("Location: listarUsuario.php"); // Redireciona para a página de listagem após edição
}
