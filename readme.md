# Distantis Code Challenge

> Challenge sencillo para la prueba tecnica

## Configuración

Requisitos previos
- php 7.3
- Laravel 5.8
- Servidor web puede ser nginx o apache

``` bash
# Descargar la aplicación web a la pc
git clone https://github.com/Daniel1024/challenge.git

# Ingresar a la carpeta creada, en este caso challenge
cd challenge/

# Instalar dependencias de php con composer
composer install

# Copiar el .env.example a .env para la configuración de laravel
cp .env.example .env

# Establecer la clave de aplicación
php artisan key:generate
 
# Levantar el servidor con ayuda de artisan => http://localhost:8000/
php artisan serve
```
- Abrir en cualquier navegador esta url http://localhost:8000/, esto depende del puerto habilitado por artisan al momento de levantar el servidor.
- Para la parte del frontend no hace falta hacer nada mas, ya el css y el js esta ya compilado, para la revision de este
codigo se encuentra en la carpeta resources/js/components/
