
<html>

    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    </head>

    <body>

        <?php
            
        if(isset($_REQUEST['f1'])) {
            $nota1 = $_REQUEST['f1'];
            $nota2 = $_REQUEST['f2'];
            $nota3 = $_REQUEST['f3'];
            $nota4 = $_REQUEST['f4'];
            $nota5 = $_REQUEST['f5'];
            
            echo "$nota1 - $nota2 - $nota3 - $nota4 - $nota5";
        }
        
        ?>
        
        <div id="nota1"></div>
        <div id="nota2"></div>
        <div id="nota3"></div>
        <div id="nota4"></div>
        <div id="nota5"></div>

        <form method="post" id="formdados">
            
            <input type="hidden" id="f1" name="f1">
            <input type="hidden" id="f2" name="f2">
            <input type="hidden" id="f3" name="f3">
            <input type="hidden" id="f4" name="f4">
            <input type="hidden" id="f5" name="f5">
            
            <input type="button" onclick="salvar()" value="Salvar">
            
        </form>
        
        

        <script src="jquery.min.js"></script>
        <script src="jquery.rateyo.js"></script>

        <script>
            
            function salvar() {
                $("#f1").val($("#nota1").rateYo("option", "rating"));
                $("#f2").val($("#nota2").rateYo("option", "rating"));
                $("#f3").val($("#nota3").rateYo("option", "rating"));
                $("#f4").val($("#nota4").rateYo("option", "rating"));
                $("#f5").val($("#nota5").rateYo("option", "rating"));
                
                $("#formdados").submit();
            }

            $(function () {

                $("#nota1").rateYo({
                    rating: 4,
                    maxValue: 10,
                    numStars: 10,
                    precision: 0
                });
                
                $("#nota2").rateYo({
                    rating: 4,
                    maxValue: 10,
                    numStars: 5
                });
                
                $("#nota3").rateYo({
                    rating: 4,
                    maxValue: 10,
                    numStars: 5
                });
                
                $("#nota4").rateYo({
                    rating: 4,
                    maxValue: 10,
                    numStars: 5
                });

                $("#nota5").rateYo({
                    rating: 4,
                    maxValue: 10,
                    numStars: 5
                });

            });

        </script>

    </body>

</html>

