# Documentos DTI
Sistema para llevar el registro de documentos emitidos por la Dirección de Tecnologías de la Información.

## Requisitos del servidor (Windows - GNU/Linux)
* PHP> = 7.3
- Extensión PHP BCMath
- Extensión PHP Ctype
- Extensión PHP Fileinfo
- Extensión PHP JSON
- Extensión PHP Mbstring
- Extensión PHP OpenSSL
- Extensión PHP PDO
- Extensión PHP Tokenizer
- Extensión PHP XML
- Extensión PHP ldap

* Servidor HTTP Apache2, Nginx o Microsoft IIS
* Servidor de base de datos MySQL, Microsoft SQL Server o PostgreSQL

Documentación adicional: https://laravel.com/docs/8.x/deployment

## Instalación
```bash
# clonación por medio de ssh
git clone git@github.com:mineco-dev/documentos-dti.git
# or  clonacióń por medio de http
git clone https://github.com/mineco-dev/documentos-dti.git

cd documentos-dti

cp .env.example .env

composer install

php artisan key:generate

# crear base de datos
# configurar parámetros de conexión a la base de datos en el archivo .env

php artisan migrate --seed

php artisan passport:install

php artisan storage:link

```

## Frontend: resorces/js
```bash
npm install

# development
npm run watch

# production
npm run prod
```

## Despliegue en servidor producción
> **Nota**: Los siguientes comandos, solo deben de ejecutarse en el servidor de producción.

```bash
# Optimización del cargador automático
composer install --optimize-autoloader --no-dev

# Optimización de la carga de configuración
php artisan config:cache

# Optimización de la carga de configuración
php artisan route:cache

# Optimización de la carga de vistas
php artisan view:cache
```
En caso de actualizaciones o cambios en el archivo `.env` se debeje ejecutar el comando `php artisan optimize`

También se debe cambiar los valores de dos variables de entorno para el entorno de producción
Fichero `.env`
```bash
...
APP_ENV=production
...
APP_DEBUG=false
```