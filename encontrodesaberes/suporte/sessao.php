<?php

ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../tmp'));

session_start();
global $idusuario;
global $nome;


if (isset($_SESSION['uid'])) {
    $idusuario = $_SESSION['uid'];
    $nome = $_SESSION['nome'];

} else {
    //$idcliente = 1;
    
    //header('Location: login.php');
    die("Usuario nao autenticado! <a href='login.php'>Login</a>");
}


