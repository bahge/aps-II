create table user
(
    id int PRIMARY KEY AUTO_INCREMENT,
    login varchar(100) NOT NULL,
    pass varchar(150) NOT NULL,
    cpf varchar(20) NOT NULL,
    name varchar(150) NOT NULL,
    area text NULL,
    level int DEFAULT 0 NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table subject
(
    id int PRIMARY KEY AUTO_INCREMENT,
    assunto varchar(100) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table jury
(
    id int PRIMARY KEY AUTO_INCREMENT,
    banca varchar(50) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table role
(
    id int PRIMARY KEY AUTO_INCREMENT,
    cargo varchar(50) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table discipline
(
    id int PRIMARY KEY AUTO_INCREMENT,
    disciplina varchar(100) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);