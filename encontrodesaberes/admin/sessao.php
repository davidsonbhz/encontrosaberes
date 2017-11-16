<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../tmp'));

session_start();
global $idcliente;

if (isset($_SESSION['idcliente'])) {
    $idcliente = $_SESSION['idcliente'];
    
} else {
    //$idcliente = 1;
    
    header('Location: login.php');
    die();
}
