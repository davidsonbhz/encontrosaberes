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

        $list = mysqli_query($link, "select * from vw_trabalhos;");
        ?>

        <div class="wrapper">
             <?php include("menu.php")?>
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
                            <a class="navbar-brand" href="#"> Projetos </a>
                        </div>
                        <div class="collapse navbar-collapse">
                            
                        </div>
                    </div>
                </nav>

                <!-- TABELA LISTAR -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Projetos</h4>
                                        <p class="category">Todos os projetos cadastrados</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                            <th>Nome do Apresentador</th>
                                            <th>Nome do Projeto</th>
                                            <th>Avaliador</th>
                                            <!-- <th>Salary</th> -->
                                            </thead>
                                            <tbody>

                                                <?php
                                                while ($l = mysqli_fetch_assoc($list)) {
                                                    
                                                    $idtrabalho = $l['idtrabalho'];
                                                    $titulo = $l['titulo'];
                                                    $nomeautor = $l['autorprincipal'];
                                                    $nomeavaliador = $l['nomeavaliador'];

                                                    echo "<tr>";
                                                    echo "<td> $titulo</td>";
                                                    echo "<td> $nomeautor</td>";
                                                    echo "<td> $nomeavaliador</td>";
                                                    echo "<td> <a href='./editar.php?idtrabalho=$idtrabalho' class='btn btn-primary btn-round'>Editar</a></td>";

                                                    echo "</tr>";
                                                }
                                                ?>

                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="card card-plain">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Table on Plain Background</h4>
                                        <p class="category">Here is a subtitle for this table</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Salary</th>
                                                <th>Country</th>
                                                <th>City</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Dakota Rice</td>
                                                    <td>$36,738</td>
                                                    <td>Niger</td>
                                                    <td>Oud-Turnhout</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Minerva Hooper</td>
                                                    <td>$23,789</td>
                                                    <td>Curaçao</td>
                                                    <td>Sinaai-Waas</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Sage Rodriguez</td>
                                                    <td>$56,142</td>
                                                    <td>Netherlands</td>
                                                    <td>Baileux</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Philip Chaney</td>
                                                    <td>$38,735</td>
                                                    <td>Korea, South</td>
                                                    <td>Overland Park</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Doris Greene</td>
                                                    <td>$63,542</td>
                                                    <td>Malawi</td>
                                                    <td>Feldkirchen in Kärnten</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Mason Porter</td>
                                                    <td>$78,615</td>
                                                    <td>Chile</td>
                                                    <td>Gloucester</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
