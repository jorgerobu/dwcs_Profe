# Actividad 2.3: Ejercicios PHP con acceso a bases de datos
# Ejercicio 1: Login
Vamos a implementar una página de registro y otra de login. Ambas páginas deben estar enlazadas y los datos deben ser persistentes. Los datos que interesan registrar de un usuario son:

* Nombre: Campo alfanumérico, obligatorio de 60 caracteres como máximo.

* Apellido 1: Campo alfanumérico, obligatorio de 100 caracteres como máximo.

* Apellido 2: Campo alfanumérico de 100 caracteres como máximo.

* Nic de usuario: Campo alfanumérico, obligatorio de 30 caracteres como máximo. No pueden existir 2 usuarios con el mismo NIC.

* Correo electrónico: campo alfanumérico que no puede superar los 320 caracteres (RFC 3696). El correo electrónico es obligatorio y no pueden existir 2 usuarios con el mismo correo.

* Contraseña: campo alfanumérico que puede tener el tamaño que sea. Debe almacenarse el hash sha1.

# Ejercicio 2: Catálogo de videojuegos
Vamos a crear un sistema básico de gestión de videojuegos utilizando PHP para acceder a una base de datos MySQL. El sistema permitirá realizar las operaciones de alta, baja, modificación y consulta sobre una tabla de videojuegos.

Puedes partir de los ficheros base de html que están adjuntos. Tienes el esquema de la base de datos y algunos datos de prueba en el fichero videoteca.sql.

# Ejercicio 3: Ampliación I catálogo de videojuegos 
Incluye un fieldset en la página de listar videojuegos para que sea posible filtrar la búsqueda por nombre, plataforma, año y género.

# Ejercicio 4: Ampliación II catálogo de videojuegos 
Ahora haz que se pueda ordenar ascendente por cada una de las columnas de la tabla. Esto se hará pulsando en el nombre de la columna que será un enlace.