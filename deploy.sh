#!/bin/bash

echo "Iniciando despliegue..."

# Ir al directorio del proyecto
cd /var/www/laravel

# Obtener últimos cambios de la rama main
git pull origin main

# Instalar dependencias PHP
composer install --no-interaction --prefer-dist --optimize-autoloader

# Cachear configuración
php artisan config:cache
php artisan view:cache

# Ejecutar migraciones (solo si es necesario)
php artisan migrate --force

# Compilar assets
npm install
npm run build

echo "Despliegue completado."
