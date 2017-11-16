<?php

function mostrarVariaveis($cps) {
    $a = explode(",", $cps);
    $fname = "vars_" . basename($_SERVER["SCRIPT_FILENAME"], '.php').".php";
    $w = fopen($fname, "w");
    fwrite($w, "<?php \n");
    
    foreach ($a as $param) {
        fwrite($w, "echo \"$param = '".$_REQUEST[$param]  ."'\";\n");
        fwrite($w, "echo '<br>';\n");
    }
    fclose($w);
    include($fname);
    
}


function criarForm($cps) {
    $a = explode(",", $cps);
    $fname = "form_" . basename($_SERVER["SCRIPT_FILENAME"], '.php').".php";
    $w = fopen($fname, "w");
    fwrite($w, "<form method='post'>");
    
    foreach ($a as $param) {
        fwrite($w, "$param: <input name='$param'><br>\n");
    }
    fwrite($w, "<input type='submit'>\n");
    fclose($w);
}

function verificarCampos($cps) {
    $a = explode(",", $cps);
    $q = false;
    foreach ($a as $param) {
        if (!isset($_REQUEST[$param])) {
            criarForm($cps);
            $fname = "form_" . basename($_SERVER["SCRIPT_FILENAME"], '.php').".php";
            include($fname);
            die("ERRO Falta parametro $param !");
        }
    }

    $fname = "var_" . basename($_SERVER["SCRIPT_FILENAME"], '.php').".php";
    if (!file_exists($fname)) { 
        $w = fopen($fname, "w");
        fwrite($w, "<?php \n");
        foreach ($a as $param) {
            $ev = "global \$$param; \n \$$param = \$_REQUEST['$param'] ;\n";
            fwrite($w, $ev);
        }
        fclose($w);
    }
    include($fname);
}

function bindParamArray($prefix, $values, &$bindArray) {
    $str = "";
    foreach ($values as $index => $value) {
        $str .= ":" . $prefix . $index . ",";
        $bindArray[$prefix . $index] = $value;
    }
    return rtrim($str, ",");
}

function rs2xml($rs) {

    $finfo = $rs->fetch_fields();
    
    $cps = "";
    foreach ($finfo as $val) {
            $cps .= $val->name . ",";
        }
    $cps = substr($cps, 0, -1);
    
    $xml = "<xzdoc><metadata>";
    $xml .= "<campos>$cps</campos>";
    $xml .= "</metadata>";
    $xml .= "<registros>";

    while ($row = mysqli_fetch_assoc($rs)) {
        $xml .= "<registro>";

        foreach ($finfo as $val) {
            $xml .= "<" . $val->name . ">" . $row[$val->name] . "</" . $val->name . ">";
        }

        $xml .= "</registro>\n";
    }

    $xml = $xml . "</registros></xzdoc>";

    return $xml;
}

?>
