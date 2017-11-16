
<html>

    <head>
        <title>SistVotos</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="../assets/css/main.css" />
        <!-- Bootstrap core CSS     -->
        <!--<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />-->
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>
    <?php include("../style.php") ?>

    <?php include("../script.php") ?>
    <body>


        <script src="../jquery.min.js"></script>
        <script src="../jquery.rateyo.js"></script>

        <?php
        include_once "../../ldap/suporte/sessao.php";
        include_once "../../ldap/suporte/conexao.php";
        $sql = "select * from vw_trabalhos"; // where avaliador=$idusuario";
        // echo $sql;

        $list = mysqli_query($link, $sql);
        ?>
        <!-- Wrapper -->
        <div id="wrapper" class="center1">

            <!-- Main -->
            <section id="wrapper">
                <header>
                    <h1 style="font-weight: bold"> Projetos a serem avaliados</h1>
                </header>


                <table class="table">
                    <thead> 
                    <th class="th">Projeto</th>
                    <th class="th">Apresentador</th>
                    </thead>
                    <?php
                    while ($l = mysqli_fetch_assoc($list)) {
                        $votado = $l['votado'];
                        $css = $votado==1?"votado":"naovotado";
                        $idtrabalho = $l['idtrabalho'];
                        $titulo = $l['titulo'];
                        $nomeautor = $l['autorprincipal'];
                        $nomeavaliador = $l['nomeavaliador'];

                        echo "<tr class='tr $css' >";
                        echo "<td> <a href='./votar2.php?idtrabalho=$idtrabalho'>$titulo</a></td>";
                        echo "<td> $nomeautor</td>";

                        echo "</tr>";
                    }
                    ?>
                </table>


            </section>

            <!-- Footer -->
            <footer id="footer">
                <ul class="copyright">
                    <li>&copy; Albeom</li><li><a href="albeom.com.br">Albeom</a></li>
                </ul>
            </footer>

        </div>

        <script src="../jquery.min.js"></script>
        <script src="../jquery.rateyo.js"></script>


    </body>

</html>

