<?php
include_once("wordix.php");
/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* 
    Garcia Mateo Luciano - legajo: FAI-4226 - Tecnicatura en Desarrollo Web - mateo.garcia@est.fi.uncoma.edu.ar - Github: mateog20
    Caceres  Felipe Rapetti - Legajo: 4225 - Tecnicatura en Desarrollo Web - email: felipe.caceres@est.fi.uncoma.edu.ar - Github: feli2636
    Bonorino Ignacio - legajo: 4863 - Tecnicatura en Desarrollo Web - email: ignacio.bonorino@est.fi.uncoma.edu.ar - Github: BonorinoIgnacio

*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "PERRO", "RASGO",
        "ERROR", "PODER", "HUEVO", "TINTO", "CAMPO",
        "VERDE", "MELON", "BUSCA", "PIANO", "HIELO",
        "INDIA", "ACTOR", "NADAR", "DADOS", "BARCO"
    ];

    return ($coleccionPalabras);
}

/**
 * Resumen de la primera partida ganada
 * @param array $partida
 */
function primeraPart($partida){
    // boolean $selectora
   // $selectora=true;
    
    echo $partida["puntaje"] ;
    }
    //echo $gano;


    //$partidaElemento["puntaje"];
   
   /** 
    *  if($gano>=1 && $selectora){
    *    echo $partidaActual;
    *    $selectora= false;
    
        */


/**
 * Una funcion que solicita el nombre al jugador y comprueba que no comience con un numero
 * @return string
 */
function solicitarJugador()
{
    $NoContieneNumero = true;
    do {
        echo "Ingrese su nombre: ";
        $nombre = trim(fgets(STDIN));
        if (ctype_alpha($nombre[0])) {
            $NoContieneNumero = false;
        } else {
            echo "El nombre debe comenzar en una letra";
        }
    } while ($NoContieneNumero);
    return strtolower($nombre);
}

/**
 * Una funcion que muestra un menu de opciones
 * @return int
 */
function seleccionarOpcion($jugadorActual)
{
    // int $seleccion
    do {
        echo "\n" . "            🔺 Jugador actual: " . $jugadorActual . " 🔺";
        echo
        '   
        1) Jugar wordix con una palabra elegida
        2) Jugar wordix con una palabra aleatoria
        3) Mostrar una partida
        4) Mostrar la primera partida ganadora
        5) Mostrar resumen de Jugador  
        6) Mostrar listado de partidas ordenadas por jugador y por palabra
        7) Agregar una palabra de 5 letras a wordix
        8) Cambiar de jugador
        9) Salir
        Escriba el numero de la opción: ';
        $seleccion = trim(fgets(STDIN));
    } while ($seleccion < 1 || $seleccion > 9);
    return $seleccion;
}

/**
 * Una funcion que ejecuta una partida de wordix con la palabra elegida
 * Recibe como parametro formal una lista de palabras y otra lista de las palabras que ya fueron usadas
 * @param array $jugarConPalabra
 * @return array
 */
function elegirPalabra($listaPalabrasElegir, $palabraProhibida)
// int $indicePalabraElegida
{
    do {
        echo "Escriba el numero de la palabra que quiere usar en su partida: ";
        $indicePalabraElegida = trim(fgets(STDIN));
        /* Validamos que el dato ingresado sea un numero y que no sea mayor o menor a la longitud del arreglo
         is_numeric(dato a comprobar) es una funcion que comprueba que el dato sea un numero, devuelve true si encuentra un numero*/
        if (!is_numeric($indicePalabraElegida) || $indicePalabraElegida < 0 || $indicePalabraElegida >= count($listaPalabrasElegir)) {
            echo "Numero elegido incorrecto, ingrese uno valido \n";
            $indicePalabraElegida = -1;
            /* in_array es una funcion que nos permite buscar un elemento dentro de un array, devuelve true si encuentra una coincidencia
             En este caso es utilizada para determinar si el jugador volvio a elegir una palabra de la lista de palabras prohibidas */
        } elseif (in_array($listaPalabrasElegir[$indicePalabraElegida], $palabraProhibida)) {
            echo "La palabra que elegiste ya fue jugada, ingrese otra \n";
            $indicePalabraElegida = -1;
        }
    } while ($indicePalabraElegida == -1);
    return $listaPalabrasElegir[$indicePalabraElegida];
}
/**
 * Una funcion que ejecuta una partida de wordix con la palabra alazar
 * @param array $listaPalabras
 * @return array
 */
function palabraAlazar($listaPalabras)
{
    // int $numAleatoreo
    // string $varPalabraAlazar
    $numAleatoreo = random_int(0, count($listaPalabras) - 1);
    $varPalabraAlazar = $listaPalabras[$numAleatoreo];
    return $varPalabraAlazar;
}
/**
 * solicita al usuario una palabra de 5 letras
 * @return STRING 
 */
function leerPalabraCincoLetras()
{
    //STRING $palabra . $espacio ENTERO $cantLetras BOLEANO $tieneCinco . $noTieneEspacio
    $noTieneCinco = false;
    $tieneEspacio = false;
    $espacio = " ";
    do {
        echo "ingrese una palabra de 5 letras: ";
        $palabraNueva = trim(fgets(STDIN));
        $palabraNueva = strtoupper($palabraNueva);
        $cantLetras = strlen($palabraNueva);
        $tieneEspacio = strpos($palabraNueva, $espacio);
        if ($cantLetras <> 5) {
            $noTieneCinco = true;
        }
    } while ($noTieneCinco || $tieneEspacio);

    return  $palabraNueva;
}
function ordenarLista($primerPalabra, $segundaPalabra)
{
    /*La funcion strcmp() sirve para comparar dos cadenas de caracteres
        Si el primero es mayor al segundo, la funcion devuelve <0
        En caso inverso devuelve >0
        Y si los string que se estan comprando son iguales devuelve 0
        https://www.php.net/manual/es/function.strcmp.php
    */
    $compararPalabra = strcmp($primerPalabra["jugador"], $segundaPalabra["jugador"]);
    if ($compararPalabra == 0)
    // Caso donde el usuario es el mismo y debemos ordenar por la palabra
    {
        strcmp($primerPalabra["palabraWordix"], $segundaPalabra["palabraWordix"]);
    }

    return $compararPalabra;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*Declaración de variables:
    int $opcion
    string $palabraElegida, $nombreJugador
    array $partidaActual,$jugarWordix
*/

//Inicialización de variables:  
$selectora=true;
$nombreJugador = "";
$partidasJugadas = [];
$listaPalabrasUsadas = [];
$palabraElegida = "";
//Proceso:
$nombreJugador = solicitarJugador();
do {
    $opcion = seleccionarOpcion($nombreJugador);
    switch ($opcion) {
        case 1:
            //$listaPalabrasUsadas es el arreglo que almacena las palabras que ya fueron jugadas
            $listaPalabrasUsadas[] = $palabraElegida;
            $palabraElegida = elegirPalabra(cargarColeccionPalabras(), $listaPalabrasUsadas);
            // $partidaActual es una variable que almacena el array asociativo jugarWordix
            $partidaActual = jugarWordix($palabraElegida, $nombreJugador);
            // $partidasJugadas es un arreglo indexado, este a su vez esta guardando $partidaActual que contiene un arreglo asociativo
            $partidasJugadas[] = $partidaActual;
            break;
        case 2:
            $palabraAleat = palabraAlazar(cargarColeccionPalabras());
            $partidaActual = jugarWordix($palabraAleat, $nombreJugador);
            $partidasJugadas[] = $partidaActual;
            break;
        case 3:
            foreach ($partidasJugadas as $indicePartidas => $partidaActualElemento) {
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                    "Partida WORDIX " . $indicePartidas . ": palabra " . $partidaActualElemento["palabraWordix"] . "\n" .
                    "Jugador: " . $partidaActualElemento["jugador"] . "\n" .
                    "Puntaje: " . $partidaActualElemento["puntaje"] . "\n" .
                    "Intentos: " . $partidaActualElemento["intentos"] . "\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            }

            break;

        case 4:
            //  ERROR -------------- solo guarda la partida previa a elegir la opcion 4
               /**  POSIBLE SOLUCION----> lograr meterla en una funcion que NO retorne el resultado e invocarla
                *   en case1 y case2, y poder retornarla en el case4*/

                // ERROR ---------- $indicePartidas no inicializado?
                  $gano = $partidaActual["puntaje"];
                  if($gano>=1 && $selectora==true){
                    $guardar =" ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                    "Partida WORDIX " . $indicePartidas . ": palabra " . $partidaActual["palabraWordix"] . "\n" .
                    "Jugador: " . $partidaActual["jugador"] . "\n" .
                    "Puntaje: " . $partidaActual["puntaje"] . "\n" .
                    "Intentos: " . $partidaActual["intentos"] . "\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
                 $selectora= false; 
                }
                echo $guardar;
            break;
        case 5:
            //-----------------------
            break;
        case 6:
            /* La funcion uasort sirve para ordenar un arreglo de tipo asociativo
            Donde el programador puede usar una funcion personalizada para indicar el orden que desea en este caso ordenarLista
            Se podria decir que su syntaxis es uasort($arrayAsociativo , "$funcion de comparacion")
            c:\Users\Administrator\Desktop\ProyectoFinal
            */
            uasort($partidasJugadas, "ordenarLista");
            // print_r(Arreglo) imprime por pantalla el contenido de un arreglo
            print_r($partidasJugadas);
            break;
        case 7:
            //-----------------------
            break;
        case 8:
            $nombreJugador = solicitarJugador();
            break;
        case 9:
            echo "Saliendo....";
            break;
        default: //Esta opcion en el switch se ejecuta cuando ninguno de los case resulta verdadero
            echo "Has ingresado una opción invalida";
    }
} while ($opcion != 9);
