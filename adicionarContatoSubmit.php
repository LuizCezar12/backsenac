<?php

include 'class/contatos.class.php';
$contato = new Contatos();

if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $dt_nasc = $_POST['dt_nasc'];
    $descricao = $_POST['descricao'];
    $linkedin = $_POST['linkedin'];
    $email = $_POST['email'];
    $foto = $_POST['foto'];
    $contato->adicionar($email, $nome, $telefone, $endereco, $dt_nasc, $descricao, $linkedin, $foto);
    header('Location: index.php');
}
else{
    echo '<script type="text/javascript">Alert(Email já cadastrado)"</script>';
}