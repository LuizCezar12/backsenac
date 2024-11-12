<?php
include 'class/usuario.class.php'; // Alterado para incluir a classe de usuários
$usuario = new Usuario(); // Instanciado a classe Usuario

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $usuario->deletar($id); // Alterado para chamar o método deletar da classe Usuario
    header("Location: listarUsuario.php");
} else {
    echo '<script type="text/javascript">alert("Erro ao excluir")</script>';
    header("Location: listarUsuario.php");
}
?>
