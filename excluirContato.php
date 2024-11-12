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

    $con = new Contatos();

    if(!empty($_GET['id'])){

        $id = $_GET['id'];
        $con->deletar($id);
        header("Location: index.php");
    }else{
        echo '<script type="text/javascript">alert("Erro ao excluir")</script>';
        header("Location: index.php");
    }