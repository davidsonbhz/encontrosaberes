<?php
$csv = array();

// check there are no errors
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];
    
    $arquivo = $name; 
    //die($arquivo);
    include("importar_csv.php");
    if($arquivo=="projetos.csv"){
        percorre_arquivo($tmpName, 1 );
    }else {
        percorre_arquivo($tmpName, 2);
    }
    
}
