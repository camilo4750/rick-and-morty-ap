<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Rick and Morty

Aplicación que contiene el BackEnd y FrontEnd de Rick and Morty

# Technologias

- Larave/php
- Vue3.js (Composition Api)
- Toast.js
- Bootstrap 5

# BD

Se usa una Base de Datos Postgres con la cual se realiza la consulta y persistencia de datos.

# Arquitectura BackEnd

- Se implementan metodologías utilizando los patrones Service y Repository, desacoplando la lógica de negocio y el acceso a datos mediante el uso de interfaces,
- Para el desarrollo se aplica una arquitectura en capas
- Para facilitar la configuración del entorno, asegurar la portabilidad, se utilizó Docker como herramienta de virtualización ligera.
- Se definieron contenedores separados para los servicios clave: PHP (Laravel), PostgreSQL (Base de datos), Nginx o Apache (Servidor web)

```plaintext
rick-and-morty-api/
│
├── app/
│   ├── Dto/                     # Objetos de transferencia de datos (Data Transfer Objects)
│   ├── Entities/                # Entidades del dominio
│   ├── Exceptions/              # Excepciones personalizadas
│   ├── Http/
│   │   └── Controllers/         # Controladores HTTP
│   ├── Interfaces/
│   │   ├── Repositories/        # Interfaces para los Repositorios
│   │   └── Services/            # Interfaces para los Servicios
│   ├── Mappers/                 # Mapeadores de datos (DTO)
│   ├── Repository/              # Implementaciones de Repositorios
│   └── Services/                # Implementaciones de Servicios
│
├── routes/
│    ├── App/                    # Rutas de la aplicacion
│
├── tests/
│    ├── Feature/                 # Pruebas funcionales
│    ├── Integration/             # Pruebas de integración
│    │   ├── Repositories/        # Pruebas específicas de Repositorios
│    │   └── Services/            # Pruebas específicas de Servicios
```

# FrontEnd
- Se trabajo con vue3 -> Composition Api, manejando el master.blade como principal para la base de la vista y el Home.blade que contiene toda la logica
- puerto http://localhost:8082/

```plaintext
rick-and-morty-api/
│
├── resources/
│   ├── views/ 
│       └── home.blade.php
│       └── master.blade.php   
```

## Migraciones por defecto
- Se agrega migracion para crear la tabla que almacenara los personajes 

# Especificacion entorno

## Pasos para correr el entorno Docker de Rick and Morty API
- Los comandos se ejecutan en orden al levantar el contenedor con 'up' este quedara corriendo, abrir una nueva pestaña linux "Ctrl + Shift + t" y correr el comando para instalar el composer y correr las migraciones
- Despues podra acceder a la url de la vista 

Crear la red de Docker
```plaintext
sudo docker network create rick-and-morty-api-network
 ```

Levantar los contenedores del entorno (modo desarrollo)
```plaintext
sudo docker compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml up
```

Instalar dependencias de PHP con Composer
```plaintext
sudo docker exec -it rick-and-morty-api composer install
 ```

Ejecutar migraciones de base de datos
```plaintext
sudo docker exec -it rick-and-morty-api php artisan migrate
```

Acceder a la aplicación en el navegador
- 📍 URL: http://localhost:8082/

Detener y eliminar los contenedores
```plaintext
sudo docker compose -f .devops/docker/develop/docker-compose.yml -f .devops/docker/develop/docker-compose.override.yml down
```
