# ISLP Canadian National Statistics Poster Competition

## Deployment

### System Requirements
* PHP >= 7.0.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* MySQL Database
* Apache 2 or Nginx
* Composer

### Step-by-Step Guide

**This guide assumes UNIX like environment such as Linux and macOS.**

First make sure your system met all requirements.

If you are using Apache 2, make sure you have either `.htaccess` or server configured properly to support pretty URLs.

```
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

If you are using Nginx

```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

Then, clone the repository.

```
git clone https://github.com/junthehacker/islp-canada.git
```

Make sure your web server have proper access to the directory, also run the following command

```
$ cd islp-canada
$ chmod -R 777 storage
```

*Make sure you **only** set 777 for storage folder.*

Now create a new database for the app.

```
$ mysql -u USERNAME -p
$ create database DATABASE_NAME;
```

Copy `.env.example` to `.env`.

```
$ cp .env.example .env
```

Modify following configurations in `.env` to match your server

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Save the file and exit, now we install dependencies using composer

```
$ composer install
```

After installing all dependencies, run following commands to generate an encryption key and migrate the database.

```
$ php artisan key:generate
$ php artisan migrate
```

The website is now live. However, we don't have an administrator user yet. Run the following command to create an admin user.

```
$ php artisan admin:create {email} {password}
```