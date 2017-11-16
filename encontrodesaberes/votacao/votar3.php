
<html>

    <head>
        <title>SistVotos</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="../assets/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    </head>

    <body>


        <script src="../jquery.min.js"></script>
        <script src="../jquery.rateyo.js"></script>

        <?php
        include_once "../../ldap/suporte/sessao.php";
        include_once "../../ldap/suporte/conexao.php";

        $trabalho = $_REQUEST['idtrabalho'];


        $l = mysqli_fetch_assoc(mysqli_query($link, "select * from vw_trabalhos where idtrabalho=$trabalho"));
        $criterios = $l['criterios'];
        $tituloprojeto = $l['titulo'];
        $autorprincipal = $l['autorprincipal'];
        $idsubevento = $l['fkidsubevento'];
        echo "<script>\ncriterios = Array();\n descricoes=Array();\n";
        $sql = "select * from criterioavaliacao where fkidsubevento=$idsubevento";
        $r = query($sql, false);

        while (($l = mysqli_fetch_assoc($r)) != null) {
            $crit = $l['idcriterioavaliacao'];
            $desc = $l['descricao'];
            echo "criterios.push('$crit');\n";
            echo "descricoes.push('$desc');\n";
        }

        echo "</script>";
        ?>
        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Main -->
            <section id="wrapper">
                <header>
                        <!-- <span class="avatar"><img src="images/avatar.jpg" alt="" /></span> -->
                    <h1> <?= $tituloprojeto ?></h1>
                    <p><?= $autorprincipal ?></p>
                </header>

                <form method="post" id="formdados" action="registravoto.php">
                    <input type="hidden" name="idtrabalho" value="<?= $trabalho ?>" />
                    <div id="campos"></div>
                    <div id="estrelas"></div>
                    <div class="field">
                        <label>Considera que este trabalho deva ser premiado?</label>
                        <input type="radio" id="robot_yes" name="robot" onclick="Mudarestado('divAvaliador')" /><label for="robot_yes">Sim</label>
                        <input type="radio" id="robot_no" name="robot" /><label for="robot_no">Não</label>
                    </div>
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
                    <button type="submit" class="btn btn-primary btn-round button" >Salvar</button>

                    <input type="button" onclick="salvar()" value="Salvar">
                </form>

            </section>

            <!-- Footer -->
            <footer id="footer">
                <ul class="copyright">
                    <li>&copy; Jane Doe</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                </ul>
            </footer>

        </div>

        <script src="../jquery.min.js"></script>
        <script src="../jquery.rateyo.js"></script>

        <script>

                        function salvar() {
                            for (i = 0; i < criterios.length; i++) {
                                $('#f' + criterios[i]).val($("#nota" + criterios[i]).rateYo("option", "rating"));
                            }

                            $("#formdados").submit();
                        }

                        $(function () {

                            for (i = 0; i < criterios.length; i++) {
                                html = "<input type='hidden' id='f" + criterios[i] + "'>";
                                $("#campos").append(html);
                                star = "<div class='titulo'>" + descricoes[i] + "</div> <div id='nota" + criterios[i] + "'></div>";
                                $("#estrelas").append(star);
                                $('#nota' + criterios[i]).rateYo({
                                    rating: 0,
                                    maxValue: 10,
                                    numStars: 10,
                                    precision: 0
                                });
                            }

                            alert($("#formdados").html());
                        });

        </script>

    </body>

</html>

