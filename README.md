# Chewbacca

Site web pour le barber shop Chewbacca permettant aux clients de se renseigner sur les prestations, les coordonnées et de prendre rendez-vous.

Lien vers le site en ligne : https://barber-chewbacca.herokuapp.com.

## Fonctionnalités

Un client ne peut prendre rendez-vous que s'il possède un compte et est connecté. Il peut parcourir ses différents rendez-vous. Il peut accéder aux informations d'un rendez-vous ou l'annuler.

Un barbier connecté peut consulter son planning, accéder aux informations d'un rendez-vous ou décider de l'annuler.

Le compte d'un barbier est créé et configuré par le barbier administrateur (préalablement inscrit dans la base de données).

Chaque utilisateur connecté peut modifier ses informations personnelles.

## Technologies

Ce site web est réalisé avec les langages HTML, CSS, JavaScript, PHP, les framework Symphony et BootStrap et la police Font Awesome.

### Diagramme de classes

![image](design/classDiagram.png)

## Guide d'installation

Dans le terminal, saisissez les commandes suivantes : 

* Pour cloner le projet : 
```
git clone https://github.com/dacostal/barber.git
```

* Pour installer Composer : 
```
composer install
```

Copiez-collez le fichier .env à la racine du projet, renommez-le .env.local et modifiez la variable d'environnement DATABASE_URL selon les spécificités de votre serveur.

Créez une base de données nommée *barber*.

Dans le terminal, saisissez les commandes suivantes : 

* Pour créer les différentes tables et leurs relations : 
```
php bin/console d:m:m
```

* Pour charger les données : 
```
php bin/console d:f:l
```

## Authentification

### Authentification sur le site en local

Récupérez les informations concernant les différents types d'utilisateurs à partir de la base de données selon les fonctionnalités à tester.

### Authentification sur le site en ligne

Pour se connecter en tant que client : 

* E-mail : rogahn.ophelia@hotmail.com
* Mot de passe : azerty

Pour se connecter en tant que barbier : 

* E-mail : jhintz@yahoo.com
* Mot de passe : azerty

Pour se connecter en tant qu'administrateur : 

* E-mail : woodrow95@hotmail.com
* Mot de passe : azerty

## Auteurs

* Eviatar Houri alias eviatar75
* Seohyun Park alias soyamimi
* Simon Daniel alias simsam2831
* Léa Da Costa alias dacostal