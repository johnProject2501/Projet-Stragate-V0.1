
create database travelfree;
use travelfree;

create table travel (id int auto_increment primary key not null,titre text not null,description text ,photo1 varchar(128),prix int (5) not null,date_depart date not null,
date_fin date not null, nb_voyageur int (2), vaccin int (1),age_mini int (1),animaux int (1),assurance int (1), permis int (1) );


