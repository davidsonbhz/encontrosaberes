create or replace view vw_notas as
select atr.idavaliacao, tr.idtrabalho, tr.titulo, ic.nome autorprincipal, ic.idinscricao, 
avl.nome nomeavaliador, avl.idinscricao idavaliador, ct.descricao, ct.codigo, ca.nota 
from inscricao ic 
inner join trabalho tr on tr.fkidautorprincipal=ic.idinscricao
inner join avaliacao_trabalho atr on atr.fktrabalho=tr.idtrabalho
inner join inscricao avl on avl.idinscricao=atr.fkinscricao
inner join criterioavaliacao ct on  ct.fkidsubevento=tr.fkidsubevento
left join criterioavaliado ca on ca.fkidcriterioavaliacao=ct.idcriterioavaliacao and ca.fkidavaliacao=atr.idavaliacao;

create or replace view vw_notas_criterios as
select tr.idtrabalho, tr.titulo, ic.nome avaliador, ca.fkidcriterioavaliacao, 
NOTA_CRITERIO('A', ca.fkidavaliacao) 'A', NOTA_CRITERIO('B', ca.fkidavaliacao) 'B', NOTA_CRITERIO('C', ca.fkidavaliacao) 'C', 
NOTA_CRITERIO('D', ca.fkidavaliacao) 'D', NOTA_CRITERIO('E', ca.fkidavaliacao) 'E'
from trabalho tr
inner join avaliacao_trabalho av on tr.idtrabalho=av.fktrabalho
inner join inscricao ic on ic.idinscricao=av.fkinscricao
left join criterioavaliado ca on ca.fkidavaliacao=av.idavaliacao
group by av.fkinscricao
;

create or replace view vw_trabalhos as
select tr.titulo, tr.idtrabalho, tr.fkidsubevento, ins.nome autorprincipal, avt.fkinscricao avaliador, avl.nome nomeavaliador,
avt.votado,
FITENS_AVAL2(tr.idtrabalho) criterios 
from trabalho tr
inner join inscricao ins on tr.fkidautorprincipal=ins.idinscricao
inner join avaliacao_trabalho avt on avt.fktrabalho=tr.idtrabalho
inner join inscricao avl on avl.idinscricao=avt.fkinscricao
;


create or replace view vw_trabalhos2 as
select tr.titulo, tr.idtrabalho, ins.nome autorprincipal,
FITENS_AVAL2(tr.idtrabalho) criterios 
from trabalho tr
inner join inscricao ins on tr.fkidautorprincipal=ins.idinscricao
;


create or replace view vw_info_trabalho as
select tr.titulo, tr.idtrabalho, ins.nome autorprincipal, avt.fkinscricao avaliador, avl.nome nomeavaliador,
GROUP_CONCAT(crit.descricao order by crit.idcriterioavaliacao SEPARATOR ', ' ) as itensavaliacao 
from trabalho tr
inner join inscricao ins on tr.fkidautorprincipal=ins.idinscricao
inner join avaliacao_trabalho avt on avt.fktrabalho=tr.idtrabalho
inner join inscricao avl on avl.idinscricao=avt.fkinscricao
inner join criterioavaliacao crit on crit.fkidsubevento=tr.fkidsubevento;


create or replace view vw_avaliadores as
select ins.idinscricao idavaliador, ins.nome nomeavaliador
from inscricao ins
inner join avaliacao_trabalho av on ins.idinscricao=av.fkinscricao
group by ins.idinscricao;