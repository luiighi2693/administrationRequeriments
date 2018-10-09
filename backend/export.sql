create table requeriments
(
  id                int auto_increment,
  priority          int                           null,
  idRow             varchar(50)                   null,
  team              varchar(250)                  null,
  deadLine          varchar(50)                   null,
  pointRequeriment  varchar(100)                  null,
  feature           varchar(500)                  null,
  description       varchar(5000)                 null,
  link              varchar(1500)                 null,
  statusRequeriment varchar(50)                   null,
  approved          varchar(10)                   null,
  orderRequeriment  int                           null,
  colorStatus       varchar(50) default '#ffffff' null,
  impact            varchar(5000)                 null,
  swapped           varchar(10) default 'false'   null,
  constraint requeriments_id_uindex
  unique (id)
);

alter table requeriments
  add primary key (id);

create table comments
(
  id                   int auto_increment,
  usernameComment      varchar(100)  null,
  dateComment          varchar(50)   null,
  contentComment       varchar(5000) null,
  emailToNotifyComment varchar(50)   null,
  flagComment          varchar(50)   null,
  usernameAnswer       varchar(100)  null,
  dateAnswer           varchar(50)   null,
  contentAnswer        varchar(5000) null,
  emailToNotifyAnswer  varchar(50)   null,
  flagAnswer           varchar(50)   null,
  idRequeriment        int           null,
  constraint comments_id_uindex
  unique (id),
  constraint comments_requeriments_id_fk
  foreign key (idRequeriment) references requeriments (id)
    on update cascade
    on delete cascade
);

alter table comments
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

