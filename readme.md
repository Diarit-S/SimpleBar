**First install dependencies  :**

`composer i`
`npm i`

**Setup your config:** 

Setup `.env` file : 

`DATABASE_URL="mysql://USER:PASSWORD@127.0.0.1:PORT/db_bar?serverVersion=5.7"`

Basically **USER** = 'root', **PASSWORD** = empty or 'root', **PORT**: '3306' or '8889' 
OR, you have your own credentials

**After that, create your database, migrate entities and load fixtures**

`php bin/console doctrine:database:create`
`php bin/console doctrine:migrations:migrate`
`php bin/console doctrine:fixtures:load`
