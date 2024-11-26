# Proyecto de API REST con Autenticación JWT - PRACTICA 6
## Nombre: Alex Laime Quispe

Este proyecto consiste en una **API REST** creada con **PHP** y **SQLite** que implementa **autenticación** y **autorización** utilizando **JSON Web Tokens (JWT)**. Los endpoints están protegidos, y solo los usuarios autenticados con un token válido pueden acceder a datos protegidos.

## Tecnologías Utilizadas

- **PHP**: Lenguaje de programación para el backend.
- **SQLite**: Base de datos ligera integrada en el proyecto.
- **JWT (JSON Web Tokens)**: Para la autenticación y autorización.
- **Postman**: Herramienta para probar la API.

## Estructura del Proyecto

- **practica_6_seguridad_sw/**
  - **api/**
    - **auth.php**: Endpoint para autenticación (login).
    - **user.php**: Endpoint protegido para acceder a los datos del usuario.
  - **db/**
    - **database.sqlite**: Base de datos SQLite con la tabla de usuarios (incluida).
  - **vendor/**: Carpeta generada por Composer con las dependencias.
  - **composer.json**: Definición de las dependencias del proyecto.
  - **index.php**: Punto de entrada principal que enruta las solicitudes.
  - **README.md**: Este archivo.


---

## Instalación

### Requisitos

1. **PHP**: Tener PHP instalado
2. **Composer**: Se necesita Composer para instalar las dependencias de PHP.
3. **XAMPP o un servidor local** para ejecutar el servidor PHP.

### Pasos de instalación

1. **Clonar el repositorio**:
   Clonar este repositorio o descargarlo:
   ```bash
   git clone https://github.com/aelxlex/practica_6_seguridad_sw.git
   cd practica_6_seguridad_sw
2. **Instalar dependencias con Composer**: Si no tienes composer puedes descargarlo desde: https://getcomposer.org/download/ . Ejecuta el siguiente comando para instalar las dependencias del proyecto: 
    ```bash
    composer install
3. **Base de datos incluida**: El archivo de base de datos database.sqlite ya está incluido en este proyecto, con los datos de usuarios de prueba preconfigurados.

4. **Iniciar el servidor**:
Si estás usando XAMPP, asegúrate de que Apache esté corriendo.
Copia el proyecto en la carpeta htdocs de XAMPP o en cualquier en el servidor local que uses.
Entraal proyecto en tu navegador en http://localhost/practica_6_seguridad_sw

---
## Endpoints
### 1. **POST /auth - Autenticación (Login)
Descripción**: Este endpoint permite a un usuario iniciar sesión con su nombre de usuario y contraseña, y devuelve un token JWT si las credenciales son correctas.
Método HTTP: POST
URL: /auth
Cuerpo de la solicitud (JSON):
    

    {
        "username": "alex",
        "password": "123456"
    }

#### - Respuesta Exitosa:  
        {
            "token": "tu_token_jwt_aquí"
        }

#### - Respuesta de error (si las credenciales son incorrectas):  
        {
            "error": "Credenciales incorrectas"
        }
 
### 2. GET /user - Acceder a datos protegidos
- Descripción: Este endpoint devuelve los datos del usuario autenticado, pero solo si se proporciona un token JWT válido en el encabezado Authorization.
- Método HTTP: GET
- URL: /user
- Encabezado de solicitud:
    ```bash
    Authorization: Bearer <tu_token_jwt_aquí>
#### - Respuesta Exitosa:  
        {
            "message": "Bienvenido al panel de usuario",
            "user": {
            "id": 1,
            "role": "admin",
            "iat": 1732584332,
            "exp": 1732587932
        }
    }


#### - Respuesta de error (si el token es inválido o no se proporciona):  
        {
            "error": "Token inválido"
        }

---
## Probando la API

1. Obtener un token JWT:
Realiza una solicitud POST a http://localhost/practica_6_seguridad_sw/auth con las credenciales del usuario:
    - (username: alex, password: 123456) o
    - (username: usuario, password: 654321)

    Copia el token JWT que recibes en la respuesta.
2. Acceder a los datos protegidos:
Realiza una solicitud GET a http://localhost/practica_6_seguridad_sw/user.

    En el encabezado de la solicitud, agrega:

    - Authorization: Bearer <tu_token_jwt_aquí>

    Si el token es válido, deberías recibir los datos del usuario. Si el token es inválido o ha expirado, recibirás un error.

---
### Posibles Errores
1. **Token inválido o expirado**
Si el token JWT ha expirado o es inválido, recibirás una respuesta con un error:

    ```bash
    {
        "error": "Token inválido"
    }
Para solucionar este problema, simplemente vuelve a iniciar sesión para obtener un nuevo token.

2. **Endpoint no encontrado**
Si ves un error como este:
    ```bash
    {
        "error": "Endpoint no encontrado"
    }
Verifica que la URL y el método de la solicitud sean correctos, y que el archivo index.php esté configurado correctamente.

----