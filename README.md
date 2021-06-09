# Reflow Soldering Monitor
## Prerequisiti
- [PHP 7.x](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Symfony](https://symfony.com/download)
- [MySQL](https://dev.mysql.com/downloads/)

## Installazione
Seguono le istruzione per installare il progetto.
* Impostare la variabile `DATABASE_URL` all'interno del file `.env.local` per la generazione del database:

  ```sh
  touch .env.local
  echo "DATABASE_URL=mysql://user:password@host:port/reflow-soldering-monitor" > .env.local
  ```
  Sostituire `user`, `password`, `host` e `port` con le credenziali di MySQL.
* Installare le dipendenze necessarie:

  ```sh
  composer install
  ```
* Generare il database utilizzando [Doctrine](https://www.doctrine-project.org/):

  ```sh
  php bin/console doctrine:database:create
  php bin/console doctrine:schema:create
  ```
* Generare le chiavi SSL per l'autenticazione degli utenti:

  ```
  php bin/console lexik:jwt:generate-keypair
  ```
* Generare dei dati di esempio utilizzando il [DoctrineFixturesBundle](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html):

  ```sh
  php bin/console doctrine:fixtures:load
  ```
## Utilizzo
Sulla rotta `/` è disponibile la pagina principale del progetto. Le credenziali predefinite sono visibili nel file del DoctrineFixturesBundle, che si trova al percorso `/src/DataFixtures/AppFixtures.php`. Per simulare il funzionamento dell'applicazione è possibile utilizzare i seguenti comandi, che genereranno dati casuali in tempo reale:
```sh
php bin/console app:upload-temps <millisecond_interval> <max_temperature> <min_temperature> 
php bin/console app:upload-pcbs <interval>
```
