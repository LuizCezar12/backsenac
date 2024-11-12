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

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $usuario->buscar($id);
    
    // Verifica se o info é um array e se o email está definido
    if (empty($info) || empty($info['email'])) {
        header("Location: /backsenac");
        exit;
    }
} else {
    header("Location: /backsenac");
    exit;
}

$opcoesPermissoes = ['add', 'edit', 'del', 'super'];

// Extrai as permissões do usuário atual em um array
$permissoesUsuario = explode(',', $info['permissoes']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Usuário</title>
    <style>
        body {
            background-color: #343a40; /* Cor de fundo escura */
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            border-radius: 15px; /* Bordas arredondadas para o card */
            padding: 20px; /* Adiciona espaço interno ao card */
        }
        .form-group label {
            font-weight: bold; /* Texto das labels em negrito */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <h2 class="text-center mb-4">Editar Usuário</h2>
                    <form method="POST" action="editarUsuarioSubmit.php">
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $info['nome']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $info['email']; ?>" required />
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite a nova senha (deixe em branco para manter)" />
                        </div>

                        <div class="form-group">
                            <label>Permissões:</label><br>
                            <?php foreach ($opcoesPermissoes as $permissao): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissoes[]" value="<?php echo $permissao; ?>" 
                                    <?php echo in_array($permissao, $permissoesUsuario) ? 'checked' : ''; ?>> 
                                    <label class="form-check-label" for="<?php echo $permissao; ?>">
                                        <?php echo ucfirst($permissao); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="submit" name="btAlterar" class="btn btn-success btn-block">ALTERAR</button>
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
