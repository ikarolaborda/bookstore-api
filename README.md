# Book Store Management API (SAS Backend DEV Test)

[![Build Status](https://app.travis-ci.com/ikarolaborda/bookstore-api.svg?branch=master)](https://app.travis-ci.com/ikarolaborda/bookstore-api)

This is a simple API for managing a book store. For dev capabilities testing purposes for SAS company. It was developed using the following technologies:
* [PHP 8.2](https://php.com)
* [Laravel 10.9](https://laravel.com/)
* [MySQL 8.0](https://www.mysql.com/)
* [Docker](https://www.docker.com/)
* [Docker Compose](https://docs.docker.com/compose/)
* [Swagger](https://swagger.io/)

## Installation

Warning: To properly run the application, you must have installed [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/).

1 - In order to setup the project, clone this repository and run the commands below:

```bash
    make build
    make dci
    make jwt
```

This will create the necessary containers to run the app and create the `JWT Secret`.

2 - Next, run the command below to setup the database:

```bash
    make mig
```

### Test and Documentation
This project uses [Swagger](https://swagger.io/) for documentation. To access the documentation, just use the following link:
```bash
        http://localhost:8000/docs
```
To run the tests, use the command below:
```bash
    make test
```
