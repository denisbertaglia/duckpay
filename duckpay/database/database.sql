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
    foreign key (user_id) references users(id),
    primary key (id autoincrement)
);

CREATE TABLE shopkeepers
(
    id          integer not null,
    cnpj         varchar   not null,
    balance     varchar    not null,
    user_id     integer    not null,
    created_at  datetime,
    updated_at  datetime,
    foreign key (user_id) references users(id),
    primary key (id autoincrement )
);

CREATE TABLE customers
(
    id          integer not null,
    cpf         varchar    not null,
    balance     varchar default '0' not null,
    user_id     integer    not null,
    created_at  datetime,
    updated_at  datetime,
    foreign key (user_id) references users(id),
    primary key (id autoincrement )
);

CREATE TABLE finacialtransfers
(
    id            integer             not null,
    customer_id   integer             not null,
    shopkeeper_id integer             not null,
    amount        varchar default '0' not null,
    created_at    datetime,
    updated_at    datetime,
    foreign key (customer_id) references customers(id),
    foreign key (shopkeeper_id) references shopkeepers(id),
    primary key (id autoincrement)
);
