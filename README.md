# CRUD de Produtos com PHP, MySQL e Docker

## 📋 Descrição

Este projeto consiste em uma aplicação web simples para cadastro e gerenciamento de produtos.

A aplicação implementa as quatro operações básicas de um CRUD:

* **Criar** produtos;
* **Listar** produtos;
* **Editar** produtos;
* **Excluir** produtos.

O sistema foi desenvolvido utilizando PHP, MySQL, Apache, Docker e Docker Compose.

O principal objetivo do projeto é demonstrar a utilização de containers para executar uma aplicação web e um banco de dados de forma organizada e padronizada.

---

##  Objetivo do Projeto

O projeto foi desenvolvido para colocar em prática conceitos de desenvolvimento web e DevOps, principalmente a utilização do Docker e Docker Compose.

A aplicação é executada em um container separado do banco de dados, permitindo que cada serviço tenha sua própria responsabilidade.

Com o Docker Compose, toda a estrutura necessária para executar o projeto pode ser iniciada através de um único comando.

---

##  Entidade

A entidade principal utilizada no sistema é **Produto**.

Cada produto possui os seguintes campos:

| Campo           | Tipo         | Descrição                      |
| --------------- | ------------ | ------------------------------ |
| `id`            | INT          | Identificador único do produto |
| `nome`          | VARCHAR(255) | Nome do produto                |
| `descricao`     | TEXT         | Descrição do produto           |
| `data_cadastro` | DATETIME     | Data e horário do cadastro     |

O campo `id` é utilizado como chave primária e possui incremento automático.

---

##  Tecnologias Utilizadas

* PHP 8.2
* Apache
* MySQL 8.0
* Docker
* Docker Compose
* PDO
* HTML
* CSS

### PHP

Utilizado como linguagem principal para o desenvolvimento da aplicação.

### Apache

Utilizado como servidor web para executar a aplicação PHP.

### MySQL 8.0

Utilizado como banco de dados relacional para armazenar as informações dos produtos.

### PDO

Utilizado para realizar a conexão entre a aplicação PHP e o banco de dados MySQL.

### Docker

Utilizado para criar e executar os containers da aplicação e do banco de dados.

### Docker Compose

Utilizado para configurar e executar os diferentes serviços necessários para o funcionamento do projeto.

---

##  Estrutura do Projeto


crud-produtos-docker/
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
```

### Principais arquivos

#### `app/conexao.php`

Responsável pela conexão da aplicação com o banco de dados MySQL.

Também é responsável por verificar se a tabela `produtos` existe e criá-la automaticamente caso ainda não exista.

#### `app/index.php`

Página principal da aplicação, onde os produtos cadastrados são apresentados.

#### `app/criar.php`

Responsável pelo cadastro de novos produtos.

#### `app/editar.php`

Responsável pela alteração dos dados dos produtos.

#### `app/excluir.php`

Responsável pela exclusão dos produtos.

#### `Dockerfile`

Define a imagem utilizada para executar a aplicação PHP com Apache.

Também instala as extensões necessárias para a comunicação com o MySQL.

#### `docker-compose.yml`

Define os serviços, portas, volumes, variáveis de ambiente e rede utilizados pelo projeto.

---

#  Pré-requisitos

Para executar o projeto, é necessário possuir instalado:

* Docker
* Docker Compose
* Git

Não é necessário instalar PHP, Apache ou MySQL diretamente no computador, pois esses serviços são executados através dos containers Docker.

---

#  Como Clonar o Projeto

Abra o terminal ou Git Bash e execute:

```bash
git clone https://github.com/linkdonis/crud-produtos-docker.git
```

Depois, entre na pasta do projeto:

```bash
cd crud-produtos-docker
```

---

#  Como Executar o Projeto

Dentro da pasta do projeto, execute:

```bash
docker compose up -d --build
```

O comando possui duas opções importantes:

* `--build`: constrói as imagens necessárias para executar a aplicação;
* `-d`: executa os containers em segundo plano.

Após a inicialização dos containers, abra o navegador e acesse:

```
http://localhost:8080
```

---

#  Verificando os Containers

Para verificar se os containers estão funcionando corretamente, utilize:

```bash
docker compose ps
```

O projeto possui dois serviços principais:

* `app`
* `db`

Para visualizar os logs dos containers:

```bash
docker compose logs
```

Para visualizar somente os logs da aplicação:

```bash
docker compose logs app
```

Para visualizar somente os logs do banco:

```bash
docker compose logs db
```

---

#  Criação da Tabela

A tabela `produtos` é criada automaticamente pelo arquivo:


app/conexao.php
```

Quando a aplicação realiza a conexão com o banco de dados, o arquivo verifica se a tabela já existe.

Caso ela ainda não exista, a tabela é criada automaticamente.

A estrutura utilizada é:

```sql
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    data_cadastro DATETIME NOT NULL
);
```

Dessa forma, não é necessário criar manualmente a tabela para iniciar o projeto.

---

#  Docker Compose

O arquivo `docker-compose.yml` é responsável por configurar os containers utilizados pelo projeto.

A aplicação possui dois serviços principais:


app
db
```

---

##  Serviço `app`

O serviço `app` é responsável por executar a aplicação PHP.

Ele utiliza o `Dockerfile` para construir sua imagem.

A imagem utilizada como base é:


php:8.2-apache
```

O container possui PHP 8.2 e Apache.

Também são instaladas as extensões:


pdo
pdo_mysql
```

Essas extensões permitem que o PHP realize a comunicação com o banco de dados MySQL.

---

##  Serviço `db`

O serviço `db` é responsável pelo banco de dados.

Ele utiliza a imagem:


mysql:8.0
```

O banco utilizado pelo projeto possui o nome:


crud_produtos
```

A configuração do usuário root é definida no Docker Compose.

---

#  Porta da Aplicação

O Docker Compose utiliza o seguinte mapeamento:


8080:80
```

Isso significa que:

* A porta `8080` é utilizada no computador;
* A porta `80` é utilizada pelo Apache dentro do container.

Por isso, a aplicação pode ser acessada através de:

```
http://localhost:8080
```

---

#  Variáveis de Ambiente

O serviço `app` possui variáveis de ambiente configuradas no `docker-compose.yml`.

São elas:


DB_HOST=db
DB_USER=root
DB_PASSWORD=root
DB_NAME=crud_produtos
```

Essas variáveis representam:

| Variável      | Descrição                                       |
| ------------- | ----------------------------------------------- |
| `DB_HOST`     | Define o endereço/nome do serviço do banco      |
| `DB_USER`     | Define o usuário utilizado para acessar o MySQL |
| `DB_PASSWORD` | Define a senha do banco                         |
| `DB_NAME`     | Define o nome do banco de dados                 |

O valor `db` utilizado em `DB_HOST` corresponde ao nome do serviço MySQL definido no Docker Compose.

---

#  Volume do MySQL

O projeto utiliza um volume Docker chamado:


mysql-dados
```

Esse volume é responsável por armazenar os dados do banco de dados.

A utilização do volume permite manter os dados armazenados mesmo quando os containers são parados ou recriados.

O volume somente será removido caso seja excluído explicitamente.

---

#  Rede Docker

Os serviços `app` e `db` estão conectados através de uma rede personalizada chamada:

```
crud-rede
```

Essa rede utiliza o driver:

```text
bridge
```

A rede permite que os containers se comuniquem entre si.

A aplicação consegue acessar o banco de dados utilizando o nome do serviço:

```
db
```

A comunicação pode ser representada da seguinte forma:


┌─────────────────────────┐
│          APP            │
│                         │
│      PHP + Apache       │
│                         │
│      Porta 8080         │
└────────────┬────────────┘
             │
             │ crud-rede
             │
             ▼
┌─────────────────────────┐
│           DB            │
│                         │
│        MySQL 8.0        │
│                         │
│      crud_produtos      │
└─────────────────────────┘
```

---

#  Comunicação entre `app` e `db`

O container `app` não precisa acessar o banco através de `localhost`.

Dentro da rede Docker, o serviço do banco pode ser encontrado pelo nome:

```
db
```

Dessa forma, a comunicação acontece entre os containers através da rede `crud-rede`.

Isso permite que a aplicação PHP se comunique diretamente com o MySQL.

---

#  Como Utilizar o CRUD

Depois de executar o projeto e acessar:

```
http://localhost:8080
```

é possível realizar as operações do CRUD.

##  Cadastrar Produto

Através da opção de cadastro, é possível inserir um novo produto no sistema.

O produto possui informações como:

* Nome;
* Descrição;
* Data de cadastro.

Após o cadastro, os dados são armazenados no banco MySQL.

---

##  Listar Produtos

Na página principal, os produtos cadastrados são apresentados para consulta.

Essa operação corresponde ao **Read** do CRUD.

---

##  Editar Produto

A opção de edição permite alterar as informações de um produto que já foi cadastrado.

Essa operação corresponde ao **Update** do CRUD.

---

##  Excluir Produto

A opção de exclusão permite remover um produto cadastrado.

Essa operação corresponde ao **Delete** do CRUD.

---

#  Parando o Projeto

Para parar os containers:

```bash
docker compose down
```

Esse comando encerra e remove os containers utilizados pelo projeto.

O volume `mysql-dados` permanece armazenado.

Para iniciar novamente os containers:

```bash
docker compose up -d
```

---

#  Aprendizados e Decisões Técnicas

Durante o desenvolvimento do projeto, foram trabalhados diversos conceitos relacionados ao desenvolvimento web e DevOps.

### 1. Utilização do Docker Compose

Aprendemos a utilizar o Docker Compose para executar vários serviços de uma aplicação através de um único arquivo de configuração.

No projeto, ele é utilizado para executar a aplicação PHP e o banco de dados MySQL.

### 2. Comunicação entre Containers

Aprendemos como containers diferentes podem se comunicar através de uma rede Docker.

A aplicação utiliza o nome do serviço `db` para encontrar o banco de dados.

### 3. Persistência de Dados

Aprendemos a utilizar volumes Docker para manter os dados do MySQL separados do ciclo de vida dos containers.

Isso evita que os dados sejam perdidos simplesmente ao recriar um container.

### 4. Utilização do PDO

A aplicação utiliza PDO para estabelecer a conexão entre PHP e MySQL.

O PDO fornece uma forma estruturada de realizar operações no banco de dados.

### 5. Containerização da Aplicação

Aprendemos como utilizar um Dockerfile para criar um ambiente contendo PHP e Apache.

Dessa forma, a aplicação pode ser executada sem a necessidade de instalar esses componentes diretamente na máquina.

### 6. Separação de Responsabilidades

A aplicação web e o banco de dados são executados em containers separados.

Essa organização facilita a manutenção e deixa cada serviço responsável por uma função específica.

---

#  Resumo dos Comandos

### Clonar o projeto

```bash
git clone https://github.com/linkdonis/crud-produtos-docker.git
cd crud-produtos-docker
```

### Iniciar o projeto

```bash
docker compose up -d --build
```

### Verificar os containers

```bash
docker compose ps
```

### Visualizar logs

```bash
docker compose logs
```

### Parar os containers

```bash
docker compose down
```

### Acessar a aplicação

```
http://localhost:8080
```

---

#  Integrantes

* **Gabriel Kazuhissa Aizawa Lucio**
* **Eduardo Vieira**
* **Guilherme Eduardo Ritelli Dorta**

---

#  Considerações Finais

O projeto demonstra a criação de uma aplicação CRUD utilizando PHP e MySQL, executada através de containers Docker.

A utilização do Docker Compose possibilita configurar a aplicação e o banco de dados de maneira organizada e padronizada.

Além das operações de cadastro, consulta, edição e exclusão de produtos, o projeto permitiu colocar em prática conceitos importantes de DevOps, como **containerização, redes, volumes, comunicação entre serviços e configuração de ambientes**.
