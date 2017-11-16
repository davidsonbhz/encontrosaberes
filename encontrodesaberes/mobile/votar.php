<?php

include 'suporte/sessao.php';
include "suporte/conexao.php";

$cpf = $_REQUEST['idavaliador']; 
$idtrabalho = $_REQUEST['idtrabalho'];
$criterio = $_REQUEST['criterio'];
$nota = $_REQUEST['nota'];

$sql = "call REGISTRA_VOTO($idtrabalho, $inscricao, '$criterio', $nota);";
query($sql, true);


echo "OK";