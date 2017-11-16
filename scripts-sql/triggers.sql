drop trigger if exists tgr_avalia;


delimiter |

CREATE TRIGGER tgr_avalia BEFORE INSERT ON `criterioavaliado` FOR EACH ROW
BEGIN
    update avaliacao_trabalho set criterios=criterios+1 where idavaliacao=new.fkidavaliacao;
END;
|

