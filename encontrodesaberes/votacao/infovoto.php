<?php

include_once "../../ldap/suporte/sessao.php";
include "../suporte/conexao.php";


$idtrabalho = $_REQUEST['idtrabalho'];


$r = query("select * from avaliacao_trabalho where fktrabalho=$idtrabalho and fkinscricao=$inscricao", true);
$row = mysqli_fetch_assoc($r);
$votado = $row['votado'];
$idavaliacao = $row['idavaliacao'];
if($votado==0) {
    die("");
}
echo "votado='$votado';\n";
echo "indicacaomelhor='".$row['indicacaomelhor']."';\n";
echo "indicacaomencao='".$row['indicacaomencao']."';\n";

$r = query("select * from indicacao where idavaliacao=$idavaliacao", true);
echo "indicacao=Array();\n";
while ($row = mysqli_fetch_assoc($r)) {
    echo "indicacao.push('" . $row['motivo'] . "');\n";
}



$r = query("select * from vw_notas where idtrabalho=$idtrabalho and idavaliador=$inscricao", true);
echo "notas=Array();\n";
while ($row = mysqli_fetch_assoc($r)) {
    echo "notas.push(" . $row['nota'] . ");\n";
}



function query($sql, $debug) {
    global $link;
    $r = mysqli_query($link, $sql);
    if ($debug) {
        //echo "<strong>$sql</strong>";
        $w = fopen("log.txt", "a+");
        fwrite($w, "$sql\n");
        fclose($w);
    }
    return $r;
}
