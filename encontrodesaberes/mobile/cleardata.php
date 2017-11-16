<?php

include 'suporte/sessao.php';
include("suporte/conexao.php");


query("delete from criterioavaliado", true);
query("update avaliacao_trabalho set votado=0", true);



