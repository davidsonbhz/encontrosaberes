create or replace view vw_trabalhos as
select tr.titulo, ins.nome autorprincipal, avt.fkinscricao avaliador, ins.nome nomeavaliador,
 avt.criterios 
from trabalho tr
inner join inscricao ins on tr.fkidautorprincipal=ins.idinscricao
inner join avaliacao_trabalho avt
;

