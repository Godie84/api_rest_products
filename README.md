# API REST de Productos

API REST para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre productos.

---

## Tabla de Contenidos

- [Descripción](#descripción)  
- [Tecnologías](#tecnologías)  
- [Instalación](#instalación)  
- [Uso](#uso)  
- [Endpoints](#endpoints)  
- [Autenticación](#autenticación)  
- [Errores comunes](#errores-comunes)  
- [Contribuciones](#contribuciones)  
- [Licencia](#licencia)  
- [Contacto](#contacto)  

---

## Descripción

Esta API permite gestionar un catálogo de productos mediante operaciones CRUD: crear nuevos productos, obtener listados o detalles, actualizar y eliminar productos.

---

## Tecnologías

- Laravel  
- Laravel Sanctum (para autenticación)  
- PHP  
- MySQL (o base de datos relacional)  

---

## Instalación

1. Clona el repositorio:  
```bash
git clone https://github.com/tu_usuario/api-rest-productos.git


Entra en el directorio:

cd api-rest-productos


Instala las dependencias con Composer:

composer install


Configura tu archivo .env con los datos de la base de datos y Sanctum.

Ejecuta migraciones:

php artisan migrate


Levanta el servidor local:

php artisan serve


La API estará disponible en http://127.0.0.1:8000.

Uso

Todas las peticiones deben dirigirse a la base URL:

http://127.0.0.1:8000/api

Endpoints
Obtener lista de productos

Método: GET

Ruta: /api/products

Descripción: Obtiene todos los productos.

Autenticación: Requiere token Bearer.

Parámetros: Ninguno.

Ejemplo request:

curl -H "Authorization: Bearer {token}" http://127.0.0.1:8000/api/products


Ejemplo response (200):

[
  {
    "id": 1,
    "name": "Producto 1",
    "description": "Descripción del producto 1",
    "price": 100.00
  },
  {
    "id": 2,
    "name": "Producto 2",
    "description": "Descripción del producto 2",
    "price": 150.00
  }
]

Crear un nuevo producto

Método: POST

Ruta: /api/products

Descripción: Crea un producto nuevo.

Autenticación: Requiere token Bearer.

Body (JSON):

{
  "name": "Nombre del producto",
  "description": "Descripción",
  "price": 100.00
}


Ejemplo request:

curl -X POST http://127.0.0.1:8000/api/products \
-H "Authorization: Bearer {token}" \
-H "Content-Type: application/json" \
-d '{"name":"Nuevo producto", "description":"Descripción", "price":100.00}'


Ejemplo response (201):

{
  "id": 3,
  "name": "Nuevo producto",
  "description": "Descripción",
  "price": 100.00
}

Obtener producto por ID

Método: GET

Ruta: /api/products/{id}

Descripción: Obtiene detalle de un producto por su ID.

Autenticación: Requiere token Bearer.

Parámetros:

id (path): ID del producto.

Ejemplo request:

curl -H "Authorization: Bearer {token}" http://127.0.0.1:8000/api/products/1


Ejemplo response (200):

{
  "id": 1,
  "name": "Producto 1",
  "description": "Descripción del producto 1",
  "price": 100.00
}

Actualizar producto

Método: PUT

Ruta: /api/products/{id}

Descripción: Actualiza un producto existente.

Autenticación: Requiere token Bearer.

Parámetros:

id (path): ID del producto.

Body (JSON):

{
  "name": "Nombre actualizado",
  "description": "Descripción actualizada",
  "price": 120.00
}


Ejemplo request:

curl -X PUT http://127.0.0.1:8000/api/products/1 \
-H "Authorization: Bearer {token}" \
-H "Content-Type: application/json" \
-d '{"name":"Producto actualizado", "description":"Nueva descripción", "price":120.00}'


Ejemplo response (200):

{
  "id": 1,
  "name": "Producto actualizado",
  "description": "Nueva descripción",
  "price": 120.00
}

Eliminar producto

Método: DELETE

Ruta: /api/products/{id}

Descripción: Elimina un producto.

Autenticación: Requiere token Bearer.

Parámetros:

id (path): ID del producto.

Ejemplo request:

curl -X DELETE http://127.0.0.1:8000/api/products/1 \
-H "Authorization: Bearer {token}"


Ejemplo response (204): No hay contenido.

Autenticación

Esta API utiliza Laravel Sanctum para autenticación mediante tokens Bearer.

Para acceder a los endpoints protegidos, incluye el token en el encabezado de autorización:

Authorization: Bearer {token}

Errores comunes
Código	Mensaje	Descripción
400	Bad Request	Datos enviados inválidos o faltantes
401	Unauthorized	Token inválido o no enviado
404	Not Found	Producto no encontrado
500	Internal Server Error	Error inesperado en el servidor
Contribuciones







<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

#   a p i _ r e s t _ p r o d u c t s  
 