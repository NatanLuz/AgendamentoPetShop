-- Banco para PetShop

CREATE DATABASE IF NOT EXISTS petshop_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE petshop_db;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  telefone VARCHAR(50),
  email VARCHAR(150)
);

CREATE TABLE IF NOT EXISTS pets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  nome VARCHAR(150) NOT NULL,
  especie VARCHAR(100),
  idade INT,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  pet_id INT NOT NULL,
  data DATE NOT NULL,
  horario TIME NOT NULL,
  tipo_servico VARCHAR(150),
  status VARCHAR(50) DEFAULT 'Agendado',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE
);

-- Cria usuário admin de teste
INSERT INTO usuarios (nome, username, senha) VALUES ('Admin','admin', '$2y$10$e0NRy7jJw1/0aY9Zl5V8cOqYc7aJp8cQKqN1o0nQxE.q1nYkVQyG6');
-- senha 'admin123' hash gerado com password_hash('admin123', PASSWORD_DEFAULT)
