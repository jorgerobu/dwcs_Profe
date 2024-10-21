# Actividad 2.2: Ejercicios PHP POO
## Ejercicio 1: Clase Básica con Getters y Setters
Crea una clase Persona con las siguientes propiedades: nombre y edad.

* Implementa el constructor para inicializar ambas propiedades.

* Crea los métodos getters y setters para acceder y modificar dichas propiedades.

 

## Ejercicio 2: Clase con Métodos de Validación
Amplía la clase Persona del ejercicio anterior.

* Agrega una validación en el setter de edad, asegurando que solo se pueda asignar un valor positivo.

* Añade un método esMayorDeEdad que devuelva true si la persona es mayor de 18 años.

 

## Ejercicio 3: Composición de Objetos
Crea una clase Direccion con las propiedades: calle, ciudad y codigoPostal.

* Modifica la clase Persona para que contenga una propiedad direccion de tipo Direccion.

* Agrega un método en Persona para mostrar la dirección completa.

 

## Ejercicio 4: Herencia: Clase Estudiante
Crea una clase Estudiante que herede de Persona.

* Agrega la propiedad grado y sus correspondientes getters y setters.

* Crea un método mostrarInformacion en Estudiante que muestre el nombre, edad y grado del estudiante.

 

## Ejercicio 5: Clase con Métodos Estáticos
Añade a la clase Estudiante un método estático llamado calcularPromedio que reciba un array de calificaciones y devuelva el promedio.

* Utiliza este método para calcular el promedio de un estudiante.

 

## Ejercicio 6: Polimorfismo
Crea una clase Profesor que herede de Persona.

* Agrega una propiedad especialidad y sus correspondientes getters y setters.

* Sobrescribe el método mostrarInformacion en Profesor para mostrar la especialidad, además del nombre y la edad.

## Ejercicio 7: Uso de Arrays en Clases
Modifica la clase Estudiante para que tenga una propiedad calificaciones (array) y un método para agregar una calificación al array.

* Crea un método que devuelva el promedio de las calificaciones usando el método estático calcularPromedio creado anteriormente.

## Ejercicio 8: Relaciones entre Objetos: Curso y Estudiantes
Crea una clase Curso que contenga un array de objetos Estudiante.

* Implementa un método para agregar estudiantes al curso.

* Añade un método mostrarEstudiantes que imprima la información de todos los estudiantes usando el método mostrarInformacion de cada estudiante.

## Ejercicio 9: Abstracción y Clases Abstractas
Crea una clase abstracta PersonaAbstracta con los métodos mostrarInformacion y esMayorDeEdad (ambos abstractos).

* Haz que las clases Estudiante y Profesor hereden de PersonaAbstracta e implementen los métodos abstractos.

## Ejercicio 10: Interfaces y Múltiples Tipos de Objetos
Crea una interfaz Identificable con el método getIdentificador.

* Implementa esta interfaz en las clases Estudiante y Profesor. El identificador en Estudiante será el número de estudiante y en Profesor será su número de empleado.

* Crea una función que reciba un array de objetos de tipo Identificable y muestre los identificadores de todos ellos.
