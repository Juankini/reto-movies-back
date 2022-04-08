# movies-back

## Recommended IDE Setup

[VSCode](https://code.visualstudio.com/)

## Pre Setup

Tener creada la base de datos sin tablas, se puede llamar como se desee
Para este caso se le llamó "movies"

## Project Setup

```sh
composer install
php artisan migrate
npm install



```
### Database

En el archivo .env cambiar los valores de conexion por los que se tengan configurados

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movies
DB_USERNAME=root
DB_PASSWORD=root

### Compile and Hot-Reload for Development

```sh
php artisan serve
```

