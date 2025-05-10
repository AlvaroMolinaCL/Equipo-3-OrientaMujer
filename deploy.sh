#!/bin/bash

set -e

# Obtener últimos cambios de la rama main
echo "Haciendo pull de la última versión desde repositorio..."
git pull origin main

# Instalar dependencias PHP
echo "Instalando dependencias de PHP..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Limpiar cache
echo "Limpiando cache..."
php artisan optimize:clear

# Ejecutar migraciones (solo si es necesario)
echo "Ejecutando migraciones..."
php artisan migrate --force

# Instalar dependencias de Node.js y compilar assets
echo "Instalando dependencias de Node.js..."
npm install
echo "Compilando assets..."
npm run build

echo "Despliegue completado."
