<?php
//ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../tmp'));
/*
session_start();

$rawBody = file_get_contents("php://input"); // Read body


if ($rawBody != "") { //if post data is present
    $users = '[{"user":"adam","pass":"$2y$10$p7qPMEH2ZcsIWV6TptMCGOmWqa5evX9dnbe.GOvtFOsN1ozEv.ja2"}]';

    if (sizeof($users) > 0) {
        $user_list = json_decode($users);
    }

    $data = json_decode($rawBody);
    $user = $data->user; //
    $pass = $data->pass;
    $auth = false;
    foreach ($user_list as $u) {
        if ($u->user == $user && password_verify($pass, $u->pass)) {
            echo '{"user":"' . $user . '", "auth":"1"}';
            $_SESSION['auth'] = 1;
            $_SESSION['user'] = $user;
            $auth = true;
            break;
        }
    }
    if (!$auth) {
        echo '{"user":"' . $user . '", "auth":"1"}';
        $_SESSION['auth'] = 0;
        $_SESSION['user'] = 'none';
    }
} else {
    if ($_SESSION['auth'] == 0) {
        echo '{"user":"none", "auth":"0"}';
    } else {
        echo '{"user":"' . $_SESSION['user'] . '", "auth":"' . $_SESSION['auth'] . '"}';
    }
}*/

?>

Bem vindo ao sistema. <a href="login.php"> Favor se autenticar! </a>
