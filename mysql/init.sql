CREATE TABLE orders_twd (
    id varchar(255) NOT NULL,
    name varchar(255),
    city varchar(255),
    district varchar(255),
    street varchar(255),
    price varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE orders_usd (
    id varchar(255) NOT NULL,
    name varchar(255),
    city varchar(255),
    district varchar(255),
    street varchar(255),
    price varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE orders_jpy (
    id varchar(255) NOT NULL,
    name varchar(255),
    city varchar(255),
    district varchar(255),
    street varchar(255),
    price varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE orders_rmb (
    id varchar(255) NOT NULL,
    name varchar(255),
    city varchar(255),
    district varchar(255),
    street varchar(255),
    price varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE orders_myr (
    id varchar(255) NOT NULL,
    name varchar(255),
    city varchar(255),
    district varchar(255),
    street varchar(255),
    price varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE orders_uid (
    id varchar(255) NOT NULL,
    currency varchar(255) NOT NULL,
    UNIQUE (id)
);