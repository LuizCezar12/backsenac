<?php
session_start();
require 'class/usuario.class.php';

if (!empty($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = md5($_POST['senha']);
    
    $usuarios = new Usuario();
    if ($usuarios->fazerLogin($email, $senha)) {
        header("Location: index.php");
        exit;
    } else {
        $erro = "Usuário e/ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff; /* Fundo branco */
            color: #333; /* Texto cinza escuro */
        }
        .card {
            border: 1px solid #ccc; /* Borda sutil */
        }
        .card-header {
            background-color: #fff; /* Fundo branco */
            color: #000; /* Texto preto */
            border-bottom: 1px solid #ccc; /* Borda inferior sutil */
        }
        .btn-primary {
            background-color: #000; /* Botão preto */
            border-color: #000; /* Borda do botão preto */
            color: #fff; /* Texto branco */
        }
        .btn-primary:hover {
            background-color: #333; /* Cinza escuro ao passar o mouse */
            border-color: #333;
        }
        .form-control {
            background-color: #fff; /* Fundo branco dos campos */
            color: #000; /* Texto preto nos campos */
            border: 1px solid #ccc; /* Borda dos campos */
        }
        .form-control:focus {
            border-color: #000; /* Borda preta ao focar */
            box-shadow: none;
        }
        .alert {
            background-color: #ff4d4d; /* Fundo do alerta vermelho */
            color: #fff; /* Texto branco */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>LOGIN</h1>
                    </div>
                    <div class="card-body">
                        <!-- Exibe mensagem de erro se houver -->
                        <?php if (isset($erro)): ?>
                            <div class="alert text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="esqueceuSenha.php" class="text-decoration-none">Esqueceu sua senha? Clique aqui</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link para o JS do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
