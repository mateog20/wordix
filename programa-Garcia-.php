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
        ,"NAVIO", "MORIR", "REDES", "CINCO", "BARCO"
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */
/**
 * Una funcion que ejecuta una partida de wordix con la palabra elegida
 * @param array $jugarConPalabra
 * @return array
 */ 

function partidaConPalabra($jugarConPalabra){
    // string $nombrePalabraElegida, $numeroPalabraElegida
    print_r ($jugarConPalabra);
    echo "Numero de la palabra elegida: ";
    $numeroPalabraElegida = trim(fgets(STDIN));
    

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
    int $opciones
*/

//Inicialización de variables:

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
do {
    echo
    '   1) Jugar wordix con una palabra elegida
        2) Jugar wordix con una palabra aleatoria
        2) Mostrar una partida
        3) Mostrar la primera partida ganadora
        5) Mostrar resumen de Jugador  
        6) Mostrar listado de partidas ordenadas por jugador y por palabra
        7) Agregar una palabra de 5 letras a wordix
        8) Salir
        Escriba el numero de la opcion: ';
    $opcion=trim(fgets(STDIN));
    switch ($opcion) {
        case 1: 
            echo partidaConPalabra(cargarColeccionPalabras());

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

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
    }
} while ($opcion != 8);

