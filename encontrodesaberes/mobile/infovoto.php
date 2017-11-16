<?php
include 'suporte/sessao.php';
include "suporte/conexao.php";

$idavaliador = $_REQUEST['idavaliador']; 
$idtrabalho = $_REQUEST['idtrabalho'];

$ls = query("select * from vw_notas where idtrabalho=$idtrabalho and idavaliador=$idavaliador");
$xml = rs2xml($resultado);


