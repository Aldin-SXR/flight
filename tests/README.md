## Flight Tests

This directory contains unit tests for Flight. The tests were initially written for PHPUnit 3.7.10, but they have been rewritten for compatibility with PHPUnit 8.

To run the tests, do:

```bash
composer install
vendor/bin/phpunit
```

Optionally, add the flag `--testdox` to the command to generate additional documentation.

```bash
vendor/bin/phpunit --testdox
```

Learn more about PHPUnit at [http://www.phpunit.de](http://www.phpunit.de/manual/current/en/index.html)
