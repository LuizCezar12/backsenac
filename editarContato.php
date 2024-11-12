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
    $info = $contato->getContato($_GET['id'];)
}else{
    ?>
    <script type="text/javascript">window.location.href="index.php";</script>
    <?php
    exit;
}

?>

<h1>EDITAR CONTATO</h1>

<form method="POST" enctype="multipart/form-data"><!-- Permite adicionar imagens no form-->
    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
    Nome: <br>
    <Input type="text" name="nome" value="<?php echo $info['nome']; ?>"/>
    <br>telefone: <br>
    <Input type="text" name="telefone" value="<?php echo $info['telefone']; ?>"/>
    <br>endereco: <br>
    <Input type="text" name="endereco" value="<?php echo $info['endereco']; ?>"/>
    <br>dt_nasc: <br>
    <Input type="date" name="dt_nasc" value="<?php echo $info['dt_nasc']; ?>"/>
    <br>descricao: <br>
    <Input type="text" name="descricao" value="<?php echo $info['descricao']; ?>"/>
    <br>linkedin: <br>
    <Input type="text" name="linkedin" value="<?php echo $info['linkedin']; ?>"/>
    <br>email: <br>
    <Input type="text" name="email" value="<?php echo $info['email']; ?>"/>
    <br>foto: <br>
    <input type="file" name="foto[]" multiple /> <br>
    <div class="grupo">
        <div class="cabecalho"> Foto Contato</div>
        <div class="corpo">
            <?php foreach($info['foto'] as $foto): ?>
                <div class="foto_item">
                    <img src="img/contatos/ <?php echo $foto['url']; ?>"/>
                    <a href="excluir_foto.phpid=<?php $foto['id']; ?>">Excluir imagem</a>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <Input type="submit" name="btAlterar" value="ALTERAR"/>
</form>