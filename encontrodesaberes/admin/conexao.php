<?php



function pdo_connect() {
    global $pdo;
    try {
        $pdo = new PDO('mysql:host=websitealbeom.mysql.dbaas.com.br;dbname=websitealbeom', 'websitealbeom', 'asd123asd***');
    } catch (PDOException $e) {
        die('Não foi possível conectar: ' . $e->getMessage());
    }
}


$link = mysqli_connect('websitealbeom.mysql.dbaas.com.br', 'websitealbeom', 'asd123asd***');
if (!$link) {
    die('Não foi possível conectar: ' . mysqli_error());
}

mysqli_select_db($link, 'websitealbeom');


include("funcoes.php");
include("processareq.php");


//echo 'Conexão bem sucedida';
?>
