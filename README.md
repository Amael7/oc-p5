# oc-p5

### Pré-requis :
- PHP 7.4.9, MySQL Version 5.7.30, Apache 2.4.48 

### Installations :

- Télécharger composer, copier coller ses liens si dessous a la racine du projet, dans votre termial shell.


       php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
       php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
       php composer-setup.php
       php -r "unlink('composer-setup.php');"

- Configurer les identifiants de connexion à la base de donnée dans un fichier .env à la racine du projet.
- Copier le contenu du fichier "/blog.sql" vers votre base de données.
- L'adresse du serveur doit pointer à la racine du dossier.
