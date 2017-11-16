

$(function () {
    // Handler for .ready() called.

    $.ajax({
        url: "infovoto.php?idtrabalho=" + idtrabalho,
        context: document.body
    }).done(function (t) {
        //$(this).addClass("done");
        //alert(t);
        eval(t);
        
        
        
        if((indicacaomelhor+indicacaomencao)>0) {
            //$('input:radio[name="premiado"]').attr('checked', 'checked');
            $('#sim').attr('checked', 'checked');
            Mudarestado('divCampos', 1);
            just = Array();
            just.push($("#j1"));
            just.push($("#j2"));
            just.push($("#j3"));
            just.push($("#j4"));
            just.push($("#j5"));
            
            if(indicacaomelhor==1) {
                $("#mt").prop('checked', true);
            }
            if(indicacaomencao==1) {
                $("#mh").prop('checked', true);
            }
            
            
            //alert(just[1].attr('value'));
            for(i=0;i<indicacao.length;i++) {
                for(j=0;j<just.length;j++) {
                    if(just[j].attr('value')==indicacao[i]) {
                        just[j].prop('checked', true);
                        
                    }
                }
            }
            
        }
        
        for (i = 0; i < criterios.length; i++) {
            console.log("nota " + i + " "+notas[i]);
            $("#nota"+criterios[i]).rateYo("option", "rating", notas[i]);
        }

    });


});


