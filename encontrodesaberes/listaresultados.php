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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <!--  Material Dashboard CSS    -->
        <link href="assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    </head>

    <body>affected_rows
        <?php
        include './suporte/conexao.php';
        ?>

        <div class="wrapper">
            <?php include("menu.php") ?>
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
                            <a class="navbar-brand" href="#"> Resultados </a>
                        </div>
                        <div class="collapse navbar-collapse">

                        </div>
                    </div>
                </nav>

                <!-- TABELA LISTAR -->
                <div class="content">
                    <div class="container-fluid">
                        <table class="table">
                            <thead>
                            <td>Titulo</td>
                            <td>Avaliador</td>
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                            <td>D</td>
                            <td>E</td>

                            </thead>
                            <tbody>



                                <?php
                                $list = mysqli_query($link, "select * from vw_notas_criterios order by idtrabalho");

                                while ($l = mysqli_fetch_assoc($list)) {

                                    $idtrabalho = $l['idtrabalho'];
                                    $titulo = $l['titulo'];
                                    $nomeavaliador = $l['avaliador'];
                                    $A = $l['A'];
                                    $B = $l['B'];
                                    $C = $l['C'];
                                    $D = $l['D'];
                                    $E = $l['E'];


                                    echo "<tr>";
                                    echo "<td> $idtrabalho - $titulo</td>";
                                    echo "<td> $nomeavaliador</td>";
                                    echo "<td> $A</td>";
                                    echo "<td> $B</td>";
                                    echo "<td> $C</td>";
                                    echo "<td> $D</td>";
                                    echo "<td> $E</td>";

                                    echo "</tr>";
                                }
                                ?>


                            </tbody>

                        </table>
                    </div>
                    </body>
                    <!--   Core JS Files   -->
                    <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
                    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
                    <script src="assets/js/material.min.js" type="text/javascript"></script>
                    <!--  Charts Plugin -->
                    <script src="assets/js/chartist.min.js"></script>
                    <!--  Dynamic Elements plugin -->
                    <script src="assets/js/arrive.min.js"></script>
                    <!--  PerfectScrollbar Library -->
                    <script src="assets/js/perfect-scrollbar.jquery.min.js"></script>
                    <!--  Notifications Plugin    -->
                    <script src="assets/js/bootstrap-notify.js"></script>
                    <!--  Google Maps Plugin    -->
                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
                    <!-- Material Dashboard javascript methods -->
                    <script src="assets/js/material-dashboard.js?v=1.2.0"></script>
                    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
                    <script src="assets/js/demo.js"></script>

                    </html>
