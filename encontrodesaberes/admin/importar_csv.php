<?php

include("conexao.php");

function percorre_arquivo($arquivo, $interacao) {
    
    global $link;
    $arq = fopen($arquivo, 'r'); // le o arquivo txt
    //die($arquivo);
    $ll=0;
    while (!feof($arq)) {
        if ($conteudo = fgets($arq)) {//se extrair uma linha e n for false           
            $linha = explode(',', $conteudo); // divide por coluna onde tiver virgula
            if ($interacao == 1) {                

                mysqli_query($link, $sql);
    
                
                $vnome = $linha[6];
                $vemail= '';
                $vcpf= '';
                $vsenha = '';
                $vidtrabalho = $linha[4];
                $videvento = $linha[0];
                $vidsubevento = $linha[1];
                $vtitulo = $linha[5];
                $vresumo = '';
                $vpalavras = '';
                $vcodigoposter = '';
                $vnomeapresentador = $linha[6];
                //die("1111");
                //echo "$conteudo <br> $linha <br> " . sizeof($linha, $mode);
               // echo "<br>";
                //dd($linha);
                if (sizeof($linha) > 5) {
                    importar_projeto($vnome, $vemail, $vcpf, $vsenha,$vidtrabalho, $videvento, $vidsubevento, $vtitulo, $vresumo, $vpalavras, $vcodigoposter, $vnomeapresentador);
                    $ll++;
                }
                //idEvento, idSubevento, idescricaoSubvento, descricaoSubevento, idProjeto,Titulo, autorPrincipal,
            } else if ($interacao == 2) {
                ///die("222");                
                $vidtrabalhoo=$linha[0];
                $vidavaliador=$linha[1];
                importar_avaliacao_trabalho($vidavaliador, $vidtrabalhoo);
                $ll++;
            }
        }
    }
    fclose($arq);
    echo "quantidade de linhas importadas = " . $ll;
}

function importar_projeto($nome, $email, $cpf, $senha,$idtrabalho, $idevento, $idsubevento, $titulo, $resumo, $palavraschave, $codigoposter, $nomeapresentador) {
    global $link;
    $sql = "CALL INSERE_PROJETO('$nome', '$email', '$cpf', '$senha', $idtrabalho,$idevento, $idsubevento,'$titulo','$resumo','$palavraschave', '$codigoposter', '$nomeapresentador');";
    echo "$sql <br>";
    mysqli_query($link, $sql);
}

function importar_avaliacao_trabalho($idavaliador, $idtrabalho) {
    global $link;
    $sql = "CALL INSERE_AVALIACAO_TRABALHO($idtrabalho, $idavaliador);";
    echo "$sql <br>";
    mysqli_query($link, $sql);
}

/*
$sql = "INSERT INTO inscricao (idevento, nome, email, cpf, senha) VALUES ($idevento, '$nome', '$email', '$cpf', '$senha')";
echo $sql;
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

echo "importando avaliacao trabalho $idavaliador - $idtrabalho <br>" ;
$sql = "INSERT INTO avaliacao_trabalho (fktrabalho, fkinscricao) VALUES ($idtrabalho, $idavaliador)";
echo $sql;
$result = mysqli_query($link,$sql) or die(mysqli_error($link));
*/