# Actividad 2.1: Ejercicios PHP sin acceso a bases de datos
## Ejercicio 1: calculadora de IVA
Crea un script que utilice una función que calcule el iva de un determinado
producto a partir de su precio base. La función debe recibir 2 parámetros: el precio base (float) y el tipo de iva a aplicar (int). Si no recibe el tipo de iva, por defecto será 21%.

## Ejercicio 2: LOGIN
Crea un script que compruebe si 2 cadenas contienen un nombre de usuario y una contraseña correctas. Debes comprobar primero que ambas cadenas no estén vacías con la función empty. A continuación, debes comprobar que el usuario y la contraseña se corresponden con un usuario y contraseñas concretas. Por ejemplo, el usuario puede ser admin y la contraseña 1234.

## Ejercicio 5: Sumatorio
Un procedimiento que reciba cinco números enteros como parámetros y muestre por pantalla el resultado de sumar los cinco números.

## Ejercicio 6: Volumen de cilindro
Una función que reciba como parámetros el valor del radio de la base y la altura de un cilindro y devuelva el volumen del cilindro, teniendo en cuenta que el volumen de un cilindro se calcula como Volumen = númeroPi * radio * radio * Altura siendo númeroPi = 3.1416 aproximadamente.

## Ejercicio 7: reverso
Elaborar una función que reciba un número entero y devuelva un número entero con los dígitos invertidos. Por ejemplo, si se introduce el número 1234 debería devolver el número 4321.

## Ejercicio 8: positivo, negativo

Diseña un formulario con un campo de texto en el que puedas escribir números. Al pulsar el botón de enviar, debe llamar a un script escrito en PHP que debe decirnos si el número enviado fue positivo, cero o negativo.

## Ejercicio 9: anagramas
Una palabra es un anagrama de otra si contiene las mismas letras colocadas en orden diferente. Por ejemplo, “CAVA” es un anagrama de “VACA”, y viceversa.

El ejercicio consiste en escribir un programa en PHP que pida dos palabras y compruebe si la primera es un anagrama de la segunda.

## Ejercicio 10: función potencia
Escribe una función PHP que reciba dos parámetros (A y B) y devuelva el valor de la potencia de A elevado a B (AB).

Escribe también un programa PHP que haga uso de esa función para calcular potencias.

## Ejercicio 11: devolución de arrays
Escribe un programa PHP que pida cinco números al usuario y los guarde en un array.

Luego debe llamar a una función pasándole el array como parámetro, y la función calculará cuál de los cinco números es el mayor, cuál el menor y cuánto vale la media, devolviendo esos tres valores en otro array.

Por último, se mostrarán en la pantalla el mayor, el menor y la media.

## Ejercicio 12: Simon dice
“Simon dice” es un clásico juego de memoria que consiste en componer secuencias de cuatro colores cada vez más largas, y el jugador tiene que recordarlas y reproducirlas. Puedes encontrar muchas versiones de Simon en internet.

Nosotros vamos a construir una versión simplificada que muestre secuencias de números (aunque podríamos hacerlo con colores sólo complicándolo un poco).

El programa mostrará un número entre 1 y 4 durante un instante, y luego borrará la pantalla y pedirá al usuario que lo repita. Después mostrará dos números aleatorios entre 1 y 4 (por ejemplo, 3 – 1), y luego el usuario los tendrá que repetir, y así hasta que el usuario falle al introducir los números.