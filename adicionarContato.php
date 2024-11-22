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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
            color: #495057;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="form-title">Adicionar Contato</h1>
    <form method="POST" action="adicionarContatoSubmit.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome completo">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço">
        </div>
        <div class="mb-3">
            <label for="dt_nasc" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="dt_nasc" name="dt_nasc">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do contato">
        </div>
        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn</label>
            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Perfil do LinkedIn">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">URL da Foto</label>
            <input type="form" class="form-control" id="foto" name="foto" placeholder="URL da foto do contato">
        </div>
        <div class="d-grid">
            <input type="submit" class="btn btn-custom" name="btCadastrar" value="ADICIONAR">
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
