<?php
require 'class/usuario.class.php';

if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $usuarios = new Usuario();

    if ($usuarios->verificarEmail($email)) {
        // Se o email existe no banco, redireciona para definir nova senha
        header("Location: redefinirSenha.php?email=" . urlencode($email));
        exit;
    } else {
        $erro = "E-mail não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>Esqueceu sua senha</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Digite seu e-mail:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Verificar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
