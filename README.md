# Changelog

Todos los cambios importantes de este proyecto se registran en este archivo.

El formato sigue Keep a Changelog y el proyecto usa versionado semántico.

## [Unreleased]

### Added
- GET /api/v1/health
- Errores en JSON para rutas /api

---

# Contact API

[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20)](https://laravel.com/)
[![Licencia](https://img.shields.io/badge/licencia-MIT-blue)](LICENSE.md)

API REST para gestionar contactos.

Proyecto desarrollado como parte del programa ADSO (SENA), ficha 3174404.

- Versión actual: v0.1.0

## Contenido

- [Tecnologías](#tecnologías)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Modelo de datos](#modelo-de-datos)
- [Datos de prueba](#datos-de-prueba)
- [Variables de entorno](#variables-de-entorno)
- [Pruebas](#pruebas)
- [Documentación de la API](#documentación-de-la-api)
- [Endpoints](#endpoints)
- [Flujo de trabajo](#flujo-de-trabajo)
- [Autor](#autor)
- [Licencia](#licencia)

## Tecnologías

PHP 8.3, Laravel 13, MySQL, Laravel Sanctum, Pest y Scramble.

## Requisitos

PHP 8.3+, Composer 2, MySQL y Git.

## Instalación

```bash
git clone https://github.com/Carloschinchia/contact-api.git
cd contact-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Modelo de datos

Diagrama entidad-relación: [docs/er.md](docs/er.md)

## Datos de prueba

Para crear los datos de prueba en un entorno local:

```bash
php artisan db:seed
```

El seeder crea un usuario de prueba y 10 contactos asociados.

## Variables de entorno

Configura las variables necesarias en el archivo `.env`.

| Variable | Descripción |
|---|---|
| DB_CONNECTION | Conexión de base de datos |
| DB_DATABASE | Nombre de la base de datos |
| DB_USERNAME | Usuario de MySQL |
| DB_PASSWORD | Contraseña de MySQL |

## Pruebas

```bash
php artisan test
```

## Documentación de la API

Con el servidor local ejecutándose:

http://127.0.0.1:8000/docs/api

## Endpoints

| Método | Ruta | Descripción | Auth |
|---|---|---|---|
| GET | /api/v1/health | Estado del servicio | No |

## Flujo de trabajo

Git Flow (main, develop, feature/*, release/*, hotfix/*), Conventional Commits y versionado semántico.

Los cambios se registran en CHANGELOG.md.

## Autor

Carlos Chinchia · Aprendiz ADSO.

## Licencia

Distribuido bajo la licencia MIT. Ver LICENSE.md.