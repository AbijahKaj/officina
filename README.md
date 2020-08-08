# Officina
Hackathon project - Office rental service

As a result of COVID-19, many companies have been forced to function with working remotely employees and to adopt technologies that enable collaboration from a distance.

Companies have invested a lot in remote work tools already, and they have seen positive results, and most of the cases productivity has accelerated!

Post COVID-19, many companies have already announced that they won't be returning to the old way of working every day from the office anymore.

Working remotely more often not only will help reduce traffic jams and save time on commuting, but also can save the employers a lot of money on the office and real estate costs.

According to a research, an employer can save $11,000 a year for every employee who works remotely half the time!

Officina is a platform for employers to put their office for renting or people who are looking for an office to rent. 

## How does it work?
Browse our catalog of nearby available offices and pick the one you want or rent your office.
 
  
## Technology stack
- PHP 7.4
- Symfony
- MySQL
- Bootstrap 4
- Docker

## Installation
```
git clone https://github.com/AbijahKaj/officina.git
cd symfony
composer install
```

Using [Symfony CLI][sf_server]:

```bash
bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:update --force
symfony server:start
symfony open:local
``` 

Or using Docker:

run docker and connect to container:
```
docker-compose up -d
docker-compose exec php sh
bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:update --force
```

Navigate to [localhost:8001](http://localhost/) in your browser

[sf_server]: https://symfony.com/doc/current/setup/symfony_server.html
