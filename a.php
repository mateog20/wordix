<?php
do {
    echo  '
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