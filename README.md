# Reflow Soldering Monitor
## Prerequisiti
- [PHP 7.x](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [Symfony](https://symfony.com/download)
- [MySQL](https://dev.mysql.com/downloads/)

## Installazione
Istruzioni per l'installazione del progetto: 
* Installare le dipendenze necessarie

  ```sh
  composer install
  ```
* Impostare la variabile `DATABASE_URL` all'interno del file `.env.local` per la generazione del database:

  ```sh
  touch .env.local
  echo "DATABASE_URL=mysql://user:password@host:port/reflow-soldering-monitor" > .env.local
  ```
  Sostituire `user`, `password`, `host` e `port` con le credenziali di MySQL.
* Generare il database e lo schema utilizzando [Doctrine](https://www.doctrine-project.org/):

  ```sh
  php bin/console doctrine:database:create
  php bin/console doctrine:schema:create
  ```
  oppure
  ```sh
  symfony console doctrine:database:create
  symfony console doctrine:schema:create
  ```
* Generare le chiavi SSL per l'autenticazione degli utenti:
  ```
  php bin/console lexik:jwt:generate-keypair
  ```
* Generare dei dati di esempio utilizzando le Fixtures:
  
  ```sh
  php bin/console doctrine:fixtures:load
  ```
  
  oppure
  ```sh
  symfony console doctrine:fixtures:load
  ```
* E' possibile generare in tempo reale dei dati per il testing dell'applicazione, attraverso i seguenti comandi:
  
  ```sh
  php bin/console app:upload-temps
  php bin/console app:upload-pcbs
  ```
  
  oppure
  ```sh
  symfony console app:upload-temps
  symfony console app:upload-pcbs
  ```
