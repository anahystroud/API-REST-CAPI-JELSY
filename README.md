# API-REST-CAPI-JELSY
API-REST que funciona para alimentar la aplicación *PruebaCapiJelsy*, genera la base de datos y cuenta con un seeder para poblar la base de datos con información ficticia.

Tecnologías utilizadas (Laravel, PHP, MySQL):
<a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://laravel.com/img/logomark.min.svg" alt="laravel" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/>

## Versiones
[PHP](https://docs.npmjs.com/cli/v10/commands/npm) version 8.2.20
[Laravel ](https://docs.npmjs.com/cli/v10/commands/npm) version 11.1.1

## Instalar la aplicación
Correr el comando
`composer install` para instalar la aplicación.

Correr el comando 
`cp .env.example .env` para generar el archivo .env

Correr el comando 
`php artisan key:generate` para generar la llave necesaria en la aplicación.

Correr el comando
`php artisan migrate` para generar la base de datos.

Correr el comando
`php artisan db:seed` para poblar la base de datos con 5000 registros de información ficticia.

## Autor
### Jelsy Anahi Uribe Rivero
![Autora: Jelsy Anahi Uribe Rivero](https://avatars.githubusercontent.com/u/95645851?v=4)