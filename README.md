# Sistema de Upload e Armazenamento de XML

Este projeto permite o upload de arquivos XML, a validação de dados específicos, e o armazenamento do conteúdo XML em um banco de dados.

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)
- Composer (para gerenciar dependências, se necessário)

## Configuração

1. **Clonar o Repositório**

   Clone o repositório para o seu ambiente local
2. **Banco de dados**
    Insira o seguinte SQL:
    CREATE DATABASE nf_register;

USE nf_register;

CREATE TABLE IF NOT EXISTS notas_fiscais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_nota VARCHAR(255) NOT NULL,
    data_registro DATE NOT NULL,
    destinatario VARCHAR(255) NOT NULL,
    valor_total DECIMAL(10, 2) NOT NULL,
    xml_content TEXT NOT NULL
);

3. **Rodar o PHP**
    No meu caso eu rodei no MAMP, se for rodar em algum xampp, mamp etc tera que jogar esse projeto no htdocs 