# Altaco

## Portada

**Descripción**

Se corresponede al inicio, donde se gestiona la librería, muestra la información de los libros que se tienen en la base de datos siguiendo un criterio de búsqueda, permite subir un libro, que al hacerlo redirecciona a confirmar subida.

**Funcionalidad**

Muestra los libros
> `PHP` Componer estructura del libro en el servidor (adaptable ajax)

Se pueden hacer busquedas por criterios (¿php o ajax?)

Al hacer click en un libro se pasa a la *Presentacion del libro*
> Enlace a otra página en la que según el id del libro indicado se carga su información

Se muestran las novedades, mas leidos y vas votados
> `PHP` Se deben obtener mediante consultas y generar los libros, como la funcion que los muestra.

**Datos devueltos desde _PHP_**

+ Portadas Libros
+ Titulos Libros
+ Autores Libros
+ Generos Libros
+ URL para leer el libro (presentacionLibro.php?id=idLibro)

## Presentación del libro

**Descripción**

Muestra los datos del libro indicando(portada, titulo, autor...), permite añadirlo a la librería, descargar el libro, además de mostrar las estadisticas de lectura, incuye un enlace para poder leer el libro y otro para borrarlo en caso de ser el propietario.

**Funcionalidad**

Añadir a la librería
> `Ajax` Enviar al servidor el libro que se quiere añadir y este lo añade a la BD

Estadisticas
> `PHP` Generar tabla html en el servidor con los datos de lectura(porcentaje de lectura, fecha de inicio...)

Descargar Libro
> `PHP` Incluir este botón en caso de que el usuario se ha logueado, devolver desde el servidor la URL del libro indicado descargandolo directamente.

**Datos devueltos desde _PHP_**

+ Portada Libro
+ Titulo Libro
+ Autor Libro
+ Sinopsis
+ Porcentaje Lectura
+ Primera lectura
+ Ultima lectura


## Lectura del libro

**Descripción**

Pantalla en la que se puede leer el contenido del libro, incluye un boton para que se pueda guardar por donde vamos y ademas se guarda el progreso cada 10 segundos.

**Funcionalidad**

Guardado
> `Ajax` Temporizador que cada 10 segundos envía el capítulo y página en la que nos encontramos del libro
> Boton que al pulsarlo envía lo mismo que el temporizador, al pulsarlo se reinicia el temporizador para evitar guardado seguido.

Menú Capitulos
> `PHP` Se genera desde php un menú con el nombre del capítulo y la URL a donde apunta.

> `JS` Paso a el capítulo siguiente, cuando se legado al final del capítulo, o cuando se va al cap anterior.

**Datos devueltos desde _PHP_**

+ Capitulos (Titulo + URL)
+ URL a imagenes
+ URL a estilos
+ Ultimo capitulo leido
+ Ultima página leida

## Confirmar lectura libro

**Descripción**

Se inicializan sus datos con los que se han leido al subir el libro, muestra a el usuario la información que ha encontrado sobre el libro, ademas de permitir editarla, si es correcta el usuario la confirma, en caso contrario tiene un boton cancelar de modo que vuelve a la portada y no se guarda nada en la BD

**Funcionalidad**

Obtener datos libro
> `PHP` En el momento que se llama a este fichero se toman los datos del libro y se muestran en los input text, textarea, img(portada), es recomendable obtener el numero de capítulos, para calcular el porcentaje de presentación del libro.

Almacenar Libro
> `PHP` Si se confirma la subida se almacenan los datos del libro subido en la BD

Cancelar
> `PHP` Si se han creado ficheros a la hora de descomprimir el libro, se eliminan, así como los datos que se encuentren en memoria, y se vuelve a inicio.

**Datos devueltos desde _PHP_**

Informacion obtenida del libro
+ Portada
+ Titulo
+ Autor
+ Sinopsis

## Mejoras

Medir tamaño del los capítulos en el servidor para poder hacer un calculo correcto del porcentaje global de lectura.

## Objetivos Primarios

+ Crear Bases de datos
+ Leer Libro
+ Almacenar Libro
+ Generar Plantilla
  + Añadir funcion adicionalJS();

## Notas

Falta el tema de la gestión de usuarios, pero veo innecesario tener que exlicarlo, lo único raro es que los usuarios van a tener que usar imagen de perfil.

