<?php

include("conexao.php");

$sql = "delete from inscricao";
echo "$sql <br>";
mysqli_query($link, $sql);

