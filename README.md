Steps To Deploy This Project on Your System.

1.) Copy The Link From githup Repository.
2.) Run Command => git clone https://github.com/purecodes-admin/distributors-diary.git
3.) Run Command => composer install
4.) copy your .env.example to .env  you can not do it manually you have to do it in your terminal.
5.) Run Command => i-e copy .env.example .env
6.) Run Command => php artisan key:generate   This Command will generate the application key.
7.) create a database in phpmyadmin add that database name and username and password if have 
    in your .env file.
8.) Run Command => php artisan migrate
9.) Run Command => php artisan serve
10.) Run Command => php artisan admin  (This Command is use to add Admin)
11.) Run Command => php artisan tags  (This Command is use to add tags)