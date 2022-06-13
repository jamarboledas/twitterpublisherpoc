# TWITTERBOT

## Build with docker

### Build
In order to build the project just execute the following command.
`docker-compose up --build -d`

### Environment variables

#### Symfony framework
APP_ENV=dev
APP_SECRET=app_secret_hash

#### Database set up.
MYSQL_ROOT_PASSWORD: Root password.\
MYSQL_DATABASE: Mysql database name.\
MYSQL_USER: Mysql database user.\
MYSQL_PASSWORD: Mysql database password.\
DATABASE_URL: Mysql connection url.