<?php

include 'suporte/sessao.php';
include("suporte/conexao.php");

$sql = "select * from vw_trabalhos where avaliador=$inscricao";

$resultado = mysqli_query($link, $sql) or die(mysqli_error($link));
$xml = rs2xml($resultado);

echo $xml;

