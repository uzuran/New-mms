# Docker
    Install docker on your local machine.

# Build docker container, Make require.
    Check Makefile! --> run this command -> make build

# Run  all this commands inside docker container!!!
    
    # Create base symfony skeleton.
        composer create-project symfony/skeleton .
    
    #twig template.
        composer require twig
    
    # Doctrine.
        composer require symfony/orm-pack
        composer require doctrine/doctrine-bundle
        composer require doctrine/annotations
        composer require symfony/maker-bundle --dev

    # Dummy Data with Fixtures.
        composer require --dev doctrine/doctrine-fixtures-bundle
    
        # Fill database dummy data.
            php bin/console doctrine:fixtures:load
 

# Add api to project.
    composer require api

[http://localhost:8080/api](http://localhost:8080/api)


# Migrations
    php bin/console make:migration

# Migrate 
    php bin/console doctrine:migrations:migrate

# Adminer for manage database
u[http://localhost:8080/adminer.php](http://localhost:8080/adminer.php)

![db-login](image.png)

Server: db

Username: symfony

Password: symfony

Database: symfony