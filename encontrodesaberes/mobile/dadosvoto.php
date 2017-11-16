<?php

include 'suporte/sessao.php';
include "suporte/conexao.php";

$cpf = $_REQUEST['idavaliador']; 
$idtrabalho = $_REQUEST['idtrabalho'];
$criterios = $_REQUEST['criterios'];
$justificar = $_REQUEST['criterios'];
$como = $_REQUEST['como'];
$premiado = $_REQUEST['premiado'];
$idavaliador = $_REQUEST['idavaliador'];

/*
{justificar=Domínio e clareza do trabalho apresentado;;;Capacidade de avaliação crítica sobre o trabalho apresentado;, como=Melhor Trabalho;, criterios=CLAREZA=5;CONTEUDO=4;FORMATAÇ��O=3;DOMINIO DO TEMA=2;TEMPO DE APRESENTAÇÃO=1, premiado=1, idavaliador=11922371610, idtrabalho=105}
11-07 15:11:26.518 8968-8968/br.ufop.icea.encontrodesaberes D/Criterios: CLAREZA=5;CONTEUDO=4;FORMATAÇÃO=3;DOMINIO DO TEMA=2;TEMPO DE APRESENTAÇÃO=1
*/

$crits = explode(";", $criterios);
for($i=0;$i<sizeof($crits);$i++) {
    $a = explode("=", $crits[$i]);
    $nota = $a[1];
    $criterio = $a[0];
    $sql = "call REGISTRA_VOTO($idtrabalho, $inscricao, '$criterio', $nota);";
    query($sql, true);
    
}

$just = explode(";", $justificar);
for($i=0;$i<sizeof($just);$i++) {
    $justificativa = $just[$i];
    $sql = "call JUSTIFICAR_VOTO($idtrabalho, $idavaliador, '$justificativa');";
    query($sql, true);
    
}



 
echo "OK";