<?php
include_once("wordix.php");
/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Garcia Mateo - FAI-4226 - Tecnicatura en Desarrollo Web - mateogarcia133@gmail.com Github: mateog20*/


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
        "VERDE", "MELON", "BUSCA", "PIANO", "HIELO", "INDIA", "ACTOR", "NADAR", "DADOS", "BARCO"
    ];

    return ($coleccionPalabras);
}
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
function seleccionarOpcion()
{
    // int $seleccion
    do {
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
 * Recibe como parametro formal una lista de palabras
 * @param array $jugarConPalabra
 * @return array
 */
function elegirPalabra($listaPalabrasElegir)
{
    // string $nombrePalabraElegida, $numeroPalabraElegida
    $palabrasUsadas = [];
    foreach ($listaPalabrasElegir as  $indice => $elemento) {
        echo "La palabra $indice es $elemento \n";
    }
    do {
        echo "Escriba el numero de la palabra que quiere usar en su partida: \n";
        $numeroPalabraElegida = trim(fgets(STDIN));
        if (in_array($numeroPalabraElegida, $palabrasUsadas)) {
            echo "La palabra que elegiste ya fue jugada \n";
        } elseif ($numeroPalabraElegida >= 0 && $numeroPalabraElegida < count($listaPalabrasElegir)) {
            $nombrePalabraElegida = $listaPalabrasElegir[$numeroPalabraElegida];
            $palabrasUsadas[$numeroPalabraElegida] = $nombrePalabraElegida;
        } else {
            echo "Numero elegido incorrecto, ingrese uno valido \n";
        }
    } while ($numeroPalabraElegida < 0 || $numeroPalabraElegida >= count($listaPalabrasElegir));
    return $listaPalabrasElegir[$numeroPalabraElegida];
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
    $numAleatoreo = random_int(0, count($listaPalabras)-1);
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

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*Declaración de variables:
    int $opcion
    string $palabraElegida, $nombreJugador
    array $partida,$jugarWordix
*/

//Inicialización de variables:
$nombreJugador = "";
$partidasJugadas = [];
$palabrasUsadas=[];
$palabraElegida="";
//Proceso:
$nombreJugador = solicitarJugador();
do {
    $opcion = seleccionarOpcion();
    $palabrasUsadas[]=$palabraElegida;
    switch ($opcion) {
        case 1:
            $palabraElegida = elegirPalabra(cargarColeccionPalabras(), $palabrasUsadas);
            $partida = jugarWordix($palabraElegida, $nombreJugador);
            $partidasJugadas[] = $partida;
            break;
        case 2:
            $palabraAleat = palabraAlazar(cargarColeccionPalabras());
            $partida = jugarWordix($palabraAleat, $nombreJugador);
            $partidasJugadas[] = $partida;
           // $partidasJugadas[] = $solicitarJugador();
            break;
        case 3:
            foreach ($partidasJugadas as $indicePartidas => $partidaElemento) {
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖"."\n".
                    "Partida WORDIX " . $indicePartidas . ": palabra " . $partidaElemento["palabraWordix"] . "\n" .
                     "Jugador: " . $partidaElemento["jugador"] . "\n" .
                     "Puntaje: " . $partidaElemento["puntaje"] . "\n" .
                     "Intentos: " . $partidaElemento ["intentos"] . "\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖"."\n";
              }

            break;

        case 4:
            //-----------------------
            break;
        case 5:
            //-----------------------
            break;
        case 6:
            //-----------------------
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
  