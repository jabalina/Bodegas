# Proyecto Mantenedor de Bodegas

## Instrucciones para levantar el proyecto:
1. Clonar el repositorio.
2. Ejecutar `composer install`.
3. Copiar el archivo `.env.example` a `.env` y configurar la base de datos.
4. Ejecutar `php artisan key:generate`.
5. Ejecutar `php artisan migrate --seed` para poblar la base de datos.
6. Ejecutar `php artisan serve`.
7. URL http://127.0.0.1:8000/bodegas
