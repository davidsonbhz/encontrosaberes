<?php

session_start();

$_SESSION['curso'] = 'SISTEMAS DE INFORMACAO';
$_SESSION['email'] = 'davidsonbhz@gmail.com';
$_SESSION['uid'] = '03250833630';
$_SESSION['nome'] = 'davidson nunes';
$_SESSION['auth'] = 1;
$_SESSION['user'] = '03250833630';
$_SESSION['profile'] = 'admin';

die('{"user":"' . $uid . '", "auth":"1", "x":9}');

$rawBody = file_get_contents("php://input"); // Read body

if ($rawBody != "") { //if post data is present
    include './suporte/funcoes.php';
    $data = json_decode($rawBody);
    $login = $data->user; //
    $senha = $data->pass;
    $auth = false;

    if (!isset($_SESSION['uid'])) {

        $dados = 999;

        //$dados = validarUsuario($login, $senha);

        if ($dados != null) {
            $v = $dados[0];

            //testes
            if ($login == "03250833630") {
                $_SESSION['curso'] = 'SISTEMAS DE INFORMACAO';
                $_SESSION['email'] = 'davidsonbhz@gmail.com';
                $_SESSION['uid'] = '03250833630';
                $_SESSION['nome'] = 'davidson nunes';
                $_SESSION['auth'] = 1;
                $_SESSION['user'] = '03250833630';

                echo '{"user":"03250833630", "auth":"1", "x":3}';
                die();
            }

            $curso = $v['ou'][0];
            $email = $v['mail'][0];
            $uid = $v['uid'][0];
            $nome = $v['cn'][0] . $v['sn'][0];

            $_SESSION['curso'] = $curso;
            $_SESSION['email'] = $email;
            $_SESSION['uid'] = $uid;
            $_SESSION['nome'] = $nome;
            $_SESSION['auth'] = 1;
            $_SESSION['user'] = $uid;

            echo '{"user":"' . $uid . '", "auth":"1", "x":3}';
            die();
        } else {
            if ($_SESSION['auth'] == 0) {
                echo '{"user":"none", "auth":"0"}';
            } else {
                echo '{"user":"' . $_SESSION['user'] . '", "auth":"' . $_SESSION['auth'] . '", "x":2}';
            }
        }
    } else {
        echo '{"user":"' . $_SESSION['user'] . '", "auth":"' . $_SESSION['auth'] . '", "x":1}';
    }
} else {
    if (isset($_SESSION['uid'])) {
        echo '{"user":"' . $_SESSION['user'] . '", "auth":"' . $_SESSION['auth'] . '", "x":4}';
    } else {
        echo '{"user":"none", "auth":"0", "x":5}';
    }
}
?>
