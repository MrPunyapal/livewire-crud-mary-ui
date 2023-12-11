# Crud Example of livewire best practices (TALL Stack)

## Installation

- Clone the repo

```bash
git clone https://github.com/mr-punyapal/livewire-crud.git

&&

cd livewire-crud
```

- Install composer dependencies

```bash
composer install
```

- Install npm dependencies

```bash

npm install

```

- Create a copy of your .env file

```bash

cp .env.example .env

```

- Generate an app encryption key

```bash

php artisan key:generate

```

- Create an empty database for our application

- In the .env file, add database information to allow Laravel to connect to the database

- Migrate the database

```bash

php artisan migrate

```

- Seed the database

```bash

php artisan db:seed

```

- Run the development server (Ctrl+C to close)

```bash

php artisan serve

```

- Visit [http://localhost:8000](http://localhost:8000) in your browser


### Installation with Docker (Bônus)

Duplicate the `.env.example` file and rename it to `.env`.

```bash
cp .env.example .env
```

Change the DB host on `.env` file.
```bash
DB_HOST=livewire-crud-mysql
```

Enter into `.docker/` and start containers.

```bash
# Wait until you see PHP-FPM / MySQL success messages.
docker compose up 
```
In another terminal, also in `.docker/` folder, enter into docker container.

```bash
docker compose exec livewire-crud-app zsh
```

Now, inside that container terminal migrate, seed, install dependencies and start server.

```bash
# See `composer.json` to learn about it.

composer start
```
**Done!** See http://localhost:8282

## Test

- Run the test

```bash

php artisan test

```

## give feedback on [@MrPunyapal](https://x.com/MrPunyapal)
