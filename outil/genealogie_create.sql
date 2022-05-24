-- =====================================================================================
-- 2022 : projet généalogie
-- 10/04/2022
-- =====================================================================================


create table if not exists famille (
  id integer not null,
  nom varchar(50) unique not null,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- =====================================================================================

create table if not exists individu (
  famille_id integer not null,
  id integer not null,
  nom varchar(50) not null,
  prenom varchar(50) not null,
  sexe varchar(1) check (sexe in ('F', 'H', 'f', 'h')), 
  pere integer not null,
  mere integer not null,
  primary key (id, famille_id),
  foreign key (famille_id) references famille(id),
  foreign key (pere) references individu(id),
  foreign key (mere) references individu(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- =====================================================================================

create table lien (
 famille_id integer not null,
 id integer not null,
 iid1 integer not null,
 iid2 integer not null,
 lien_type varchar(20) not null,
 lien_date varchar(10),
 lien_lieu varchar(50),
 primary key (id, famille_id),
 foreign key (iid1) references individu(id), 
 foreign key (iid2) references individu(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

-- =====================================================================================

create table evenement (
 famille_id integer not null,
 id integer not null,
 iid integer not null,
 event_type varchar(20) not null,
 event_date varchar(10), 
 event_lieu varchar(50),
 primary key (id, famille_id),
 foreign key (iid) references individu(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;



