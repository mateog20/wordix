<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ****COMPLETAR***** */


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
 * @return   
 */ 

function partidaConPalabra($jugarConPalabra){
    // string $nombrePalabraElegida, $numeroPalabraElegida
    echo"Ingrese su nombre: ";
    $nombrePalabraElegida = trim(fgets(STDIN));
    echo "Numero de la palabra elegida: ";
    $numeroPalabraElegida = trim(fgets(STDIN));

}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
/**
 * 
 * @param string $nombreUsuario
 * @param array $coleccionPalabras
 */
function palabraAleatoria($nombreUsuario, $coleccionPalabrascole){


    rand(int 0, int count($coleccionPalabrascole)): int;
}