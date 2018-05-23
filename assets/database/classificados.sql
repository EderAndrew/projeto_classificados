CREATE DATABASE `classificados`
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

CREATE TABLE usuarios(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    telefone VARCHAR(30),
    PRIMARY KEY(id)
)DEFAULT CHARSET = utf8;

CREATE TABLE categorias(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
)DEFAULT CHARSET = utf8;

CREATE TABLE anuncios(
    id INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_categoria INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    valor FLOAT NOT NULL,
    estado INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY(id_categoria) REFERENCES categorias(id)
)DEFAULT CHARSET = utf8;