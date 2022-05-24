-- =====================================================================================
-- 2022 : projet généalogie
-- =====================================================================================

insert into famille (id, nom) values (1001, 'HELOSEPT');
insert into individu (famille_id, id, nom, prenom, sexe, pere, mere) values (1001, 0, '?', '?', '?', 0, 0);

insert into individu values (1001, 1, 'HELOSEPT', 'pierre', 'H', 0, 0);
insert into individu values (1001, 2, 'HELOSEPT', 'martine', 'F', 0, 0);

insert into individu values (1001, 3, 'HELOSEPT', 'prof', 'H', 1, 2);
insert into individu values (1001, 4, 'HELOSEPT', 'timide', 'H', 1, 2);
insert into individu values (1001, 5, 'HELOSEPT', 'atchoum', 'H', 1, 2);
insert into individu values (1001, 6, 'HELOSEPT', 'joyeux', 'H', 1, 2);
insert into individu values (1001, 7, 'HELOSEPT', 'simplet', 'H', 1, 2);
insert into individu values (1001, 8, 'HELOSEPT', 'dormeur', 'H', 1, 2);
insert into individu values (1001, 9, 'HELOSEPT', 'grincheux', 'H', 1, 2);

insert into lien values (1001, 1, 1, 2, 'MARIAGE', 1920-01-01, 'Hollywood');
