<?php
include_once "wordix.php";
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
 * Una funcion que carga 10 partidas
 */
function cargarPartidas()
{
    $partidasCargadas = [
        ["jugador" => "Juan", "palabraWordix" => "PODER", "intentos" => "5", "puntaje" => "2"],
        ["jugador" => "Ana", "palabraWordix" => "PERRO", "intentos" => "1", "puntaje" => "6"],
        ["jugador" => "Mateo", "palabraWordix" => "TINTO", "intentos" => "2", "puntaje" => "5"],
        ["jugador" => "Nacho", "palabraWordix" => "CAMPO", "intentos" => "3", "puntaje" => "4"],
        ["jugador" => "Felipe", "palabraWordix" => "MUJER", "intentos" => "3", "puntaje" => "0"],
        ["jugador" => "Ariel", "palabraWordix" => "ERROR", "intentos" => "4", "puntaje" => "3"],
        ["jugador" => "Pedro", "palabraWordix" => "BUSCA", "intentos" => "0", "puntaje" => "0"],
        ["jugador" => "Ana", "palabraWordix" => "BARCO", "intentos" => "2", "puntaje" => "5"],
        ["jugador" => "Juan", "palabraWordix" => "HIELO", "intentos" => "0", "puntaje" => "0"],
        ["jugador" => "Maria", "palabraWordix" => "FUEGO", "intentos" => "6", "puntaje" => "1"],
    ];
    return $partidasCargadas;
}
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
        "INDIA", "ACTOR", "NADAR", "DADOS", "BARCO",
    ];

    return ($coleccionPalabras);
}

/**
 * Una funcion que permite elegir un numero dentro de los indices de un arreglo
 * @param array $jugarConPalabra
 * @param array $palabraProhibida
 * @return array
 */
function elegirPalabra($listaPalabrasElegir, $PalabrasUsadas)
{
    // int $indicePalabraElegida

    do {
        echo "Puedes seleccionar entre: " . count($listaPalabrasElegir) . " palabras \n" . "Escriba el numero de la palabra que quiere usar en su partida: ";
        $indicePalabraElegida = trim(fgets(STDIN));
        if ($indicePalabraElegida < 1 || $indicePalabraElegida >= count($listaPalabrasElegir)) {
            //ctype_digit comprueba caracteres numéricos
            echo "Numero elegido incorrecto, ingrese uno valido \n";
            $indicePalabraElegida = -1;
        } elseif (comprobarPalabra($PalabrasUsadas, $listaPalabrasElegir[$indicePalabraElegida])) {
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
 * Esta funcion comprueba si una palabra ya fue usada en una partida pasada
 * Complementa las funciones: elegirPalabra, palabraAzar
 * @param array $listaUsadas
 * @param string $palabra
 * @return boolean
 */

function comprobarPalabra($listaUsadas, $palabra)
{
    $seUso = false;
    foreach ($listaUsadas as $palabraUsada) {
        if ($palabraUsada == $palabra) {
            $seUso = true;
        } else {
            $seUso = false;
        }
    }

    return $seUso;
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
/**
 * Genera un resumen del jugador solicitado
 * @param array $listaResunen
 * @param string $nombreResumen
 * @return array
 */
function resumenJugador($partidaJugada, $nombreResumen)
{
    $puntajeTotal = 0;
    $jugaste = 0;
    $victorias = 0;
    $resumen = [];
    foreach ($partidaJugada as $partida) {
        $buscarNombre = strtolower($partida["jugador"]);
        if (strtolower($nombreResumen) == $buscarNombre) {
            $jugaste++;
            $puntajeTotal += $partida["puntaje"];
            $letraCorrecta = $partida["letra"];
            if ($partida["puntaje"] != 0) {
                $victorias++;
            }
        }
    }

    if ($jugaste > 0) {
        $porcentajeVictorias = ($victorias / $jugaste) * 100;
        $resumen = [
            "partidas" => $jugaste,
            "puntajeTotal" => $puntajeTotal,
            "victorias" => $victorias,
            "porcentaje" => $porcentajeVictorias,
            "letraAdivino" => $letraCorrecta,
        ];
    }
    return $resumen;
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
            if ($palabraNueva[$posicion] >= 'A' && $palabraNueva[$posicion] <= 'Z') { //orden lexico
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
                echo "esta palabra ya se encuentra en la listaResuemn de palabras disponibles \n";
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
$nombreJugador = "";
$partidasJugadas = []; //  es un arreglo multidimensional, contendra las partidas.
$listaPalabrasUsadas = []; //es el arreglo que almacena las palabras que ya fueron jugadas.
$palabraElegida = "";
//Proceso:
$nombreJugador = solicitarJugador();
$coleccionModificable = cargarColeccionPalabras();
do {
    $opcion = seleccionarOpcion($nombreJugador);
    switch ($opcion) {
        case 1:
            $palabraElegida = elegirPalabra($coleccionModificable, $listaPalabrasUsadas);
            $listaPalabrasUsadas[] = $palabraElegida;
            $partidaActual = jugarWordix($palabraElegida, $nombreJugador);
            $partidasJugadas[] = $partidaActual;
            print_r($partidasJugadas);

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
            echo "Ingrese el nombre del jugador que desea buscar: ";
            $jugador = trim(fgets(STDIN));
            //$jugador = $partidaActual["jugador"];
            $i = primeraPartidaGanada($jugador, $partidasJugadas);
            if ($i != -1) {
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                    "Partida WORDIX " . $i + 1 . ": palabra " . $partidasJugadas[$i]["palabraWordix"] . "\n" .
                    "Jugador: " . $partidasJugadas[$i]["jugador"] . "\n" .
                    "Puntaje: " . $partidasJugadas[$i]["puntaje"] . "\n" .
                    "Adivino la palabra en " . $partidasJugadas[$i]["intentos"] . " intento/s\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            } else {
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                    "\n       Aun no hay partidas ganadas\n\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            }
            break;
        case 5:
            do {
                //$partidasJugadas = cargarPartidas();
                echo "¿ De que jugador quiere el resumen ? , ";
                $nombreResumen = solicitarJugador();
                $resumenSolicitado = resumenJugador($partidasJugadas, $nombreResumen);
                if (empty($resumenSolicitado)) {
                    echo "El nombre del jugador no existe, ingrese uno valido" . "\n";
                }
            } while (empty($resumenSolicitado));

            echo
                " 〰️〰️〰️〰️〰️〰️〰️〰️📜〰️〰️〰️〰️〰️〰️〰️〰️" . "\n" .
                "Jugador: " . $nombreResumen . "\n" .
                "Partidas: " . $resumenSolicitado["partidas"] . "\n" .
                "Puntaje Total: " . $resumenSolicitado["puntajeTotal"] . "\n" .
                "Victorias: " . $resumenSolicitado["victorias"] . "\n" .
                "Porcentaje victorias: " . $resumenSolicitado["porcentaje"] . "%" . "\n";
            for ($i = 0; $i < $resumenSolicitado["partidas"]; $i++) {
                echo "Adivinadas: " . "\n" .
                str_repeat(" ", 5) . //repite un string
                "Intento " . ($i + 1) . ": " . $resumenSolicitado["letraAdivino"] . " , letra adivinada/s" . "\n";
            }
            echo " 〰️〰️〰️〰️〰️〰️〰️〰️📜〰️〰️〰️〰️〰️〰️〰️〰️" . "\n";

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
