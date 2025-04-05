# Laravel-Vue-AEMET

Este proyecto es una aplicación web que utiliza Laravel y Vue.js para mostrar datos meteorológicos proporcionados por la API de AEMET (Agencia Estatal de Meteorología).

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/your-username/laravel-vue-aemet.git
cd laravel-vue-aemet
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de JavaScript

```bash
npm install
```

### 4. Configuración del entorno

Copie el archivo `.env.example` a `.env` y configure las variables de entorno necesarias:

```bash
cp .env.example .env
php artisan key:generate
```

Configure la conexión a la base de datos y la clave de API de AEMET en el archivo `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_vue_aemet
DB_USERNAME=root
DB_PASSWORD=

AEMET_API_KEY=your_api_key_here
```

### 5. Migraciones y seeders

Ejecute las migraciones para crear las tablas de la base de datos:

```bash
php artisan migrate
```

Ejecute los seeders para poblar la base de datos con datos iniciales:

```bash
php artisan db:seed
```

Los seeders incluidos son:
- `TownshipsSeeder` - Pobla la tabla de municipios

### 6. Compilar assets

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

### 7. Iniciar el servidor

```bash
php artisan serve
```
### 8. Acceder a la aplicación

La aplicación estará disponible en `http://localhost:8000`. Si este puerto no está disponible, el terminal mostrará la URL con el puerto alternativo que se está utilizando.

## Funcionalidades

- Búsqueda por ubicación
- Visualización de datos meteorológicos actuales

## Estructura del proyecto

- `app/` - Lógica de la aplicación
- `resources/js/` - Componentes Vue.js
- `database/migrations/` - Migraciones de la base de datos
- `database/seeders/` - Seeders para datos iniciales