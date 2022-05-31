### projet-symfony
# Projet Symfony B2

## Groupe : Carminati Logan Jaremczuk Jonathan

# Liste des commandes pour l'installation
```
composer install
composer require webapp

npm install
npm run build
```

# Ajout des données préfaites dans la BDD
Nécessite un composer install une fois la commande exécutée
```
php bin/console doctrine:fixtures:load
```

# Utilisateurs et leurs rôles pour faire les tests

```
Role      : Admin
Email     : Philippe.Etchebest@gmail.com
Password  : BestCuistot

------------------------------------

Role      : User
Email     : bob@wanadoo.com
Password  : bob123+
```
