/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  marialuisa
 * Created: 06/11/2017
 */
delimiter |



drop procedure if exists IMPORTAR_INSCRICAO |

create procedure IMPORTAR_INSCRICAO()
ThisSP:begin
    declare vnome varchar(45);
    declare vemail varchar(80);
    declare vcpf varchar(15);
    declare vsenha varchar(200);
    declare vidtrabalho integer;
    declare vidsubevento integer; 
    declare vtitulo varchar(355);
    declare vresumo text;
    declare vpalavras varchar(255);
    declare vcodigoposter varchar(45);
    declare vnomeapresentador varchar(45);
    declare videvento integer;
    declare vcont integer;
	declare vpos integer;
    declare flag boolean;
    declare erro integer;
    
    
    DECLARE cursor1 CURSOR FOR SELECT i.nome, i.email, i.cpf, i.password, t.id,t.fgk_categoria, 
		t.titulo_enviado, t.resumo_enviado, t.palavras_chave, a.cod_poster, i.nome, t.fgk_status
        from es_inscritos i inner join es_trabalho t on i.id=t.fgk_inscrito_responsavel 
        inner join es_trabalho_apresentacao a on t.id=a.fgk_trabalho 
        inner join es_trabalho_apresentacao ta on t.id=ta.fgk_trabalho
        where i.fgk_evento=8 and t.fgk_evento=8;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET flag=false;
    declare continue handler for SQLEXCEPTION set erro = 1;
    
	delete from log;
    
    select max(id) into videvento  from es_evento;
    
	SELECT count(*) into vcont from es_inscritos i inner join es_trabalho t on i.id=t.fgk_inscrito_responsavel 
        inner join es_trabalho_apresentacao a on t.id=a.fgk_trabalho where i.fgk_evento = videvento;

	if (vcont = 0) then 
		insert into log values ('nao ha registros para incluir');
		LEAVE ThisSP;
	end if;
    insert into log values (concat('Processando: ',vcont,' inscricoes'));

    open cursor1;
    set vpos = 0;
	rep1: REPEAT     
		FETCH cursor1 INTO vnome, vemail,vcpf, vsenha,vidtrabalho,vidsubevento, vtitulo,vresumo, vpalavras, vcodigoposter, vnomeapresentador;    
        CALL INSERE_PROJETO(vnome, vemail,vcpf, vsenha,vidtrabalho,videvento,vidsubevento, vtitulo,vresumo, vpalavras, vcodigoposter, vnomeapresentador);
		
        set vpos = vpos+1;
        insert into log values(concat(vnome, ' ', vpos, ' ', vcont));
        if(vpos>=vcont) then
			set flag = true;
        end if;
	UNTIL flag end repeat;
    insert into log values (concat(vpos,' registros processados'));
    
    close cursor1;
end; |

drop procedure if exists IMPORTAR_AVALIACAO_TRABALHO |
create procedure IMPORTAR_AVALIACAO_TRABALHO()
begin
    declare vidtrabalho integer;
    declare vidapresentador varchar(15);
    declare flag boolean;
    declare vcont, vpos integer;

    DECLARE cursor1 CURSOR FOR SELECT t.fgk_trabalho, t.fgk_revisor from es_trabalho_apresentacao t inner join es_trabalho e on t.fgk_trabalho=e.id where e.fgk_evento = (select max(id) from es_evento);
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET flag=false;

	SELECT count(*) into vcont from es_trabalho_apresentacao t inner join es_trabalho e on t.fgk_trabalho=e.id where e.fgk_evento = (select max(id) from es_evento);

open cursor1;
    start transaction;
        rep1: REPEAT     
            FETCH cursor1 INTO vidtrabalho, vidapresentador;    
            CALL INSERE_AVALIACAO_TRABALHO(vidtrabalho, vidapresentador);
			
            set vpos = vpos+1;
			if(vpos>=vcont) then
				set flag = true;
			end if;
            
        UNTIL flag end repeat;
    commit;
    close cursor1;

end; |