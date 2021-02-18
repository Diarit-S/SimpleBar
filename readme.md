 **Group 1 members**
 
 - Maksym Yankivskyy 
 - Hugues Romain 
 - Amandine Donat-Filliod 
 - Nastasia Dotlic 
 - Gregorio Battaro  
 - Louis Zawadka 
 - Diarit Salihaj


**First install dependencies  :**

`composer i`
`npm i`

**Setup your config:** 

Setup `.env` file : 

`DATABASE_URL="mysql://USER:PASSWORD@127.0.0.1:PORT/db_bar?serverVersion=5.7"`

Commonly **USER** = 'root', **PASSWORD** = empty or 'root', **PORT**: '3306' or '8889' 
OR, you have your own credentials

**After that, create your database, migrate entities and load fixtures**

`php bin/console doctrine:database:create`

`php bin/console doctrine:migrations:migrate`

`php bin/console doctrine:fixtures:load`

**Then, run symfony server and watch changes on developmenent**


`symfony server:start`

`npm run watch`



**Shema UML**

![](https://cdn.discordapp.com/attachments/719464593650483200/811523874700525598/Schema_BDD2x_2.png)

###### **Répoonse à la partie 4**

La fonction `findCatSpecial` permet, à partir de l'ID d'une `beer` de rechercher sur la table `Category` le ou les champs auquel est lié la `beer` en question, en filtrant pour avoir uniquement les categories dont le `term` est `special`
