<?php
session_start();
include 'class/contatos.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_GET['id'])) {
    $idFoto = $_GET['id'];

    $contato = new Contatos();

    // Buscar informações da foto no banco
    $foto = $contato->getFotoById($idFoto);

    if ($foto) {
        // Remover o arquivo físico, se existir
        $caminhoFoto = 'img/contatos/' . $foto['url'];
        if (file_exists($caminhoFoto)) {
            unlink($caminhoFoto);
        }

        // Remover a entrada do banco de dados
        $contato->excluirFoto($idFoto);
    }
}

// Redirecionar para a página de edição do contato
header("Location: index.php");
exit;
?>
