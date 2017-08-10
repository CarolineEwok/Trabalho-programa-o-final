<?php
    session_start();


    if (!isset($_SESSION['usuario_online']) OR $_SESSION['usuario_online'] != true) {

        header('Location: login.php'); //header redireciona para a tela de login
    }

    require 'controlador_agenda.php';
    $contato = editarContato($_GET['id']);

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post" action="controlador_agenda.php?acao=editar" >
    <input name="id" readonly type="text"     value= "<?= $contato['id']?>">
    <input name="nome"        type="text"     value= "<?= $contato['nome']?>">
    <input name="email"       type="email"    value= "<?= $contato['email']?>">
    <input name="telefone"    type="text"     value= "<?= $contato['telefone']?>">

    <input type="submit" value="editar">
</form>

</body>
</html>
