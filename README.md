I am using the code available [here](https://github.com/CodelyTV/cqrs-ddd-php-example) for studding purposes. 

Implementation example of a PHP application following Domain-Driven Design (DDD) and Command Query Responsibility Segregation (CQRS) principles, keeping the code as simple as possible.

Take a look, play and have fun with this!

## 🚀 Environment setup

### Install the needed tools
* Clone this repository: `git clone https://github.com/CodelyTV/cqrs-ddd-php-example cqrs-ddd-php-example`
* Move to your project folder: `cd cqrs-ddd-php-example`
* Start the services: `docker-compose compose up -d` (this make a composer install)
* Add `api.codelytv.dev` domain to your local hosts: `echo "127.0.0.1 api.codelytv.dev"| sudo tee -a /etc/hosts > /dev/null`
* Go to [the API healthcheck page](http://api.codelytv.dev:8030/status)

### Run the tests!
Once you have all the dependencies, in order to execute the tests, run this command:
* `vendor/bin/behat -p api` <sub>This will also create all needed databases.</sub>
* `vendor/bin/behat -p applications`
* `vendor/bin/phpunit`

### Run the environment
> If you don't want to use the docker integration, you can do the following
* A [MySQL](https://www.mysql.com/) database
  - Execute all `.sql` from `/databases` dir
* [Apache](https://httpd.apache.org/)/[Nginx](https://nginx.org/en/)
* [Supervisord](http://supervisord.org/)
  - Execute the `applications/api/bin/console codelytv:domain-events:generate-supervisor-files` command
  - Link the `applications/api/app/config/supervisor` folder to the supervisor config one
  - Start supervisord

## 🧐 Contributing
There are some things missing (add swagger, improve documentation...), feel free to add this if you want! If you want 
some guidelines feel free to contact us :)

## 🤩 Extra
This code was show in the [From framework coupled code to #microservices through #DDD](http://codely.tv/screencasts/codigo-acoplado-framework-microservicios-ddd) talk and doubts where answered in [DDD y CQRS: Preguntas Frecuentes](http://codely.tv/screencasts/ddd-cqrs-preguntas-frecuentes/) video.

🎥 Used in the CodelyTV Pro courses:
* [🇪🇸 Arquitectura Hexagonal](https://pro.codely.tv/library/arquitectura-hexagonal/66748/about/)
* [🇪🇸 CQRS: Command Query Responsibility Segregation](https://pro.codely.tv/library/cqrs-command-query-responsibility-segregation-3719e4aa/62554/about/)
