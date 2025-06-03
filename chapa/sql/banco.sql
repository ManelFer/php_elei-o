CREATE DATABASE sistema_votacao;
USE sistema_votacao;

CREATE TABLE chapas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(10) NOT NULL UNIQUE,
    nome_chapa VARCHAR(100) NOT NULL,
    matricula_lider VARCHAR(20) NOT NULL,
    nome_lider VARCHAR(100) NOT NULL,
    matricula_vice VARCHAR(20) NOT NULL,
    nome_vice VARCHAR(100) NOT NULL
);

CREATE TABLE alunos (
    matricula VARCHAR(20) PRIMARY KEY,
    nome VARCHAR(100),
    votou BOOLEAN DEFAULT FALSE
);

CREATE TABLE votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula_aluno VARCHAR(20),
    chapa_id INT,
    FOREIGN KEY (matricula_aluno) REFERENCES alunos(matricula),
    FOREIGN KEY (chapa_id) REFERENCES chapas(id)
);