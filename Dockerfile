# Utiliza a imagem oficial do PHP 8.2 com Apache
FROM php:8.2-apache

# Instala a extensão PDO para conexão com bancos de dados
RUN docker-php-ext-install pdo pdo_mysql

# Define a pasta pública padrão do Apache
WORKDIR /var/www/html