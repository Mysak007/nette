Installation
------------
1. run "docker compose up"
2. exec php container "docker exec -it nette-project-php-1 /bin/sh
3. composer install
4. insert sql - "sql_insert.sql"
5. run "php cron/GetExchangeRatesCommand.php" inside php container
5. run localhost

