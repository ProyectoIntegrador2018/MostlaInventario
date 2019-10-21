# Deployment

Este documento describe como hacer el deploy a Heroku

## Requerimientos

Es necesario estas dependencias para correr correctamente el repositorio.

- PHP >= 7.1.^
- Composer (dependency installation)
- Git
- Heroku CLI

## Setup

### Agregar Procfile

$ echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
$ git add .
$ git commit -m “Heroku Procfile”

### Hacer login en la cuenta
heroku login: Enter credentials
heroku create //Adds git remote heroku origin
git push heroku master

### Agregar Postgres

heroku pg:credentials:url
heroku config:app DB_CONNECTION=pgsql

heroku cofing:app DB_CREDENTIALS //Copiar las credenciales generadas por heroku pg:credentials:url (KEY=VALUE)

### Agregar tablas a Pgsql
heroku run php artisan migrate
heroku run php artisan db:seed