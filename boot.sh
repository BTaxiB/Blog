mysql < instantiate.sql
touch .env
printf "\nDB_NAME = creative \nDB_USER = root \nDB_PASS = " > .env
echo "--- Installing composer dependencies ---"
composer install
sleep 1
echo "--- Autoloader check ---"
composer dump-autoload -o
echo "Launching Application test..."
sleep 2
php test.php
