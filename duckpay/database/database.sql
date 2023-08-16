CREATE TABLE users
(
    id         integer             not null,
    user_type  integer default '0' not null,
    name       varchar             not null,
    password   varchar             not null,
    created_at datetime,
    updated_at datetime,
    primary key (id autoincrement)
);

CREATE TABLE emails
(
    id         integer    not null,
    email      varchar    not null,
    login      tinyint(1) not null,
    user_id    integer    not null,
    created_at datetime,
    updated_at datetime,
    primary key (id autoincrement)
);
