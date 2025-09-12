pint:
    ./vendor/bin/pint
pest-all-tests:
    ./vendor/bin/pest --parallel
phpstan:
    ./vendor/bin/phpstan analyse --memory-limit=2G
