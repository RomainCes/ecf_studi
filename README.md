# ecf_studi
Voici mon projet ecf_studi

## Installation

1. Clonez le dépôt :
    ```sh
    git clone https://github.com/RomainCes/ecf_studi.git
    cd ecf_studi
    ```

2. Installez les dépendances :
    ```sh
    composer install
    npm install
    ```

3. Configurez votre environnement en dupliquant le fichier `.env` :
    ```sh
    cp .env .env.local
    ```

4. Modifiez `.env.local` avec vos paramètres de base de données.

5. Créez la base de données et les schémas :
    ```sh
    php bin/console doctrine:database:create
    php bin/console doctrine:schema:update --force
    ```

6. Chargez les données de test :
    ```sh
    php bin/console doctrine:fixtures:load
    ```

7. Lancez le serveur de développement :
    ```sh
    symfony serve
    ```

8. Accédez à l'application via `http://localhost:8000`.

## License

Ce projet est sous licence MIT.

# Manuel d'utilisation de l'application Z-Event

## Présentation de l'application
L'application Z-Event permet de suivre les lives des streamers, de pouvoir créer un streamer ou un live ou un article de blog et de voir les statistiques pour les streamer.

## Identifiants de test
- **Administrateur**
  - Nom d'utilisateur : root
  - Mot de passe : root

- **Visiteur**
  - Nom d'utilisateur : visiteur
  - Mot de passe : visiteurtest

## Fonctionnalités principales
- Consulter les dernières actualités
- S'inscrire et suivre les lives
- Voir les statistiques des lives
