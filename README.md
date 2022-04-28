# P5 - Projet de blog PHP

Ce projet a été réalisé dans le cadre de ma formation de développeur 
d'applications web PHP / Symfony chez OpenClassrooms.

* [Contexte du projet](docs/context.md)
* [Diagrammes que j'ai réalisé](docs/diagrams.md)

## Installation

Une fois que vous avez cloné le projet, faite un copier-coller du fichier ``.env`` et nommez le ``.env.local``

Vous pouvez alors remplir les informations de votre base de données et votre adresse mail (afin de recevoir les emails du formulaire de contact) :
```text
ENV=dev

DATABASE_NAME=
DATABASE_USER=
DATABASE_PASSWORD=
DATABASE_HOST=

DOMAIN=http://localhost:8000

ADMIN_EMAIL=
```

Une fois cela fait, ouvrez un terminal et rendez vous dans le dossier du projet :
```bash
cd /racine/vers/le/projet
```

Exécutez cette commande pour créer et remplir votre base de données :
```bash
php src/Database/createDatabase.php
```
Vous pouvez maintenant voir une nouvelle base de données (``p5_blog_php``) avec des données à l'intérieur.

Pour lancer le serveur, exécutez cette commande :
```bash
php -S localhost:8000 -t /public
```
Ouvrez votre navigateur, et accédez au site avec cette url : [http://localhost:8000](http://localhost:8000)

###<span style="color: indianred">Par défaut, un compte administrateur est créé pour que vous puissiez avoir accès à l'ensemble du projet.</span>

adresse email : ``admin@test.com``

mot de passe : ``admin``