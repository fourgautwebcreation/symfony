exercice
========

A Symfony project created on September 13, 2016, 1:26 pm.

========

Commandes avant deploiement :

- Se placer dans le dossier du projet : cd /path/to/project
- Vider cache environnement de développement : php bin/console cache:clear
- Vider cache environnement de production : php bin/console cache:clear --env=prod
- S'assurer de la suppression des fichiers en cache : rm -r var/cache/* et rm -r var/logs/*
- Activer le debugger si voulu dans /web/app.php : $kernel = new AppKernel('prod', true);
- Mettre à jour le composer : php composer.phar self-update
- Mettre à jour les dépendances : php composer.phar update
- Verifier la sécurité des dépendances : php security-checker.phar security:check composer.lock
- Ajout de notre IP dans /web/config.php et /web/app_dev.php afin de pouvoir accéder aux recommandations de configuration et à l'environnement de developpement

- Upload FTP

- Acces au commandes shell à l'url /web/app_dev.php/_console via le bundle ConsoleBundle
préalablement installé
- Uploader composer.json et composer.lock, puis éxecuter composer.phar install
- Création de la base de donnée : doctrine:database:create si possible sur l'hebergement
- Mise à jour des tables : doctrine:schema:update --force
- Créer un utilisateur : fos:user:create testuser test@example.com p@ssword
  -> Liste complète des commandes :
  -> http://symfony.com/doc/current/bundles/FOSUserBundle/command_line_tools.html
