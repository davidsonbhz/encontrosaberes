<?php


include 'suporte/sessao.php';

echo "Usuario: $idusuario / $nome";


?>

<h1>Bem vindo!</h1>
<hr />
Voce logou com sucesso!
<br />
<a href="home.php?listar_trabalhos.php">Listar trabalhos</a>
<a href="home.php?include=../encontrodesaberes/votacao/log.php">LOG</a>
<a href="home.php?limparlog=1">LIMPAR LOG</a>
<a href="logout.php">Sair</a>

<?php

if(isset($_REQUEST['include'])) {
    $inc = $_REQUEST['include'];
    include $inc;
}
if(isset($_REQUEST['limparlog'])) {
    unlink("log.txt");
    header("Location: home.php");
}


?>



