Learning Laravel - Parte 2
===========

  <a name="strings--line-length"></a><a name="6.2"></a>
  - [6.2](#strings--line-length) Strings that cause the line to go over 100 characters should not be written across multiple lines using string concatenation.

    > Why? Broken strings are painful to work with and make code less searchable.

    ```javascript
    // bad
    const errorMessage = 'This is a super long error that was thrown because \
    of Batman. When you stop to think about how Batman had anything to do \
    with this, you would get nowhere \
    fast.';

    // bad
    const errorMessage = 'This is a super long error that was thrown because ' +
      'of Batman. When you stop to think about how Batman had anything to do ' +
      'with this, you would get nowhere fast.';

    // good
    const errorMessage = 'This is a super long error that was thrown because of Batman. When you stop to think about how Batman had anything to do with this, you would get nowhere fast.';
    ```

## Descripción:

<p align="justify">
	En este repositorio trataremos de documentar lo aprendido en el curso <b>Laravel 5.4 - Clon de Reddit</b> impartido por @gpopoteur.

* [Parte 1](https://github.com/ginppian/Learning-Laravel/)
</p>

### Tópico 2 - SQLite

<p align="justify">
	Al crear nuestro Sistema es esencial el uso de una Base de Datos. En este tutorial aprenderemos como insertar datos a la DB de una manera simple.
</p>

#### Paso 1 - Creamos un nuevo proyecto

<p align="justify">
Vamos a la terminal y en el directorio donde tendremos nuestro proyecto escribimos:
</p>

```
laravel new Learning-Laravel-SQLite
```

al terminar nos imprimira algo como:

> Application ready! Build something amazing.

#### Paso 2 - Configurando la DB

Para configurar la DB hay dos archivos importantes:

1. Project/config/database.php
2. Project/.env

Si abrimos el primer archivo podremos ver algo como:

```
    'default' => env('DB_CONNECTION', 'mysql'),
```

<p align="justify">
	En esta linea se especifica la conexión que deseas usar en el array de conexiones que se observa más abajo.

El valor de *default* se iniciativa con el valor que retorna la función *env*.

La función *env* lee el archivo de ambiente Project/.env

El parámetro *DB_CONNECTION* hace referencia a la credencial DB_CONNECTION dentro del archivo Project/.env

Así que dentro de Project/.env cambiamos:
</p>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

por:

```
DB_CONNECTION=sqlite
~~DB_HOST=127.0.0.1~~
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

<p align="justify">
y borramos las demás credenciales de ese bloque de código, dejando únicamente:
</p>

```
DB_CONNECTION=sqlite
```

## Fuente

* [Curso](https://www.youtube.com/watch?v=XrrbV5YO2PY)