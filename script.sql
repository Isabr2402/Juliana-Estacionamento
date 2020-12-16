drop database if exists juliana;
create database juliana;
use juliana;

create table automoveis(
    id integer primary key auto_increment not null,
    placa varchar(7) not null unique
);
create table estacionamento(
    id_auto integer not null,
    ent datetime not null,
    sai datetime,
    custo decimal,
    id integer primary key auto_increment not null,
    CONSTRAINT fkid_auto FOREIGN KEY (id_auto) REFERENCES automoveis(id)
);

insert into automoveis(placa) values('AAA1234');
insert into automoveis(placa) values('BBB1234');
insert into automoveis(placa) values('CCC1234');
insert into automoveis(placa) values('DDD1234');
insert into automoveis(placa) values('EEE1234');
insert into automoveis(placa) values('FFF1234');

insert into estacionamento(id_auto, ent, sai) values(1,now(),date_add(now(),interval 2 hour));
insert into estacionamento(id_auto, ent, sai) values(2,now(),date_add(now(),interval 4 hour));
insert into estacionamento(id_auto, ent, sai) values(3,now(),date_add(now(),interval 1 hour));
insert into estacionamento(id_auto, ent, sai) values(4,now(),date_add(now(),interval 5 hour));
insert into estacionamento(id_auto, ent, sai) values(5,now(),date_add(now(),interval 8 hour));

show tables;

select * from automoveis;
select * from estacionamento;

