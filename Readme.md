## Todo
- postman_collection.json > Doit être supprimer et ajouter dans le Postman online
- cee.database.json > Doit être supprimer les fixtures seront dans le Postman online
- src/cli.php > Trouver une meilleur méthode pour initializer la database dynamoDB
- src/dtd/ > Doit être supprimer et accessible en statique en ligne
- Dockerfile > Completer avec les staging de tests, dev, prod
- .github/workflow/ > Completer avec les tests, docker, vault, deploy, ...

## Installation
`docker-compose up -d`

`cd src/ && docker exec -it osc2e /bin/bash -c 'php cli.php db'`

## url projet
`curl 0.0.0.0:8080`

