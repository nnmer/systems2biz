# Installation

Requirements: php >= 7.1

1. prepare MySql db username, dbname, password
2. setup your nginx vhost
3. clone the project
4. run ```sh deploy.sh```
5. (optional) add fixtures ```bin/console doctrine:fixtures:load```

# PSR-2 compliance
Be aware!, after the composer install execution the local git pre-commit hook will be install to check psr-2 style for future commits

# Tests

## Behat

Your vhost domain name should be http://sys2.lo
or update behat.yml ```base_url: http://sys2.lo``` to your's domain name
 
To run tests execute next:
```bash
bin/console doctrine:schema:create --env=behat 
bin/console doctrine:fixtures:load --env=behat
find tests/ -name "*.feature" | ./bin/fastest -p 4 -o "./bin/behat -vvv {} -f pretty" -v
```