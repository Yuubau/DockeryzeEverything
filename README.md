# DockeryzeEverything

Lien github: https://github.com/Yuubau/DockeryzeEverything

Le projet une API REST en PHP basique qui permet de maintenir à jour son stock de livre.

/DockeryzeEverything
    AUTHORS
    README.md
    /src
        /src
            /controller
                books_controller.php
            /dao
                books_dao.php
            /server
                config.php
        index.php
        /db
            library.sql
        docker-compose.yaml
        Dockerfile

URL: http://localhost:80/index.php/{...}

L'endpoint doit être écrit dans a la place de {...}, index.php fait office d'aiguillage, pour appeler les bonnes fonctions.
Les fonctions utilitaires sont comprises dans le dossier /src/server.
Les fonctions qui enregistrent/modifient les données sont dans /src/dao.
Les fonctions qui appellent la bonne fonction DAO sont dans /src/controller/books_controller/php

/db/library.sql contient un fichier utilisé par le container sql pour initialiser la BDD et la table book.
