
<?php
include 'class/usuario.class.php';  // Supondo que a classe Usuario está neste caminho
$usuario = new Usuario();

if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = isset($_POST['permissoes']) ? implode(',', $_POST['permissoes']) : ''; // Permissões como lista separada por vírgula

    // Adiciona o novo usuário
    $usuario->adicionarUsuario($nome, $email, $senha, $permissoes);
    
    // Redireciona para a página inicial
    header('Location: listarUsuario.php');
} else {
    echo '<script type="text/javascript">alert("Email já cadastrado");</script>';
}
