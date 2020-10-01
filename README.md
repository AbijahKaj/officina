# Officina
Hackathon project - Office rental service

### Check it working here: [Our Amazon AWS Deployment][deployment]

As a result of COVID-19, many companies have been forced to function with employees working remotely and to adopt technologies that enable collaboration from a distance.

Companies have invested a lot in remote work tools already, and they have seen positive results, and most of the cases productivity has accelerated!

Post COVID-19, many companies have already announced that they won't be returning to the old way of working every day from the office anymore.

Working remotely more often not only will help reduce traffic jams and save time on commuting but also can save the employers a lot of money on the office and real estate costs.

According to research, an employer can save $11,000 a year for every employee who works remotely half the time!

Officina is a platform for employers to put their office for renting or people who are looking for an office to rent. 

## How does it work?
Browse our catalog of nearby available offices and pick the one you want or rent your office.
#### Enhanced search
Use our search tool to find any office by location or price range, you can also use the map to locate offices near you, there's also a list of nearby availlable offices, so just click on one and the map shows you where it's located.
#### Third-party login
Don't have an account on our service? Don't worry, we support login through third-party services such as Facebook, Google and Auth0.
#### Quick booking process
Our booking process is straight forward and fully functional
#### Post an office for renting
It's very easy to post an office, just locate it on the map and add a description and rent price, et voilà, your office is now open for renting.
 
  
## Technology stack
- PHP 7.4
- Symfony
- MySQL
- Bootstrap 4
- Docker

## Installation
Clone and install dependencies
```
git clone https://github.com/AbijahKaj/officina.git
cd symfony
composer install
```

Using [Symfony CLI][sf_server]:

(For Windows : Kindly append php before the bin)

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
[deployment]: http://ec2-52-15-214-16.us-east-2.compute.amazonaws.com
