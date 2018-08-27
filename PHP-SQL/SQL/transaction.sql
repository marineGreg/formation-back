BEGIN; -- début de la transaction

SELECT * FROM employe;

UPDATE employe SET salaire = salaire + 100 WHERE id = 1;

SELECT * FROM employe;

ROLLBACK; -- annule la modification


BEGIN; -- début de la transaction

SELECT * FROM employe;

UPDATE employe SET salaire = salaire + 100 WHERE id = 1;

SELECT * FROM employe;

COMMIT; -- enregistre la modification