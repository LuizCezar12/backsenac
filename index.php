<?php
session_start();
include 'class/contatos.class.php';
include 'class/usuario.class.php';

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

$contato = new Contatos();
$usuarios = new Usuario();
$usuarios->setUsuario($_SESSION['logado']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Página de Administração - Agenda de Contatos</title>
    <style>
        .menu {
            margin-bottom: 20px;
        }
        .table-container {
            max-width: 100%;
            margin: auto;
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
        img {
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-3">Administração de Contatos</h1>
        
        <!-- Dropdown de Ações -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Ações
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php if ($usuarios->temPermissoes('add')): ?>
                    <li><a class="dropdown-item btn btn-primary text-white" href="adicionarContato.php">Adicionar Contato</a></li>
                <?php endif; ?>
                <?php if ($usuarios->temPermissoes('super')): ?>
                    <li><a class="dropdown-item btn btn-primary text-white" href="listarUsuario.php">Gerenciar Usuário</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item text-danger" href="sair.php">Sair</a></li>
            </ul>
        </div>

        <!-- Tabela de contatos -->
        <div class="table-container">
            <table border="1" class="table table-striped table-bordered table-hover shadow-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>TELEFONE</th>
                        <th>ENDEREÇO</th>
                        <th>DATA DE NASCIMENTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>LINKEDIN</th>
                        <th>EMAIL</th>
                        <th>FOTO</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lista = $contato->getFoto();
                    foreach ($lista as $item):
                    ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['nome']; ?></td>
                        <td><?php echo $item['telefone']; ?></td>
                        <td><?php echo $item['endereco']; ?></td>
                        <td><?php echo $item['dt_nasc']; ?></td>
                        <td><?php echo $item['descricao']; ?></td>
                        <td><?php echo $item['linkedin']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td>
                            <?php if (!empty($item['url'])): ?>
                                <img src="img/contatos/<?php echo $item['url']; ?>" height="70px">
                            <?php else: ?>
                                <img src="img/default.png" height="70px">
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($usuarios->temPermissoes('edit')): ?>
                                <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm btn-action">EDITAR</a>
                            <?php endif; ?>
                            <?php if ($usuarios->temPermissoes('del')): ?>
                                <a href="excluirContato.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que vai excluir esse contato <?php echo $item['nome']; ?>?')" class="btn btn-danger btn-sm btn-action">EXCLUIR</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
