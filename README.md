# WordPress Docker Setup with PHP 8.0.30

This is a Docker setup for WordPress using PHP 8.0.30, MySQL 5.7, and Nginx.

## Requirements

- Docker
- Docker Compose

## Setup Instructions

1. Clone this repository
2. Run the following command to start the containers:

```bash
docker-compose up -d
```

3. Access WordPress at http://localhost

## Configuration

- WordPress data is stored in a Docker volume
- Database data is stored in a Docker volume
- Custom PHP configuration can be modified in `config/php.conf.ini`
- Nginx configuration can be modified in `config/nginx.conf`

## Stopping the Containers

To stop the containers, run:

```bash
docker-compose down
```

To stop the containers and remove volumes (this will delete all data), run:

```bash
docker-compose down -v
```

## Credentials

- WordPress Database:
  - Username: wordpress
  - Password: wordpress
  - Database: wordpress
  - Host: db

These credentials are stored in the `docker-compose.yml` file and can be changed as needed.