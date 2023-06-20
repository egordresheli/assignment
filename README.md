## Justdocker is a docker build for all our services.
## It contains all the containers you need to work on your project.
## This build works through the make utility.

## Repository
[justdocker](https://bitbucket.org/justcarpetsict/justdocker/src/master/)

## Make
To use aliases like `make up` you need to install make by the following command
`brew install make`

## Services
* [justcms](http://justcms)
* [justengine](http://justengine)
* [justshop](http://justshop)
* [justservice](http://justservice)
* [justproduce](http://justproduce)
* [justvehicle](http://justvehicle)
* 
## Containers
* Nginx
* PHP 7.2-fpm-alpine
* Node 14-alpine
* Mysql 5.7
* Redis 6.2-alpine

## Project container management
* Launching project containers: `make up`
* Stopping the project containers: `make stop`
* Restarting project containers: `make restart`
* Connecting to the PHP-FPM 7.2 container: `make connect-php`
* Install all composer packages in all projects: `make apps-composer-install`
* Get dumps from acceptance and import to your local database: `make restore-dumps` (Only for `pim`, `webshop`, `vehicle`)
* Get dashboard dump from acceptance and import to your local database: `make restore-dashboard-dump` (Take a lot of time because dump have ±8 GB)
* Install all npm packages: `make frontend-npm-install`
* Run justshop with `npm run watch`: `make frontend-watch-justshop` (This command is automatically started when you run `make init` or `make up` or `make init`)

## First run:

#### 1. Unix:
Enter service names in `/etc/hosts` of the host machine:
```
127.0.0.1 localhost justcms justengine justshop justproduce justservice justvehicle
```

### 2. Initialising projects
```
justdocker$ make init
```

Add to .env values to variables (`ACCEPTANCE_DB_HOST`, `ACCEPTANCE_DB_PORT`, `ACCEPTANCE_DB_USERNAME`, `ACCEPTANCE_DB_PASSWORD`)

```
justdocker$ make init
```

#### This command separate for next steps:
* Stopping all containers and remove orphans
* Pull images for containers
* Build and start containers
* Pull justcms, justengine, justproduce, jsutservice, justshop and move them to `apps/`
* Install composer packages for all services
* Run `php artisan key:generate` for all services
* Install npm packages for justshop service
* Run npm watch in container for justshop
* Get fresh dumps from acceptance and import to local database (Only `pim`, `vehicle`, `webshop` databases. For dashboard database need to run `make restore-dashboard-dump`)

##### Checking for processes raised as a result: `docker-compose ps`.
##### The expected outcome is that every service is able to `up`

### 3. Raise the environment

Set the required environment parameters in the `.env' files of all projects.
Example:
```
DB_CONNECTION=mysql
DB_HOST=0.0.0.0
DB_PORT=3306
DB_DATABASE=webshop
DB_USERNAME=justcarpets_dev
DB_PASSWORD=justcarpets_dev
```

## Additional information
1) The make utility requires a file, Makefile, which defines set of tasks to be executed.
2) All script files are located in `scripts/` folder. Example how to run them: `./scripts/clone_projects.sh` or add this command with alias to Makefile
3) Values for variables (`ACCEPTANCE_DB_HOST`, `ACCEPTANCE_DB_PORT`, `ACCEPTANCE_DB_USERNAME`, `ACCEPTANCE_DB_PASSWORD`) in .env you can find [here](https://justcarpetsict.atlassian.net/wiki/spaces/JCI/pages/589829/Engine+acceptance)
4) Dumps that was downloaded from acceptance are located in `wentrypoin/dumps/` folder and if you need to import them again just run `make import-dumps`
