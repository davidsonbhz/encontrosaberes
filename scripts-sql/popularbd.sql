select * from es_evento;
select * from evento;
select * from es_categorias;
select * from subevento;

insert into subevento(idsubevento,fkidevento,descricao) select id_categoria,8,
descricao_categoria from es_categorias;

insert into evento(idevento,nomeevento) select id,titulo from es_evento;



select count(*) from inscricao;
select * from inscricao;
select count(*) from es_trabalho;
select * from es_inscritos where fgk_evento=8;
select * from es_inscritos where cpf='063.080.836-82';

select id,nome,departamento,email from es_inscritos where bool_revisor=1 order by nome;
select * from es_avaliacao;
select * from es_avaliacao_revisor where fgk_inscrito=177;
select * from trabalho;



SELECT i.bool_revisor, i.fgk_tipo, i.nome, i.email, i.cpf, i.password, t.id,t.fgk_categoria, t.titulo_enviado, t.resumo_enviado, t.palavras_chave, a.cod_poster, i.nome  
        from es_inscritos i inner join es_trabalho t on i.id=t.fgk_inscrito_responsavel 
        inner join es_trabalho_apresentacao a on t.id=a.fgk_trabalho where i.fgk_evento = 8;

select * from es_trabalho where fgk_evento=8;
select * from es_trabalho where id=2055;
select * from trabalho where idtrabalho=2055;

select * from avaliacao_trabalho;

delete from inscricao;
call IMPORTAR_INSCRICAO();
call IMPORTAR_AVALIACAO_TRABALHO();

