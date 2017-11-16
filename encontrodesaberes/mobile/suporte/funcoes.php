<?php

function validarUsuario($login, $senha) {
    global $erro;



    $ldapData = array(
        "server" => "200.239.152.140",
        "domain" => "dc=ufop,dc=br",
        "cn" => "cn=arp",
        "password" => "dGgwMTIz",
        "id_field" => "uid",
        "password_field" => "userpassword",
        "given_name_field" => "cn",
        "last_name_field" => "sn",
        "email_field" => "mail",
        "group_field" => "ou",
    );


    $domain = "dc=ufop,dc=br";
    $cn = "cn=arp";
    $password = "dGgwMTIz";

    $ldap = ldap_connect("200.239.152.140");
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

    $pwd = "th0123";
    $stringuser = $login . "@domain";


    if ($bind = ldap_bind($ldap, $cn . "," . $domain, base64_decode($password))) {
        // log them in!
        //echo "Bind ok <br>";

        $filter = "(uid=$login)"; // this command requires some filter
        $justThese = array(
            $ldapData['id_field'],
            $ldapData['given_name_field'],
            $ldapData['last_name_field'],
            $ldapData['email_field'],
            $ldapData['group_field'],
            $ldapData['password_field']
        );

        $sr = ldap_search($ldap, $domain, $filter, $justThese);
        $entry = ldap_get_entries($ldap, $sr);

        $kpassword = base64_encode(hexToStr(md5($senha)));
        $vsenhaldap = $ldapData['password_field'];

        if ($entry['count'] > 0) { //valida o usuario
            $vsenhaldap = substr($entry[0][$ldapData['password_field']][0], 5);
            //echo " pass: $vsenhaldap == $kpassword <br>";
            if ($vsenhaldap == $kpassword) {

                return $entry;
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuario nao existe!";
        }
    } else {
        // error message
        echo "Bind error!";
        return null;
    }
}

function dd($coisa) {
    echo "<pre>";
    var_dump($coisa);
    die("</pre>");
}

function hexToStr($hex) {
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function mostrarVariaveis($cps) {
    $a = explode(",", $cps);
    $fname = "vars_" . basename($_SERVER["SCRIPT_FILENAME"], '.php') . ".php";
    $w = fopen($fname, "w");
    fwrite($w, "<?php \n");

    foreach ($a as $param) {
        fwrite($w, "echo \"$param = '" . $_REQUEST[$param] . "'\";\n");
        fwrite($w, "echo '<br>';\n");
    }
    fclose($w);
    include($fname);
}

function criarForm($cps) {
    $a = explode(",", $cps);
    $fname = "form_" . basename($_SERVER["SCRIPT_FILENAME"], '.php') . ".php";
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
            $fname = "form_" . basename($_SERVER["SCRIPT_FILENAME"], '.php') . ".php";
            include($fname);
            die("ERRO Falta parametro $param !");
        }
    }

    $fname = "var_" . basename($_SERVER["SCRIPT_FILENAME"], '.php') . ".php";
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
