<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Material Dashboard by Creative Tim</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="../assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    </head>
    <style>
        select:has(option[value=""]) {
            color: purple;
            transition: color 0s 2147483647s;
        }
        .display {
            display: none;
        }
    </style>
    <script>
        function Mudarestado(el) {
            var display = document.getElementById(el).style.display;
            if (display == "block")
                document.getElementById(el).style.display = 'none';
            else
                document.getElementById(el).style.display = 'block';
        }
    </script>

    <body>
        <?php
        $idtrabalho = $_REQUEST['idtrabalho'];
        include './suporte/conexao.php';

        $list = mysqli_query($link, "select * from vw_trabalhos where idtrabalho=$idtrabalho;");
        $avaliadores = mysqli_query($link, "select atr.*, ins.nome from avaliacao_trabalho atr inner join inscricao ins on ins.idinscricao = atr.fkinscricao and atr.fktrabalho = $idtrabalho;");
        $avaliador = mysqli_query($link, "select * from vw_trabalhos where idtrabalho=$idtrabalho;");
        $todosavaliadores = mysqli_query($link, "select * from vw_avaliadores; ");
        ?>
        <div class="wrapper">
            <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
                <!--
            Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    
            Tip 2: you can also add an image using data-image tag
                -->
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        Sistema Votation
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">

                        <li class="active">
                            <a href="./listarprojetos.php">
                                <i class="material-icons">content_paste</i>
                                <p>Projetos</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- FIM MENU -->
            <div class="main-panel">
                <nav class="navbar navbar-transparent navbar-absolute">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#"> Editar </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <!--Profile-->
                        </div>
                    </div>
                </nav>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-header" data-background-color="purple">
                                        <?php
                                        $result = mysqli_fetch_assoc($avaliador);

                                        $titulo = $result['titulo'];
                                        $nomeautor = $result['autorprincipal'];

                                        echo "<h4 class='title'>$titulo</h4>";
                                        echo "<p class='category'>$nomeautor</p>";
                                        ?>
                                        <!--<h4 class="title">$titulo</h4>-->
<!--                                        <p class="category">Aluno Apresentador do Projeto
                                        </p>-->
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <?php
//                                            $result = mysqli_fetch_assoc($avaliador);

                                            $nomeavaliador = $result['nomeavaliador'];

                                            echo "<h4> $nomeavaliador";
                                            ?>
                                            <button type="button" class="btn btn-primary btn-round" onclick="Mudarestado('divAvaliador')">Trocar Avaliador</button>

                                            <!--                                        <h4> Autor 2 </h4>
                                                                                        <h4> Autor 3 </h4>
                                                                                        <h4> Autor 4 </h4>-->
                                            <!--                                            <h4> Avaliador do Projeto
                                                                                            <button type="button" class="btn btn-primary btn-round" onclick="Mudarestado('divAvaliador')">Trocar Avaliador</button>-->
                                        </div>

                                        <form action="./listarprojetos.php" method="POST">
                                            <div id="divAvaliador"  action="./listarprojetos.php" class="row display">
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                        <h4>Avaliadores</h4>
                                                        <select class="form-control" id="sel1" >
                                                            <option>Selecione</option>
                                                            <?php
                                                            while ($todosav = mysqli_fetch_assoc($todosavaliadores)) {

                                                                $nomeavaliador = $todosav['nomeavaliador'];

                                                                echo "<option>$nomeavaliador</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-round" >Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">

                        <p class="copyright pull-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </div>
                </footer>
            </div>
        </div>
    </body>
    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/material.min.js" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="../assets/js/chartist.min.js"></script>
    <!--  Dynamic Elements plugin -->
    <script src="../assets/js/arrive.min.js"></script>
    <!--  PerfectScrollbar Library -->
    <script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/js/demo.js"></script>

</html>
