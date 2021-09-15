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

create table exam
(
    id int PRIMARY KEY AUTO_INCREMENT,
    simulado varchar(100) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table passrecovery
(
    id int PRIMARY KEY AUTO_INCREMENT,
    verificacao varchar(200) NOT NULL,
    id_user int NOT NULL,
    login varchar(100) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);