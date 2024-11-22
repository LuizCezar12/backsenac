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


if(!empty($_GET['id'])){
    
    $id = $_GET['id'];
    $info = $contato->buscar($id);
    if(empty($info['email'])){
        header("Location: /backsenac");
        exit;
    }
}else{
    header("Location: /backsenac");
}
if(!empty($_POST['id'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $dt_nasc = $_POST['dt_nasc'];
    $descricao = $_POST['descricao'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];
    if(isset($_FILES['foto'])){
        $foto = $_FILES['foto'];

    }else{
        $foto = array();
    }

    if(!empty($email)){

        $contato->editar($nome, $telefone, $endereco, $dt_nasc, $descricao, $linkedin, $email, $foto, $_GET['id']);
    }
    header("Location: index.php");
}
if(isset($_GET['id']) && !empty($_GET['id'])){
    $info = $contato->getContato($_GET['id']);
}else{
    ?>
    <script type="text/javascript">window.location.href="index.php";</script>
    <?php
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Contato</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Contato</h1>

    <form method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $info['nome']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $info['telefone']; ?>">
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" id="endereco" name="endereco" class="form-control" value="<?php echo $info['endereco']; ?>">
        </div>

        <div class="mb-3">
            <label for="dt_nasc" class="form-label">Data de Nascimento:</label>
            <input type="date" id="dt_nasc" name="dt_nasc" class="form-control" value="<?php echo $info['dt_nasc']; ?>">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <input type="text" id="descricao" name="descricao" class="form-control" value="<?php echo $info['descricao']; ?>">
        </div>

        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn:</label>
            <input type="text" id="linkedin" name="linkedin" class="form-control" value="<?php echo $info['linkedin']; ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $info['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input type="file" id="foto" name="foto[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Contato:</label>
            <div class="row">
                <?php foreach ($info['foto'] as $foto): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="img/contatos/<?php echo $foto['url']; ?>" class="card-img-top" alt="Foto do contato">
                            <div class="card-body text-center">
                            <a href="excluir_foto.php?id=<?php echo $foto['id']; ?>&id_contato=<?php echo $info['id']; ?>" 
                                     class="btn btn-danger btn-sm">
                                     Excluir imagem
                            </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="d-grid">
            <input type="submit" name="btAlterar" value="Alterar" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>