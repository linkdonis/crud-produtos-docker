# CRUD de Produtos com PHP, MySQL e Docker

## Descrição

Este projeto consiste em um sistema web simples para cadastro e gerenciamento de produtos.

A aplicação permite realizar as quatro operações básicas de um CRUD:

- Criar produtos;
- Listar produtos;
- Editar produtos;
- Excluir produtos.

O projeto foi desenvolvido utilizando PHP, MySQL, Apache e Docker Compose.

O objetivo principal é demonstrar a utilização de containers para separar a aplicação web do banco de dados, permitindo que o sistema seja executado em um ambiente padronizado.

---

## Tecnologias utilizadas

- PHP 8.2
- Apache
- MySQL 8.0
- Docker
- Docker Compose
- PDO
- HTML
- CSS

---

## Estrutura do projeto

```text
trab_devops/
│
├── app/
│   ├── conexao.php
│   ├── criar.php
│   ├── editar.php
│   ├── excluir.php
│   └── index.php
│
├── Dockerfile
├── docker-compose.yml
└── README.md

## Pré-requisitos

- Docker
- Docker Compose

## Passo a Passo para Executar o Projeto

1. **Clonar o repositório:**
   ```bash
   git clone [https://github.com/linkdonis/crud-produtos-docker.git](https://github.com/linkdonis/crud-produtos-docker.git)
   cd crud-produtos-docker