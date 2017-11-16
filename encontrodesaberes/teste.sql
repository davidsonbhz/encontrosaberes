
-- select * from vw_trabalhos where idtrabalho=123;

-- select atr.*, ins.nome from avaliacao_trabalho atr inner join inscricao ins on ins.idinscricao = atr.fkinscricao and atr.fktrabalho = 123 ;

call REGISTRA_VOTO(123, 80, 'CLAREZA', 3);
select idcriterioavaliacao 
from criterioavaliacao where fkidsubevento=1 and descricao=trim('CLAREZA');

select * from criterioavaliado;
select * from criterioavaliacao;

select * from avaliacao_trabalho;
update trabalho set fkidsubevento=1;
select * from trabalho;
delete from criterioavaliado;