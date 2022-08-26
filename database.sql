CREATE DATABASE IF NOT EXISTS api_rest_laravel;
USE api_rest_laravel;

CREATE TABLE users(
id              int(255) auto_increment not null,
name            varchar(50) NOT NULL,
surname         varchar(100),
role            varchar(20),
email           varchar(255) NOT NULL,
password        varchar(255) NOT NULL,
description     text,
image           varchar(255),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'admin', 'admin', 'ROLE_ADMIN', 'admin@admin.com', 'admin', 'descripcion admin', NULL, CURTIME(), CURTIME(), NULL);

CREATE TABLE categories(
id              int(255) auto_increment not null,
name            varchar(100),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_categories PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categories VALUES(NULL, 'Ordenadores', CURTIME(), CURTIME());
INSERT INTO categories VALUES(NULL, 'Móviles y tabletas', CURTIME(), CURTIME());

CREATE TABLE posts(
id              int(255) auto_increment not null,
user_id         int(255) not null,
category_id     int(255) not null,
title           varchar(255) not null,
content         text not null,
image           varchar(255),
created_at      datetime DEFAULT NULL,
updated_at      datetime DEFAULT NULL,
CONSTRAINT pk_posts PRIMARY KEY(id),
CONSTRAINT fk_post_user FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_post_category FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDb;

INSERT INTO posts VALUES(NULL, 1, 2, 'Samsung Galaxy S8', 'Contenido de Samsung Galaxy S8', NULL, CURTIME(), CURTIME());
INSERT INTO posts VALUES(NULL, 1, 1, 'Lenovo Gaming', 'Contenido de Lenovo Gaming', NULL, CURTIME(), CURTIME());
INSERT INTO posts VALUES(NULL, 1, 1, 'Intel i5', 'Contenido de Intel i5', NULL, CURTIME(), CURTIME());
