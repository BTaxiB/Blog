mysql < instantiate.sql
touch .enve
printf "\nDB_NAME = creative" >> .enve
printf "\nDB_USER = root" >> .enve
printf "\nDB_PASS = " >> .enve
composer install
composer dump-autoload -o
echo "Launching Application test..."
sleep 5
php test.php
