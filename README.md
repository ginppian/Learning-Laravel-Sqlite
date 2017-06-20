Learning Laravel - Parte 2
===========

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

```php
laravel new Learning-Laravel-SQLite
```

al terminar nos imprimira algo como:

> Application ready! Build something amazing.

#### Paso 2 - Configurando la DB

Para configurar la DB hay dos archivos importantes:

1. Project/config/database.php
2. Project/.env

Si abrimos el primer archivo podremos ver algo como:

```php
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

```php
DB_CONNECTION=sqlite
```

<p align="justify">
Hay otras credenciales que hacen referencia a *APP_NAME*, *REDIS_HOST*, *MAIL_DRIVER* pero por el momento no nos interesa trabajar con ellas.
</p>

<p align="justify">
Puesto que ya especificamos que queremos usar la conexión <i>sqlite</i> podemos ver más abajo dentro del archivo <i>Project/config/database.php</i> algo como:
</p>

```php
        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],
```

explicación de:

```php
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
el primer <i>database</i> hace referencia al directorio con ese nombre, el segundo al nombre de la base de datos lo podemos cambiar.
</p>

* Comprobación

<p align="justify">
	Para comprobar que la conexión es exitosa nos vamos a la terminal y escribimos lo siguiente:
</p>

```
php artisan tinker
```
<p align="justify"
<b>Tinker</b> es un interpretador de php interactivo.
Dentro podemos escribir código de PHP para probar partes de nuestra aplicación. El código de <i>Tinker</i> se va a ejecutar como si fuera código escrito dentro de nuestra aplicación.

Para probar que tenemos <b>conexión</b> basta ejecutar el siguiente comando dentro de <i>Tinker</i>:
</p>

```php
DB::connection()->getPdo()
```

<p align="justify">
	Esta función nos retorna una instancia de <i>PDO</i> si la conexión es exitosa, nos muestra algo así:
</p>

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img1.png" width="486" height="368" />
</p>

De la conexión <b>NO</b> ser exitosa esta función retornaría un <i>exception</i>.

#### Paso 3 - Migraciones 

<p align="justify">
Cuando creamos nuestras bases de datos solemos crear <i>diagramas relacionases</i> que nos facilitan la abstracción de como se va a almacenar nuestra información.
</p>

<p align="justify">
La forma de implementar dichos <i>diagramas</i> es manejar el lenguaje de script encargado de implementar nuestra idea de la BD y ejecutar dicho script. 
</p>

<p align="justify">
Según la documentación oficial:

<b>"</b>Las migraciones son un tipo de control de versiones para su base de datos. Permiten a un equipo modificar el esquema de la base de datos y mantenerse al día en el estado del esquema actual. Las migraciones suelen estar emparejadas con el Constructor de esquemas para administrar fácilmente el esquema de la aplicación.<b>"</b>

Es decir, en vez de usa el lenguaje de Script del gestor de la base de datos, usaremos clases de tipo <i>Migrations</i> para <b>crear</b> las tablas. Y otras clases de tipo <i>Models</i> para <b>manejar</b> esas tablas.
</p>

Nos vamos a nuestra terminal y escribimos:

```
php artisan make:migration create_post_table --create=posts
```

El comando anterior nos genera un archivo para manejar la creación de la <b>estructura</b> de la tabla. Los parámetros:

```
--create=posts
```

nos crean una <b>tabla</b> en la <i>Base de Datos</i> ya real!

Entonces, hemos creando la tabla <b>posts</b> que por el momento se encuentra vacía, y una <i>clase</i> <b>CreatePostTable</b> que nos permitirá agregarle campos a nuestra tabla, también nos permitirá regresar a un estado previo a modificar la, etc. 

Y se ve de esta manera:

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img2.png" width="866" height="728" />
</p>

<p align="justify">
	Podemos fijarnos que en la función <i>up()</i> contiene lo siguiente:
</p>

```
Schema::create('posts', function (Blueprint $table) {
```

el primer parámetro corresponde al *nombre de la tabla*, el segundo es un *closure* que especifica los parámetros de *$table*, por ejemplo:<br>

```
$table->increments('id');
```

nos dice que tendrá un *id autoincrementable*.<br>

<p align="justify">
También nos otros podemos agregarle columnas a la tabla. <i>¿Cómo?</i><br>
Bastara con especificarle a nuestro objeto <b>$table</b> el tipo de dato que manejará la columna y el nombre que tendrá dicha columna.
</p>

Nuestra función <i>up</i> se vería así:

```php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('description');
            $table->string('url');
            
            
            $table->timestamps();
        });
    }
```

Para <b>Migrar</b> las nuevas columnas la base bastará con ejecutar el siguiente comando, para ejecutar las nuevas migraciones creadas:

```
php artisan migrate
```

En mi caso se ve algo así (pero puede variar):

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img3.png" width="776" height="167" />
</p>

* Modelo

<p align="justify">
	Ahora tenemos que crear el <i>Modelo</i> que nos permitirá <b>editar</b> los datos de la tabla.
</p>

<p align="justify">
Para tenemos que crear un nuevo archivo/clase de preferencia con el nombre en singular de la tabla, es decir si nuestra tabla se llamo:
</p>

```
posts
```

nuestro archivo/clase se llamara de preferencia:

```
post
```

<p align="justify">
Laravel permite crear <i>Modelos</i> en cualquier lugar pero es una buena práctica tenerlos en el directorio donde él los almacena: <b>Project/app</b>
<p>

<p align="justify">
Entonces vamos a ese directorio y creamos <i>Post.php</i> con el siguiente código:
<p>

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  // Hace referencia a la tabla que esta Class va a usar
  protected $table = 'posts';
}
```

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img4.png" width="1081" height="600" />
</p>

<p align="justify">
Si nos fijamos la función <i>up</i> y la variable <i>table</i> aun que en diferentes archivos:
</p>

```
Schema::create('posts', function (Blueprint $table) {
```

```
protected $table = 'posts';
```

<p align="justify">
ambos parámetros tienen el mismo nombre de tabla: <b>posts</b>
</p>

Ahora ya está listo, sólo falta agregar algunos elementos.

* Tinker

Abrimos <i>Tinker</i>:

```
php artisan tinker
```

creamos un <b>instancia</b> de la clase <i>Post</i> y asignamos:

```
$post = new App\Post
$post->title = 'Title 1'
$post->description = 'Description 1'
$post->url = 'https://www.google.com'
$post->save()
```

<p align="justify">
El primer comando como ya lo dijimos crea una instancia, los siguientes asignan valores a <i>propiedades</i> de la <i>tabla</i> y el último como su nombre lo indica guarda los cambios.
</p>

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img5.png" width="780" height="260" />
</p>

Si nos aparece <b>true</b> ¡todo salió bien!

* Otra manera

<p align="justify">
	Otra manera de almacenar datos ¡<i>más sencilla</i>! es haciendo uso de nuestro <b>Modelo</b> o nuestra <i>clase Post.php</i> asignando la siguiente linea:
</p>

<p align="justify">
<b>$fillable</b> te permite especificar qué campos sí quieres que se guarden en la base de datos. Es decir, se asignan únicamente los especificados en este array.
</p>

```php
protected $fillable = ['title', 'description', 'url'];
```

es decir, nuestro código quedaría así:

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

  // Hace referencia a la tabla que esta Class va a usar
  protected $table = 'posts';

  protected $fillable = ['title', 'description', 'url'];
}
```

Otra vez corremos <b>Tinker</b>

```
php artisan tinker
```

y ejecutamos:

```
	App\Post::create(['title' => 'Title 2', 'description' => 'Description 2', 'url' => 'http://www.youtube.com'])
```

algo así:

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img6.png" width="1028" height="243" />
</p>

* Mostrando datos

<p align="justify">
	Para <b>mostrar datos</b> basta con abrir <i>Tinker</i> y ejecutar lo siguiente:
</p>

```
App\Post::all()
```

Post porque es la clase que maneja nuestra tabla.

<p align="center">
  <img src="https://github.com/ginppian/Learning-Laravel-Sqlite/blob/master/imgs/img7.png" width="781" height="400" />
</p>

[Fuente 1 Migraciones](https://richos.gitbooks.io/laravel-5/content/capitulos/chapter6.html)<br>
[Fuente 2 Migrations Laravel Oficial](https://laravel.com/docs/5.4/migrations)<br>
[Fuente 3 ¿Qué es un ORM?](http://www.tuprogramacion.com/glosario/que-es-un-orm/)<br>
[Fuente 4 Comandos php artisan migrate](http://www.tuprogramacion.com/glosario/que-es-un-orm/)<br>

## Fuente

* [Curso](https://www.youtube.com/watch?v=XrrbV5YO2PY)