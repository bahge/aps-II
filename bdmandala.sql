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

INSERT INTO user (
                  login,
                  pass,
                  cpf,
                  name,
                  level
                )
VALUES (
        'admin@admin.com',
        '$2y$10$UtYSVGF2YWJ1sMWzcYBL3eMmOFUiYdaBbI/nuTBDIowS1MRL9ioJi',
        '001.001.001-01',
        'Admin',
        1
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
    ano int NOT NULL,
    id_role int NOT NULL REFERENCES role (id) ON DELETE CASCADE,
    id_jury int NOT NULL REFERENCES jury (id) ON DELETE CASCADE,
    id_discipline int NOT NULL REFERENCES discipline (id) ON DELETE CASCADE,
    id_subject int NOT NULL REFERENCES subject (id) ON DELETE CASCADE,
    simulado varchar(100) NOT NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);

create table question
(
    id int PRIMARY KEY AUTO_INCREMENT,
    tipo int NOT NULL,
    pergunta text NOT NULL,
    resposta1 text NULL,
    resposta2 text NULL,
    resposta3 text NULL,
    resposta4 text NULL,
    resposta5 text NULL,
    explicacao text NOT NULL,
    correta text NOT NULL,
    id_exam int NULL,
    id_role int NULL,
    id_jury int NULL,
    id_discipline int NULL,
    id_subject int NULL,
    created timestamp DEFAULT CURRENT_TIMESTAMP,
    modified timestamp ON UPDATE CURRENT_TIMESTAMP
);