<?php
$erro = "";


if (isset($_REQUEST['login'])) {
    include './suporte/funcoes.php';
    $login = $_REQUEST['login'];
    $senha = $_REQUEST['senha'];

    ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../tmp'));
    session_start();
    //$_SESSION['uid']=1;
    //die("OK");

    $dados = validarUsuario($login, $senha);


//$userPassword = substr($ldapUser[0][$ldapData['password_field']][0], 5);
    //dd($dados);
    //autenticacao liberada


    if ($dados != null) {
        $v = $dados[0];

        $curso = $v['ou'][0];
        $email = $v['mail'][0];
        $uid = $v['uid'][0];
        $nome = $v['cn'][0] . " ". $v['sn'][0];

        ini_set('session.save_path', realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../../tmp'));

        session_start();
        $_SESSION['curso'] = $curso;
        $_SESSION['email'] = $email;
        $_SESSION['uid'] = $uid;
        $_SESSION['nome'] = $nome;
        
        include './suporte/conexao.php';

        $l = mysqli_fetch_assoc(query("select * from inscricao where cpf='$uid'", true));
        $_SESSION['iduser'] = $l['cpf'];
        $_SESSION['inscricao'] = $l['idinscricao'];

        //die("coisa xxxx");
        //dd($dados);
        //header('Location: home.php');
        die("OK;$nome");
        //die("usuario autenticou");
    } else {
        die("FAIL");
    }


    if ($erro != "") {
        echo $erro;
    }
}

function isPasswordValid($encodedPassword, $raw) {
    echo "isPasswordValid $encodedPassword $raw <br>";
    $password = base64_encode($this->hexToStr(md5($raw)));
    return $password == $encodedPassword;
}
?>

Entre com seus dados
<form method="post">
    Login: <input type="text" name="login">
    Senha: <input type="text" name="senha">
    <input type="submit" value="entrar">
</form>