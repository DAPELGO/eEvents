#!/bin/bash
set -e

echo "Début du déploiement..."

# Passage en mode maintenance ou renvoi true si déjà en mode maintenance
(php artisan down --message="Le site est en cours de maintenance. Merci de revenir sous peu.") || true

# Mise à jour de la dernière version du code
git pull origin deploy

# Installation des dépendances composer
composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

# On netoit le cache
php artisan optimize:clear

# On recrée le cache
php artisan optimize

# On désactive le mode maintenance
php artisan up

echo "Déploiement terminé !"

