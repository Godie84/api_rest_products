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
- [Documentación Swagger](#swagger)  
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
- MySQL  

---

## Instalación

1. Clona el repositorio:  
```bash
git clone https://github.com/Godie84/api_rest_products.git
Entra en el directorio del proyecto:

bash
Copiar código
cd api_rest_products
Instala las dependencias con Composer:

bash
Copiar código
composer install
Configura el archivo .env con los datos de conexión a la base de datos y Sanctum.

Ejecuta las migraciones:

bash
Copiar código
php artisan migrate
Levanta el servidor local:

bash
Copiar código
php artisan serve
La API estará disponible en:

cpp
Copiar código
http://127.0.0.1:8000
Uso
Todas las peticiones deben dirigirse a la base URL de la API:

arduino
Copiar código
http://127.0.0.1:8000/api
Endpoints
Obtener lista de productos
Método: GET

Ruta: /api/products

Autenticación: Requiere token Bearer

bash
Copiar código
curl -H "Authorization: Bearer {token}" http://127.0.0.1:8000/api/products
Ejemplo de respuesta (200):

json
Copiar código
[
  {
    "id": 1,
    "name": "Producto 1",
    "description": "Descripción del producto 1",
    "price": 100.00,
    "stock": 1
  },
  {
    "id": 2,
    "name": "Producto 2",
    "description": "Descripción del producto 2",
    "price": 150.00,
    "stock": 2
  }
]
Crear un nuevo producto
Método: POST

Ruta: /api/products

Autenticación: Requiere token Bearer

Body (JSON):

json
Copiar código
{
  "name": "Nombre del producto",
  "description": "Descripción",
  "price": 100.00,
  "stock": 2
}
bash
Copiar código
curl -X POST http://127.0.0.1:8000/api/products \
-H "Authorization: Bearer {token}" \
-H "Content-Type: application/json" \
-d '{"name":"Nuevo producto","description":"Descripción","price":100.00,"stock":2}'
Ejemplo de respuesta (201):

json
Copiar código
{
  "id": 3,
  "name": "Nuevo producto",
  "description": "Descripción",
  "price": 100.00,
  "stock": 2
}
Obtener producto por ID
Método: GET

Ruta: /api/products/{id}

Autenticación: Requiere token Bearer

bash
Copiar código
curl -H "Authorization: Bearer {token}" http://127.0.0.1:8000/api/products/1
Ejemplo de respuesta (200):

json
Copiar código
{
  "id": 1,
  "name": "Producto 1",
  "description": "Descripción del producto 1",
  "price": 100.00,
  "stock": 2
}
Actualizar producto
Método: PUT

Ruta: /api/products/{id}

Autenticación: Requiere token Bearer

Body (JSON):

json
Copiar código
{
  "name": "Nombre actualizado",
  "description": "Descripción actualizada",
  "price": 120.00,
  "stock": 2
}
bash
Copiar código
curl -X PUT http://127.0.0.1:8000/api/products/1 \
-H "Authorization: Bearer {token}" \
-H "Content-Type: application/json" \
-d '{"name":"Producto actualizado", "description":"Nueva descripción", "price":120.00, "stock":2}'
Ejemplo de respuesta (200):

json
Copiar código
{
  "id": 1,
  "name": "Producto actualizado",
  "description": "Nueva descripción",
  "price": 120.00,
  "stock": 2
}
Eliminar producto
Método: DELETE

Ruta: /api/products/{id}

Autenticación: Requiere token Bearer

bash
Copiar código
curl -X DELETE http://127.0.0.1:8000/api/products/1 \
-H "Authorization: Bearer {token}"
Ejemplo de respuesta (204): Sin contenido.

Autenticación
Esta API utiliza Laravel Sanctum para autenticación con tokens tipo Bearer.

Agrega el token en el encabezado de tus solicitudes:

css
Copiar código
Authorization: Bearer {token}
Errores comunes
Código	Mensaje	Descripción
400	Bad Request	Datos enviados inválidos o incompletos
401	Unauthorized	Token inválido o no enviado
404	Not Found	Producto no encontrado
500	Internal Server Error	Error inesperado del servidor

Swagger
Puedes acceder a la documentación interactiva (Swagger UI) en:

http://localhost:8000/api/documentation#/

Contribuciones
¡Las contribuciones son bienvenidas!
Puedes crear issues o enviar pull requests con mejoras o correcciones.

Licencia
Este proyecto está bajo la licencia MIT.

---

