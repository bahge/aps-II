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