<?php
session_start();
include 'class/contatos.class.php';
include 'class/usuario.class.php';

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}


$contato = new Contatos();

$usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Página de Administração - Usuários</title>
    <style>
        .table-container {
            max-width: 100%;
            margin: center;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        .btn-action {
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="text-center mb-1">Administração de Usuários</h1>
        <hr>
        <button class="btn btn-primary"><a href="adicionarUsuario.php" style="color: white; text-decoration: none;">ADICIONAR</a></button>
        <br><br>

        <!-- Tabela de usuários -->
        <div class="table-container">
            <table border="6" class="table table-striped table-bordered table-hover shadow-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>SENHA</th>
                        <th>PERMISSÕES</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = $usuario->listar();
                    foreach($lista as $item):
                    ?>
                    <tr>
                        <td><?php echo $item['nome']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo '******'; // Esconde a senha ?></td>
                        <td><?php echo $item['permissoes']; ?></td>
                        <td>
                            <a href="editarUsuario.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm btn-action">EDITAR</a>
                            <a href="excluirUsuario.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir o usuário <?php echo $item['nome']; ?>?')" class="btn btn-danger btn-sm btn-action">
   EXCLUIR
</a>

                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
