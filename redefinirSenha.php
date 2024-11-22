<?php
require 'class/usuario.class.php';

if (!empty($_GET['email']) && !empty($_POST['nova_senha'])) {
    $email = addslashes($_GET['email']);
    $novaSenha = md5($_POST['nova_senha']);

    $usuarios = new Usuario();
    if ($usuarios->atualizarSenha($email, $novaSenha)) {
        // Redireciona para a página de login após sucesso
        header("Location: login.php?mensagem=sucesso");
        exit;
    } else {
        $erro = "Ocorreu um erro ao redefinir sua senha.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>Redefinir Senha</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nova_senha" class="form-label">Digite sua nova senha:</label>
                                <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                        </form>
                    </div>
                </div>
            </div>
       
