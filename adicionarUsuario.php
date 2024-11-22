<?php
session_start();
    include 'class/contatos.class.php';
    include 'class/usuario.class.php';

    if(!isset($_SESSION['logado'])){
        header("Location: login.php");
        exit;
    }

    $contato = new Contatos();
    $usuarios = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Formulário de Usuário</title>
    <style>
        body {
            background-color: black;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-white p-4">
                    <h2 class="text-center mb-4">Adicionar Usuário</h2>
                    <form method="POST" action="adicionarUsuarioSubmit.php">
                        <!-- Campo para Nome -->
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome completo">
                        </div>

                        <!-- Campo para E-mail -->
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail">
                        </div>

                        <!-- Campo para Senha -->
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite a senha">
                        </div>

                        <!-- Checkboxes para selecionar permissões -->
                        <div class="form-group">
                            <label for="permissoes">Permissões:</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" value="add" id="add">
                                <label class="form-check-label" for="add">Adicionar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" value="edit" id="edit">
                                <label class="form-check-label" for="edit">Editar</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" value="del" id="del">
                                <label class="form-check-label" for="del">Excluir</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" value="super" id="super">
                                <label class="form-check-label" for="super">Super</label>
                            </div>
                        </div>

                        <button type="submit" name="btCadastrar" class="btn btn-success btn-block">ADICIONAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
