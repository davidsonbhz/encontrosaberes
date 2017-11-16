
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
    <?php include("../style.php") ?>

    <?php include("../script.php") ?>
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
        echo "var idtrabalho='$trabalho';";

        echo "</script>";
        ?>

        <!-- Wrapper -->
        <div id="wrapper">

            <!-- Main -->
            <section id="wrapper">
                <header>
                        <!-- <span class="avatar"><img src="images/avatar.jpg" alt="" /></span> -->
                    <h1 style="font-weight: bold"> <?= $tituloprojeto ?></h1>
                    <h2 class="center1" style="color:'black'"><?= $autorprincipal ?></h2>
                </header>

                <form method="post" id="formdados" action="registravoto.php">
                    <input type="hidden" name="idtrabalho" value="<?= $trabalho ?>" />
                    <div> 
                        <div id="campos"></div>
                        <div id="estrelas"></div>
                    </div>
                    <hr/>

                    <div class="field">
                        <label>Considera que este trabalho deva ser premiado?</label>
                        <input type="radio" id="sim" value="sim" name="premiado" onclick="Mudarestado('divCampos', 1)" /><label for="sim">Sim</label>
                        <input type="radio" id="nao" value="nao" name="premiado" onclick="Mudarestado('divCampos', 0)"/><label for="nao">Não</label>
                    </div>
                    <div id="divCampos" class="row display">
                        <div class="form-group label-floating">

                            <div class="field">
                                <label>Como?</label>
                                <input type="radio" id="mt" value="mt" name="tipopremiacao" /><label for="mt">Melhor Trabalho</label>
                                <input type="radio" id="mh" value="mh" name="tipopremiacao" /><label for="mh">Menção Honrosa</label>
                            </div> 
                            <label>Justifique</label>
                            <div><input type="checkbox" id="j1" name="cbj[]" value="Domínio e clareza do trabalho apresentado"/><label for="j1">Domínio e clareza do trabalho apresentado</label></div>
                            <div><input type="checkbox" id="j2" name="cbj[]" value="Potencial do apresentador em ser um pesquisador"/><label for="j2">Potencial do apresentador em ser um pesquisador </label></div>
                            <div><input type="checkbox" id="j3" name="cbj[]" value="Capacidade de mostrar a relevância do trabalho apresentado"/><label for="j3">Capacidade de mostrar a relevância do trabalho apresentado</label></div>
                            <div><input type="checkbox" id="j4" name="cbj[]" value="Capacidade de avaliação crítica sobre o trabalho apresentado"/><label for="j4">Capacidade de avaliação crítica sobre o trabalho apresentado</label></div>
                            <div><input type="checkbox" id="j5" onclick="Mudarestado1('divOutro')"/><label for="j5">Outro</label></div>
                            <div id="divOutro" class="display"><input type="text" id="outro" name="outro"/></div>
                            <input type="hidden" name="justificativas" id="justificativas"/>
                        </div>
                    </div>
                    <br>
                    <input type="button" value="Salvar" id="btnsalvar">
                    <a href="listarprojetos.php" class="button">Voltar</a>

                </form>

            </section>

        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">                    
                    <a href="//www.albeom.com.br"><img src="../assets/img/albeom.png" style="width:100px" class="img-responsive"></a>
                </p>
            </div>
        </footer>
        <script src="../jquery.min.js"></script>
        <script src="../jquery.rateyo.js"></script>

        <script>

                                $(function () {

                                    for (i = 0; i < criterios.length; i++) {
                                        html = "<input type='hidden' id='f" + criterios[i] + "' name='f" + criterios[i] + "'>";
                                        $("#campos").append(html);
                                        star = "<div class='titulo'>" + descricoes[i] + "</div> <div id='nota" + criterios[i] + "'></div>";
                                        $("#estrelas").append(star);
                                        $('#nota' + criterios[i]).rateYo({
                                            rating: 0,
                                            maxValue: 5,
                                            numStars: 5,
                                            precision: 0,
                                            starWidth: "50px",
                                            spacing: "10px"
                                        });
                                    }
                                    //    retorna os dados selecionados no checkbox

                                    document.getElementById('btnsalvar').onclick = function () {
                                        var selchb = getSelectedChbox(this.form);     // gets the array returned by getSelectedChbox()
                                        selchb = selchb + ',' + $('#outro').val();
                                        $('#justificativas').val(selchb);
                                        for (i = 0; i < criterios.length; i++) {
                                            $('#f' + criterios[i]).val($("#nota" + criterios[i]).rateYo("option", "rating"));
                                        }
//                                        alert(selchb);
                                        $('#formdados').submit();
                                    };

                                });

                                var xcache = new Date().getTime();
                                var jq3 = document.createElement('script');
                                jq3.src = 'infovoto.js?' + xcache;
                                document.head.appendChild(jq3);

        </script>


    </body>

</html>

