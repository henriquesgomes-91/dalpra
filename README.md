INSTALAÇÃO DO PROJETO:
composer create-project laravel/laravel dalpra

ENTRAR NA PASTA DO PROJETO:
cd dalpra

ALTERAR AS CONFIGURAÇÕES DE BANCO DE DADOS NO .env

RODAR O COMANDO:
php artisan migrate

INSTALAR O BOOTSTRAP:
npm install bootstrap

ACRESCENTAR NO ARQUIVO resoures/css/app.css A LINHA:
@import 'bootstrap/dist/css/bootstrap.min.css';

RODAR EM SEGUIDA?
npm install
npm run dev

INSTALAR O AdminLTE:
composer require jeroennoten/laravel-adminlte
php artisan adminlte:install
php artisan adminlte:install --only=assets

AUTENTICAÇAÕ NATIVA DO ADMINLTE:
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
