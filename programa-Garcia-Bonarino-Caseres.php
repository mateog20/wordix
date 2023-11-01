<?php
include_once("wordix.php");
/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Garcia Mateo - FAI-4226 - Tecnicatura en Desarrollo Web - mateo.garcia@ - Github: mateog20*/


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
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS"
        ,"NAVÍO", "MORIR", "REDES", "CINCO", "BARCO"
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */
/**
 * Una funcion que ejecuta una partida de wordix con la palabra elegida
 * Recibe como parametro formal una lista de palabras
 * @param array $jugarConPalabra
 * @return array
 */ 
function elegirPalabra($listaPalabrasElegir){
    // string $nombrePalabraElegida, $numeroPalabraElegida
    $palabrasUsadas=[];
   foreach ($listaPalabrasElegir as  $indice => $elemento){
        echo "La palabra $indice es $elemento \n";
   }
do
{
    echo "Escriba el numero de la palabra que quiere usar en su partida: ";
    $numeroPalabraElegida = trim(fgets(STDIN));
   if( $numeroPalabraElegida >= 0 && $numeroPalabraElegida < count($listaPalabrasElegir))
   {
    $nombrePalabraElegida=$listaPalabrasElegir[$numeroPalabraElegida];
    $palabrasUsadas[$numeroPalabraElegida]=$nombrePalabraElegida;
   } 
    elseif (in_array ($numeroPalabraElegida ,$palabrasUsadas) )
    {
        echo "La palabra que elegiste ya fue jugada.";
    }
    else
    {
        echo "Numero elegido incorrecto, ingrese uno valido";
    }
}while($numeroPalabraElegida < 0 || $numeroPalabraElegida >= count($listaPalabrasElegir));
    return $listaPalabrasElegir[$numeroPalabraElegida];
}

/**
 * Una funcion que ejecuta una partida de wordix con la palabra alazar
 * @param array $listaPalabras
 * @return array
 */
function palabraAlazar ($listaPalabras){
// int $numAleatoreo
// string $palabraAlazar
    $numAleatoreo = random_int(0, count($listaPalabras));
    $palabraAlazar = $listaPalabras[$numAleatoreo];
    return ($palabraAlazar);
}



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*Declaración de variables:
    int $opcion
    string $palabraElegida, $nombreJugador
    array $partida
*/

//Inicialización de variables:

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//imprimirResultado($partida);
$partidasJugadas=[];
$nombreJugador = trim(fgets(STDIN));
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
        8) Salir
        Escriba el numero de la opción: ';
    $opcion=trim(fgets(STDIN));

    switch ($opcion) {
        case 1: 
            echo "Antes de iniciar a jugar wordix indique su nombre: ";
           $palabraElegida= elegirPalabra(cargarColeccionPalabras());
           $partida = jugarWordix($palabraElegida, $nombreJugador);
            $partidasJugadas []= $partida;
            break;
        case 2: 
       

            break;
        case 3: 
            // foreach ($partidasJugadas as $indicePartidas => $partidaElemento) {
            //     echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖"."\n".
            //         "Partida WORDIX " . $indicePartidas . ": palabra " . $partidaElemento["palabraWordix"] . "\n" .
            //          "Jugador: " . $partida["jugador"] . "\n" .
            //          "Puntaje: " . $partida["puntaje"] . "\n" .
            //          "Intentos: " . $partida["intentos"] . "\n" .
            //         " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖"."\n";
           
            //   }

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
            echo "Saliendo....";
            break;
        default: //Esta opcion en el switch se ejecuta cuando ninguno de los case resulta verdadero
            echo "Has ingresado una opción invalida";
    }
} while ($opcion != 8);

