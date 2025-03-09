%systemDrive%\xampp\mysql\bin\mysql -uroot -e "CREATE DATABASE IF NOT EXISTS transport;"

if %errorlevel% neq 0 msg %username% "Nie udalo sie utworzyc bazy danych." && exit /b %errorlevel%

call composer install

call php artisan migrate:fresh --seed

call php artisan key:generate

rem call php artisan storage:link

code .
