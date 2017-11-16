DELIMITER |

drop procedure if exists REGISTRA_AVALIACAO |
create procedure REGISTRA_AVALIACAO(vidtrabalho integer, vidavaliador integer, vcriterio varchar(50), vnota integer, premiado integer)
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
