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


## Fuente

* [Curso](https://www.youtube.com/watch?v=XrrbV5YO2PY)