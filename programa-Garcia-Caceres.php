<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Garcia Mateo - FAI-4226 - Tecnicatura en Desarrollo Web - mateo.garcia@ - Github: mateog20*/
/* Felipe Caceres Rapetti - FAI-4225 - Tecnicatura en Desarrollo Web felipe.caceres@ - Github: feli2636*/

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
    echo"Ingrese su nombre: ";
    $nombrePalabraElegida = trim(fgets(STDIN));
    echo "Numero de la palabra elegida: ";
    $numeroPalabraElegida = trim(fgets(STDIN));
    

}
/**
 * solicitar al usuario una palabra de 5 letras
 * @param 
 * @return STRING 
 */
function leerPalabraCincoLetras(){
    //STRING $palabra . $espacio ENTERO $cantLetras BOLEANO $tieneCinco . $noTieneEspacio
    $noTieneCinco= false;
    $tieneEspacio= false;
    $espacio= " ";
    do{
        echo "ingrese una palabra de 5 letras: ";
        $palabra=trim(fgets(STDIN));
        $palabra=strtoupper($palabra);
        $cantLetras=strlen($palabra);
        $tieneEspacio=strpos($palabra,$espacio);
        if($cantLetras<>5){
            $noTieneCinco=true;
        }
    }while($noTieneCinco || $tieneEspacio);

    return $palabra;
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*Declaración de variables:
    int $opciones
*/

//Inicialización de variables:

//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
do {
    $opcion = '
    1) Jugar wordix con una palabra elegida
    2) Jugar wordix con una palabra aleatoria
    2) Mostrar una partida
    3) Mostrar la primera partida ganadora 
    5) Mostrar resumen de Jugador  
    6) Mostrar listado de partidas ordenadas por jugador y por palabra
    7) Agregar una palabra de 5 letras a wordix
    8) Salir
    ';
    $opcion = trim(fgets(STDIN));
    
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
} while ($opcion != 8);

