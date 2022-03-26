mysql < instantiate.sql
touch .env
printf "\nDB_NAME = creatives \nDB_USER = root \nDB_PASS = " > .env
echo "--- VERDANA: Installing composer dependencies ---"
composer install
sleep 1
echo "--- VERDANA: Autoloader check ---"
composer dump-autoload -o
echo "--- VERDANA: Application test ---"
sleep 2
echo "--- VERDANA: Application test results ---"
php test.php
echo "--- VERDANA: Application unit test ---"
sleep 2
./vendor/bin/phpunit --testdox tests
