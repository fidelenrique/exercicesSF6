# LTS de Symfony 6.3.8
PHP version 8.2.12

Le fichier .env à la racine du projet doit se connecter à votre base de données. Par example comme ci-dessous :

-
  DATABASE_NAME=exercicesSF6
  DATABASE_USER=root
  DATABASE_PASS=root
  SERVER_VERSION=10.10.2-MariaDB&charset=utf8mb4
  DATABASE_PORT=3306
  ENV=local

```
DATABASE_URL="mysql://root:root@172.16.238.13:3306/exercicesSF6?serverVersion=10.10.2-MariaDB&charset=utf8mb4"
```
Les commandes nécessaires pour la migration et mise à jour de la base de données :
```
php bin/console make:migration
```
```
symfony console doctrine:migrations:migrate
```

La commande pour lance la commande d'inportation de la liste CSV
```
php bin/console debug:router station_list
php bin/console app:upload-station 
```

Pour consulter les stations de gare RATP :

http://exercicesSF6.localhost/station

Autres commandes :

Netoyer le cache :
```
php bin/console c:c
```
URL phpmyadmin :

http://127.0.0.1:8088/index.php