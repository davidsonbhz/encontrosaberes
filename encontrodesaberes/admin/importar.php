<?php

include("sessao.php");
include("conexao.php");
verificarCampos("contatos,grupo");
pdo_connect();
$contatos = $_REQUEST['contatos'];
$idgrupo = $_REQUEST['grupo'];

$ct = explode(";", $contatos);

$stmt = $pdo->prepare("insert into contato(idcliente,nome,telefone,datacad,status) values($idcliente,:nome,:tel,date(now()),'ATIVO')");
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':tel', $tel);

$stmt2 = $pdo->prepare("insert into grupoxcontato(idgrupo,idcontato) values(:idgrupo,:idcontato)");
$stmt2->bindParam(':idgrupo', $idgrupo);
$stmt2->bindParam(':idcontato', $idcontato);

foreach ($ct as $key) {
    //echo "$key - ";
    $a = explode(",", $key);
    $nome = $a[0];
    $tel = $a[1];

    $stmt->execute();
    
    $idcontato = $pdo->lastInsertId();
    $stmt2->execute();
    
    //$sql = "insert into contato(idcliente,nome,telefone,datacad,status) values($idcliente,'$nome','$tel',date(now()),'ATIVO')";
    //mysqli_query($link, $sql);
}


//echo "OK";

