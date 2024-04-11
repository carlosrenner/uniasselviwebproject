Trabalho da Uniasselvi, implementando uma aplicação web.
A ideia é um registro simples de Carros.

Colocar os arquivos na pasta htdocs do XAMPP, e executar a Query a seguir no Banco de Dados mysql:
Create Database meusite;
Use Database meusite;
-- Tabela de Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255)
);

-- Tabela de Veículos
CREATE TABLE veiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(100),
    modelo VARCHAR(100),
    ano INT,
    cor VARCHAR(50),
    placa VARCHAR(8),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
