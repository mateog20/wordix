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
 * Una función que muestra un menu de opciones con la que el usuario puede interactuar
 * @param string $jugadorActual
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
 * Una funcion que ejecuta una partida de wordix con la palabra elegida
 * Recibe como parametro formal una lista de palabras y otra lista de las palabras que ya fueron usadas
 * @param array $jugarConPalabra
 * @param array $palabraProhibida
 * @return array
 */
function elegirPalabra($listaPalabrasElegir, $palabraProhibida)
{
    // int $indicePalabraElegida
    do {
        echo "Puedes seleccionar entre: " . count($listaPalabrasElegir) . " palabras \n" . "Escriba el numero de la palabra que quiere usar en su partida: ";
        $indicePalabraElegida = trim(fgets(STDIN));
        if (!ctype_digit($indicePalabraElegida) || $indicePalabraElegida < 1 || $indicePalabraElegida > count($listaPalabrasElegir)) {
            //ctype_digit comprueba caracteres numéricos
            echo "Numero elegido incorrecto, ingrese uno valido \n";
            $indicePalabraElegida = -1;
        } elseif (in_array($listaPalabrasElegir[$indicePalabraElegida], $palabraProhibida)) {
            echo "La palabra que elegiste ya fue jugada, ingrese otra \n";
            $indicePalabraElegida = -1;
        }
    } while ($indicePalabraElegida == -1);
    return $listaPalabrasElegir[$indicePalabraElegida - 1];
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
 * muestra una partida
 * @param array $partidasJugadas
 * @return array
 */
function mostrarUnaPartida($partidasJugadas)
{
    //ENTERO $indice
    $maximo = count($partidasJugadas);
    $minimo = 1;
    if ($maximo == 0) {
        echo "no hay partidas jugadas";
    } else {
        echo "tiene " . $maximo . " partidas \n" . "que partida quiere ver? \n";
        $indice = solicitarNumeroEntre($minimo, $maximo) - 1;
        if ($partidasJugadas[$indice]["puntaje"] == 0) {
            echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                "Partida WORDIX " . $indice + 1 . ": palabra " . $partidasJugadas[$indice]["palabraWordix"] . "\n" .
                "Jugador: " . $partidasJugadas[$indice]["jugador"] . "\n" .
                "Puntaje: " . "0" . "\n" .
                "Intentos: " . "6" . "\n" .
                "PARTIDA PERDIDA" . "\n" .
                " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
        } else {
            echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                "Partida WORDIX " . $indice + 1 . ": palabra " . $partidasJugadas[$indice]["palabraWordix"] . "\n" .
                "Jugador: " . $partidasJugadas[$indice]["jugador"] . "\n" .
                "Puntaje: " . $partidasJugadas[$indice]["puntaje"] . "\n" .
                "Intentos: " . $partidasJugadas[$indice]["intentos"] . "\n" .
                " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
        }
    }
}

function primeraPartidaGanada($jugador, $partidasJugadas)
{
    //int $gano
    //string $datosPrimeraPartida
    $i = 0;
    $gano = -1;
    while ($i < count($partidasJugadas) && $gano == -1) {


        if ($partidasJugadas[$i]["jugador"] == $jugador && $partidasJugadas[$i]["puntaje"] >= 1) {
            $gano = $i;
        }

        $i++;
    }
    return $gano;
}

function resumenJugador()
{
}

/**
 * Esta funcion compara dos elementos tipo string de un arreglo
 * @param array $primerJugador
 * @param array $segundoJugador
 * @return int
 */
function ordenarLista($primerPartida, $segundaPartida)
{
    //La funcion strcmp() sirve para comparar dos cadenas de caracteres
    $compararPalabra = strcmp($primerPartida["jugador"], $segundaPartida["jugador"]);
    if ($compararPalabra == 0) // Caso donde el usuario es el mismo y debemos ordenar por la palabra
    {
        $compararPalabra = strcmp($primerPartida["palabraWordix"], $segundaPartida["palabraWordix"]);
    }
    return $compararPalabra;
}

/**
 *  solicita al usuario una palabra de 5 letras
 * @param array $coleccionPalabras
 * @return STRING 
 */
function leerPalabraCincoLetras($coleccionPalabras)
{
    // STRING $palabraNueva BOLEANO $palabraValida . $encontrado ENTERO $posicion
    do {
        echo "ingrese una palabra de 5 letras: ";
        $palabraNueva = trim(fgets(STDIN));
        $posicion = 0;
        $palabraValida = false;
        if (strlen($palabraNueva) == 5) {
            $palabraValida = true;
            $palabraNueva = strtoupper($palabraNueva);
        }
        while ($palabraValida && $posicion < 5) {
            if ($palabraNueva[$posicion] >= 'A' && $palabraNueva[$posicion] <= 'Z') {  //orden lexico
                $posicion++;
            } else {
                $palabraValida = false;
            }
        }
        if ($palabraValida) {
            $posicion = 0;
            $encontrado = false;
            while (!$encontrado && $posicion < count($coleccionPalabras)) {
                if ($coleccionPalabras[$posicion] == $palabraNueva) {
                    $encontrado = true;
                } else {
                    $posicion++;
                }
            }
            if ($encontrado) {
                $palabraValida = false;
                echo "esta palabra ya se encuentra en la lista de palabras disponibles \n";
            }
        }
    } while ($palabraValida == false);
    return $palabraNueva;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*Declaración de variables:
     int $opcion
    string $palabraElegida, $nombreJugador, $palabraAleatoria
    array $partidaActual, $jugarWordix, $listaPalabrasUsadas, $partidasJugadas
*/

//Inicialización de variables: 
$selectora = true;
$nombreJugador = "";
$partidasJugadas = [];
$listaPalabrasUsadas = [];
$palabraElegida = "";
//Proceso:
$nombreJugador = solicitarJugador();
$coleccionModificable = cargarColeccionPalabras();
do {
    $opcion = seleccionarOpcion($nombreJugador);
    switch ($opcion) {
        case 1:
            //$listaPalabrasUsadas es el arreglo que almacena las palabras que ya fueron jugadas
            $listaPalabrasUsadas[] = $palabraElegida;
            $palabraElegida = elegirPalabra($coleccionModificable, $listaPalabrasUsadas);
            // $partidaActual es una variable que almacena el array asociativo jugarWordix
            $partidaActual = jugarWordix($palabraElegida, $nombreJugador);
            // $partidasJugadas es un arreglo indexado, este a su vez esta guardando $partidaActual que contiene un arreglo asociativo
            $partidasJugadas[] = $partidaActual;

            break;
        case 2:
            $palabraAleat = palabraAlazar($coleccionModificable);
            $partidaActual = jugarWordix($palabraAleat, $nombreJugador);
            $partidasJugadas[] = $partidaActual;

            break;
        case 3:
            echo mostrarUnaPartida($partidasJugadas);

            break;

        case 4:
            $jugador = $partidaActual["jugador"];
            $i = primeraPartidaGanada($jugador, $partidasJugadas);
            echo  " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                "Partida WORDIX " . $i + 1 . ": palabra " . $partidasJugadas[$i]["palabraWordix"] . "\n" .
                "Jugador: " . $partidasJugadas[$i]["jugador"] . "\n" .
                "Puntaje: " . $partidasJugadas[$i]["puntaje"] . "\n" .
                "Intentos: " . $partidasJugadas[$i]["intentos"] . "\n" .
                " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            break;
        case 5:
            //-----------------------
            break;
        case 6:
            // La funcion uasort sirve para ordenar un arreglo de tipo asociativo respetando su indice
            uasort($partidasJugadas, "ordenarLista");
            // print_r(Arreglo) imprime por pantalla el contenido de un arreglo
            print_r($partidasJugadas);
            break;
        case 7:
            $coleccionModificable[] = leerPalabraCincoLetras($coleccionModificable);
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
