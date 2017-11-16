<?php



function pdo_connect() {
    global $pdo;
    try {
        //$pdo = new PDO('mysql:host=websitealbeom.mysql.dbaas.com.br;dbname=websitealbeom', 'websitealbeom', 'asd123asd***');
        $pdo = new PDO('mysql:host=localhost;dbname=websitealbeom', 'websitealbeom', 'asd123asd***');
    } catch (PDOException $e) {
        die('Não foi possível conectar: ' . $e->getMessage());
    }
}


//$link = mysqli_connect('websitealbeom.mysql.dbaas.com.br', 'websitealbeom', 'asd123asd***');
$link = mysqli_connect('localhost', 'websitealbeom', 'asd123asd***');
if (!$link) {
    die('Não foi possível conectar: ' . mysqli_error());
}

mysqli_select_db($link, 'websitealbeom');
mysqli_set_charset($link, 'utf8');
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,'SET character_set_connection=utf8');
mysqli_query($link,'SET character_set_client=utf8');
mysqli_query($link,'SET character_set_results=utf8');


include_once("funcoes.php");
include("processareq.php");


function query($sql, $debug) {
    global $link;
    $r = mysqli_query($link, $sql);
    if($debug) {
        //echo "<strong>$sql</strong>";
        $w = fopen("log.txt", "a+");
        fwrite($w, "$sql\n");
        fclose($w);
    }
    return $r;
}

//echo 'Conexão bem sucedida';
?>
