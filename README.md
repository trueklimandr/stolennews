<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">"Stolennews.Новости" based on Yii 2 Advanced Project Template</h1>
    <br>
</p>
____________________________________________________________________________________________________


Информация для переноса проекта:

1. Загружаем архив проекта и распаковываем в папку, доступную из Web.<br>
Или делаем клон проекта через git.
2. Выполняем composer install.
3. В папках common/config, console/config, backend/config и frontend/config убираем знак "_" из начала имен файлов *-local.php.
Чтобы запустить проект, необходимо исправить только один файл конфигурации:
common/config/main-local.php (исправляем настройки подключения к БД).
4. Выполняем миграции: php yii migrate.
5. Для доступа к админской стороне необходимо настроить дополнительный виртуальный хост с путем к backend/web/index.php.
В моем случае для nginx в sites-available две конфигурации для хостов stolennews.local и admin.stolennews.local.
<br>
Конфигурация для клиентского хоста:


      server {
        charset utf-8;
        client_max_body_size 128M;
        
        listen 80 default_server; ## listen for ipv4
        #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

        server_name stolennews.local;
        root        /var/www/html/stolennews/frontend/web;
        index       index.php;

        access_log  /var/www/html/stolennews/log/frontend-access.log;
        error_log   /var/www/html/stolennews/log/frontend-error.log;

        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php$is_args$args;
        }

        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        # deny accessing php files for the /assets directory
        location ~ ^/assets/.*\.php$ {
            deny all;
        }

        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_pass 127.0.0.1:9000;
            #fastcgi_pass unix:/run/php/php7.0-fpm.sock;
            try_files $uri =404;
        }
    
        location ~* /\. {
            deny all;
        }
      }

<br>
Конфигурация для хоста администратора:


    server {
        charset utf-8;
        client_max_body_size 128M;
        
        listen 80; ## listen for ipv4
        #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

        server_name admin.stolennews.local;
        root        /var/www/html/stolennews/backend/web/;
        index       index.php;

        access_log  /var/www/html/stolennews/log/backend-access.log;
        error_log   /var/www/html/stolennews/log/backend-error.log;

        location / {
            # Redirect everything that isn't a real file to index.php
            try_files $uri $uri/ /index.php$is_args$args;
        }

        # uncomment to avoid processing of calls to non-existing static files by Yii
        #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        #    try_files $uri =404;
        #}
        #error_page 404 /404.html;

        # deny accessing php files for the /assets directory
        location ~ ^/assets/.*\.php$ {
            deny all;
        }

        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_pass 127.0.0.1:9000;
            #fastcgi_pass unix:/var/run/php5-fpm.sock;
            try_files $uri =404;
        }
    
        location ~* /\. {
            deny all;
        }
    }

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
