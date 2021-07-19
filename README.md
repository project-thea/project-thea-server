# Project THEA Server

A tracking haulage application in East Africa to control COVID-19.

REQUIREMENTS
------------

The minimum requirement for this project is your Web server supports PHP 7.3.0 and you have 
Node.js a javascript runtime environment installed locally on your computer. 

INSTALLATION
------------

### Install via Git 

Clone the repo locally:

```sh
git clone https://github.com/project-thea/project-thea-server.git

cd project-thea-api

```

### Install PHP dependencies:

```sh
composer install
```

### Install NPM dependencies:

```sh
npm install
```

### Build assets: 

```sh
npm run dev
```

CONFIGURATION
------------

### Setup configuration:

```sh
cp .env.example .env
```

### Generate application key:

```sh
php artisan key:generate
```

### Create a database:

```sql
CREATE DATABASE DB_DATABASE;
```

### Update .env with database details:

```sh
DB_CONNECTION=<DB_CONNECTION>
DB_HOST=<DB_HOST>
DB_PORT=<DB_PORT>
DB_DATABASE=<DB_DATABASE>
DB_USERNAME=<DB_USERNAME>
DB_PASSWORD=<DB_PASSWORD>
```

### Run database migrations:

```sh
php artisan migrate
```

### Run database seeders:

```sh
php artisan db:seed
```

### Run development server:

```sh
php artisan serve
```
