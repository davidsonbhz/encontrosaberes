delimiter |

drop procedure if exists INSERE_PROJETO |

create procedure INSERE_PROJETO(vnome varchar(45), vemail varchar(80), vcpf varchar(15), vsenha varchar(200), 
vidtrabalho integer, videvento integer, vidsubevento integer, 
vtitulo varchar(355), vresumo text, vpalavras varchar(255), vcodigoposter varchar(45), vnomeapresentador varchar(45))
ThisSP:begin
    declare vinscricao integer;
    declare vidautorprincipal integer;
    declare vidapresentador integer;
    declare vcrits varchar(1000);
    declare erro int;
    declare vcont integer;
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE, 
            @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
            SET @full_error = CONCAT("ERROR ", @errno, " (", @sqlstate, "): ", @text);
            SELECT @full_error;
        END;

	select count(*) into vcont from inscricao where cpf=vcpf and idevento=videvento;
    
    if (vcont > 0) then 
		LEAVE ThisSP;
	end if;

    start transaction;

    insert into inscricao(nome,email,cpf,senha,idevento,datacad) values(vnome,vemail,trim(vcpf),vsenha,videvento,now());
    select max(idinscricao) into vinscricao from inscricao;

    insert into trabalho(idtrabalho, fkidautorprincipal, fkidapresentador, 
fkidsubevento,titulo,resumo,palavraschave,codigoposter,nomeapresentador,datacad) 
values(vidtrabalho, vinscricao, vinscricao, vidsubevento, vtitulo,vresumo, vpalavras, 
vcodigoposter, vnomeapresentador, now());
    
    commit;
end; |




drop procedure if exists JUSTIFICAR_VOTO |
create procedure JUSTIFICAR_VOTO(vidtrabalho integer, vidavaliador integer, vjustificativa varchar(50))
deterministic
begin
    declare vidavaliacao integer;
    select idavaliacao into vidavaliacao from avaliacao_trabalho where fktrabalho=vidtrabalho and fkinscricao=vidavaliador;
    insert into indicacao(idavaliacao,motivo) values(vidavaliacao,vjustificativa);


end; |

drop procedure if exists REGISTRA_VOTO |
create procedure REGISTRA_VOTO(vidtrabalho integer, vidavaliador integer, vcriterio varchar(50), vnota integer, premiado integer)
deterministic
begin
    declare vidavaliacao integer;
    declare vidcriterio integer;
    declare vidsubevento integer;
    declare vidcriterioavaliacao integer;
    
    select idavaliacao into vidavaliacao from avaliacao_trabalho where fktrabalho=vidtrabalho and fkinscricao=vidavaliador;
    select fkidsubevento into vidsubevento from trabalho where idtrabalho=vidtrabalho;
    select idcriterioavaliacao into vidcriterioavaliacao from criterioavaliacao where fkidsubevento=vidsubevento and descricao=trim(vcriterio);
    
    delete from criterioavaliado where fkidavaliacao=vidavaliacao and fkidcriterioavaliacao=vidcriterioavaliacao;
    delete from indicacao where idavaliacao = vidavaliacao;

    insert into criterioavaliado(fkidavaliacao,fkidcriterioavaliacao,nota,datacad) values(vidavaliacao,vidcriterioavaliacao,vnota,now());

    update avaliacao_trabalho set votado=1,datavoto=now() where idavaliacao=vidavaliacao;


end; |



drop procedure if exists INSERE_AVALIACAO_TRABALHO |
create procedure INSERE_AVALIACAO_TRABALHO(vidtrabalho integer, videntificador varchar(15))
begin
    declare vid integer;
    declare ct integer;
    declare vidsubevento integer;
    declare videvento integer;
    #caso o avaliador nao exista no banco, insere o mesmo. a prinicipio vamos considerar que seja o cpf
    select count(*) into ct from inscricao where cpf=trim(videntificador);
    
    if ct = 0 then
        select fkidsubevento into vidsubevento from trabalho where idtrabalho=vidtrabalho;
        select fkidevento into videvento from subevento where idsubevento=vidsubevento;
 
        insert into inscricao(idevento,nome,email,cpf,senha,datacad) values(videvento,'EXAMINADOR','xx@xx.com',trim(videntificador),'senha',now());
        select max(idinscricao) into vid from inscricao;
    else 
        select idinscricao into vid from inscricao where cpf=videntificador;
    end if;

    insert into avaliacao_trabalho(fktrabalho, fkinscricao,datacad, indicacaomelhor,indicacaomencao) 
    values(vidtrabalho, vid, now(), 0, 0);

end; |


drop function if exists NOTA_CRITERIO |
create function NOTA_CRITERIO(vcodigo char, vidavaliacao integer)
RETURNS int
deterministic
begin
    declare resp integer;
    select nota into resp from vw_notas where codigo=vcodigo and idavaliacao=vidavaliacao;
    return resp;
end; |


drop function if exists FITENS_AVAL |
create function FITENS_AVAL(vidsubevento integer)
RETURNS varchar(250)
deterministic
begin
    declare resp varchar(250);
    declare rt varchar(20);
    declare vidsubevento integer;
    declare existe_mais_linhas integer;
    DECLARE cursor1 CURSOR FOR SELECT descricao from criterioavaliacao where fkidsubevento=vidsubevento;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET existe_mais_linhas=1;
    open cursor1;
    set resp = 'n/a';
    -- Looping de execução do cursor
    meuLoop: LOOP
        FETCH cursor1 INTO rt;

        -- Controle de existir mais registros na tabela
        IF existe_mais_linhas = 1 THEN
            LEAVE meuLoop;
        END IF;

        -- conctena o texto
        SET resp = 'xxxx'; -- concat(resp, rt, ',');

        -- Retorna para a primeira linha do loop
    END LOOP meuLoop;

    return resp;
end; |



drop function if exists FITENS_AVAL2 |
create function FITENS_AVAL2(vidtrabalho integer)
RETURNS varchar(1024)
deterministic
begin
    declare resp varchar(1024);
    select GROUP_CONCAT(crit.descricao order by crit.idcriterioavaliacao SEPARATOR ', ' ) into resp 
    from trabalho tr
    inner join criterioavaliacao crit on crit.fkidsubevento=tr.fkidsubevento
    where tr.idtrabalho=vidtrabalho;
    
    return resp;
end; |





