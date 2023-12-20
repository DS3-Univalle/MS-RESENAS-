# Usa una imagen base de PHP con Apache
FROM php:7.4-apache

# Instala la extensión MySQLi
RUN docker-php-ext-install mysqli

# Copia los archivos de tu aplicación al contenedor
COPY . /var/www/html

# Expon el puerto 80 (puerto predeterminado de Apache)
EXPOSE 80

# Inicia Apache al ejecutar el contenedor
CMD ["apache2-foreground"]
