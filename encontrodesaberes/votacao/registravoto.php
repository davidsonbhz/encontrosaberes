<?php

$idtrabalho = $_REQUEST['idtrabalho'];


if (isset($_REQUEST['idtrabalho'])) {
    include_once "../../ldap/suporte/sessao.php";
    include_once "../../ldap/suporte/conexao.php";



    $l = mysqli_fetch_assoc(mysqli_query($link, "select * from vw_trabalhos where idtrabalho=$idtrabalho"));
    $idsubevento = $l['fkidsubevento'];
    $sql = "select * from criterioavaliacao where fkidsubevento=$idsubevento";
    $r = query($sql, false);
    $idavaliador = $_SESSION['inscricao'];

    $row = query("select * from avaliacao_trabalho where fktrabalho=$idtrabalho and fkinscricao=$idavaliador", true);
    $line = mysqli_fetch_assoc($row);
    $idavaliacao = $line['idavaliacao'];

    
    $premiado = $_REQUEST['premiado'];
    $tipopremiacao = $_REQUEST['tipopremiacao'];
    $cbj = $_REQUEST['cbj'];

    while (($l = mysqli_fetch_assoc($r)) != null) {
        $crit = $l['idcriterioavaliacao'];
        $desc = $l['descricao'];
        $nota = $_REQUEST["f$crit"];

        echo "$crit - $desc - $nota <br>";

        $sql = "call REGISTRA_VOTO($idtrabalho,$idavaliador,'$desc',$nota,0); ";
        query($sql, true);
    }

   // $v = implode(",", $cbj);
    //die($tipopremiacao);
   
    if ($tipopremiacao == "mt") {
        query("update avaliacao_trabalho set indicacaomelhor=1,indicacaomencao=0 where idavaliacao=$idavaliacao", true);
    } else if ($tipopremiacao == "mh") {
        query("update avaliacao_trabalho set indicacaomelhor=1,indicacaomencao=1 where idavaliacao=$idavaliacao", true);
    }
    query("delete from indicacao where idavaliacao=$idavaliacao", true);
    
    for($i=0;$i<sizeof($cbj);$i++) {
        $value = $cbj[$i];
        query("insert into indicacao(idavaliacao,motivo) values($idavaliacao,'$value')", true);
    }

     //die($idavaliacao);
    //var_dump($cbj);
    
    //die();


    header("Location: listarprojetos.php");
}

        
        
        