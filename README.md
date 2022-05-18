This readme was written by Mliki Redouane.

# Spryker-test

> Replace this title and the following description with your project name and description.

An api built with Symfony 5.4 (LTS).

## Setup

### Prerequisites

#### Linux

Install the latest version of [Docker](https://docs.docker.com/install/) and 
[Docker Compose](https://docs.docker.com/compose/install/).

#### Linux

Consider using a Linux-like terminal to run the [Makefile](Makefile) commands.

If not possible, you may also directly run the commands specified in the [Makefile](Makefile). 
For instance, instead of running `make up`, run `docker-compose up -d`.

### Hosts

Update your `hosts` file with the following entries:

```
127.0.0.1   traefik.spryker-test.localhost
127.0.0.1   api.spryker-test.localhost
127.0.0.1   phpmyadmin.spryker-test.localhost
```

> Update the domain with the one used in your project.

On Linux and macOS, run `sudo nano /etc/hosts` to edit it.

### First start

Copy the file [.env.dist](.env.dist) to a file named `.env`. For instance:

```
cp .env.dist .env
```

> Edit the [.env.dist](.env.dist) by updating the default values of `DOMAIN`, `MYSQL_DATABASE` and `APP_SECRET`
> environment variables.

---

Please run:

```
docker-compose up api
```

📣&nbsp;&nbsp;This command start the `api` service. While booting, these services install PHP dependencies.
first time.

Once the services have installed the dependencies, you may stop them with:

```
CTRL+C
docker-compose down
```

Next, make sure there is no application running on port 80.

Good? You may now start all the Docker containers with the following commands:

```
make up
```

It may take some time as each container will also set up itself, such as installing dependencies, 
or running migrations to set up the database structure.

**📣&nbsp;&nbsp;In some cases, the `api` service will try to run the migrations before the `mysql` service is ready. 
If so, restart the `api` service with `docker-compose up -d api`.**

The containers will be ready faster next time you run this command as the first run is doing most of the setup.

Once everything is ready, the following endpoints should be available:

* http://traefik.spryker-test.localhost (Reverse proxy, the entry point of all the HTTP requests)
* http://api.spryker-test.localhost (API)
* http://phpmyadmin.spryker-test.localhost (phpMyAdmin, a web interface for your MySQL database)

> Update the domain with the one used in your project.

You may now enter the `api` service and load the development data:

```
make api
php bin/console tdbm:generate
exit
```

### Functional and Unit tests.
```
 make api
 composer pest
```
----------
also you may use command 'make test-api' to check code analys ,code styles and tests.

To fix code style (csfix) you can put command 'composer csfix' on api container.
### Configuring Git

Git should ignore globally some folders like those generated by your IDE and Vagrant.

If not already done, you should tell Git where to find your global `.gitignore` file.

For instance, on Linux/macOS/Windows git bash:

```
git config --global core.excludesfile '~/.gitignore'
```

Windows cmd:

```
git config --global core.excludesfile "%USERPROFILE%\.gitignore"
```

Windows PowerShell:

```
git config --global core.excludesfile "$Env:USERPROFILE\.gitignore"
```

Then create the global `.gitignore` file according to the location specified previously.

You may now edit it, according to your environment, with:

```
# IDE
.idea
.vscode
# MacOS
.DS_Store
# Vagrant
.vagrant
```
### How to stop the stack?

As simple as the `make up` command, run `make down` to stop the entire Docker Compose stack.

### How to view the logs of the Docker containers?

All aggregated logs:

```
docker-compose logs -f
```

Logs of one service:

```
docker-compose logs -f SERVICE_NAME
```

For instance, if you want the logs of the `api` service:

```
docker-compose logs -f api
```
