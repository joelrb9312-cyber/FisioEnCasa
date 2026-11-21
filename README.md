# FisioEnCasa

API REST para la gestión de un sistema de fisioterapia, desarrollado con PHP, MySQL y arquitectura MVC.

## Tecnologías utilizadas

- PHP
- MySQL
- PDO
- JavaScript
- HTML y CSS
- Composer

## Estructura del proyecto

- `app/`: controladores y modelos.
- `config/`: configuración y conexión a la base de datos.
- `core/`: componentes principales del sistema (Router, Request y Response).
- `public/`: punto de entrada de la aplicación.
- `routes/`: definición de rutas de la API.
- `src/`: archivos del frontend.
- `fisioencasa.sql`: script de creación de base de datos y datos de prueba.

## Módulos de la API

La API permite realizar operaciones CRUD en los siguientes módulos:

- Servicios
- Pacientes
- Fisioterapeutas
- Horarios
- Pagos
- Reservas

Cada módulo cuenta con operaciones para crear, consultar, actualizar y eliminar registros.

## Configuración e instalación

1. Clonar o descargar el repositorio.
2. Copiar el proyecto dentro de la carpeta `htdocs` de XAMPP.
3. Crear la base de datos importando el archivo `fisioencasa.sql` desde phpMyAdmin.
4. Copiar `config/.env.example` y crear un archivo `config/.env`.
5. Configurar las credenciales de conexión a MySQL en el archivo `.env`.
6. Iniciar Apache y MySQL desde XAMPP.

## Acceso a la API

La API se encuentra disponible localmente en:

`http://localhost/FisioEnCasa/public/api/`

## Autor

**Joel Omar Rojas Berrocal**  
Proyecto ISIL – Programación Web Básica