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
	Esta linea sirve para especificar la conexión que deseas usar en el array de conexiones que se observa más abajo.

El valor de la variable *default* se inicia con el valor que retorna la función *env*. La función *env* hace referencia a el archivo de ambiente Project/.env

Como el primer parámetro de la función *env(DB_CONNECTION, ...)* hace referencia a la credencial *DB_CONNECTION* del archivo Project/.env

Hacemos lo siguiente:
</p>

DB_CONNECTION=sqlite<br>
~~DB_HOST=127.0.0.1~~<br>
~~DB_PORT=3306~~<br>
~~DB_DATABASE=homestead~~<br>
~~DB_USERNAME=homestead~~<br>
~~DB_PASSWORD=secret~~<br>

<p align="justify">
borramos las demás credenciales (únicamente de ese bloque de código), dejando sólo la primera linea, es la que especifica que conexión queremos usar.
</p>

```
DB_CONNECTION=sqlite
```

<p align="justify">
Hay otras credenciales que hacen referencia a *APP_NAME*, *REDIS_HOST*, *MAIL_DRIVER* pero por el momento no nos interesa trabajar con ellas.
</p>

<p align="justify">
Puesto que ya especificamos que queremos usar la conexión <i>sqlite</i> podemos ver más abajo dentro del archivo <i>Project/config/database.php</i> algo como:
</p>

```
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],
```

explicación de:

```
'database' => env('DB_DATABASE', database_path('database.sqlite')),
```

<p align="jsutify">
	La variable <i>database</i> solicita al archivo de ambiente a través de la función <i>env</i> la ruta de la base de datos de la que haremos uso.

Sino encuentra la DB en el primer argumento se ira al segundo argumento que es: <i>database_path('database.sqlite')),</i>

Como borramos las demás credenciales el el archivo de ambiente <i>Project/.env</i> y sólo dejamos <i>DB_CONNECTION</i> NO la va a encontrar. Es por eso que debemos crear un archivo database.sqlite
</p>

Vamos a la termina y dentro del directorio escribimos:

```
touch database/database.sqlite
```

<p align="justify">
el primer *database* hace referencia al directorio con ese nombre, el segundo al nombre de la base de datos lo podemos cambiar.
</p>

## Fuente

* [Curso](https://www.youtube.com/watch?v=XrrbV5YO2PY)