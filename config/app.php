<?php

return [

    // Nombre de la aplicación.
    'name' => env('APP_NAME', 'Laravel'),

    // Entorno en el que se ejecuta: local, testing o production.
    'env' => env('APP_ENV', 'production'),

    // Activa o desactiva los mensajes detallados de errores.
    'debug' => (bool) env('APP_DEBUG', false),

    // Dirección principal de la aplicación.
    'url' => env('APP_URL', 'http://localhost'),

    // Zona horaria de Colombia.
    'timezone' => 'America/Bogota',

    // Idioma principal de la aplicación.
    'locale' => env('APP_LOCALE', 'es'),

    // Idioma alternativo si no existe una traducción.
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'es'),

    // Idioma utilizado por Faker para generar datos de prueba.
    'faker_locale' => env('APP_FAKER_LOCALE', 'es_ES'),

    // Algoritmo utilizado para cifrar información.
    'cipher' => 'AES-256-CBC',

    // Clave principal utilizada para el cifrado.
    'key' => env('APP_KEY'),

    // Claves anteriores que Laravel puede utilizar para descifrar datos.
    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    // Configuración del modo de mantenimiento.
    'maintenance' => [
        // Método utilizado para activar el mantenimiento.
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),

        // Almacenamiento utilizado para el mantenimiento.
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];