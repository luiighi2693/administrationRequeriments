create table requeriments
(
  id                int auto_increment,
  priority          int           null,
  idRow             varchar(50)   null,
  team              varchar(250)  null,
  deadLine          varchar(50)   null,
  feature           varchar(500)  null,
  description       varchar(5000) null,
  link              varchar(1500) null,
  statusRequeriment varchar(50)   null,
  approved          varchar(10)   null,
  orderRequeriment  int           null,
  constraint requeriments_id_uindex
  unique (id)
);

alter table requeriments
  add primary key (id);

create table users
(
  id       int auto_increment,
  username varchar(500) null,
  psw      varchar(500) null,
  role     varchar(255) null,
  constraint users_id_uindex
  unique (id)
);

alter table users
  add primary key (id);


