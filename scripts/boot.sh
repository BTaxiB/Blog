mysql < instantiate.sql
touch .env
printf "DB_NAME = testviews \nDB_USER = root \nDB_PASS = \nRECORDS_PER_PAGE=15" > .env
echo "--- VERDANA: Installing composer dependencies ---"
composer install
sleep 1
echo "--- VERDANA: Autoloader check ---"
composer dump-autoload -o
echo "--- VERDANA: Application test ---"
sleep 1
echo "--- VERDANA: Application test results ---"
php test.php
echo "--- VERDANA: Application unit test ---"
./vendor/bin/phpunit --testdox tests
