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
 * Guarda los datos de la primera partida que se gano
 * @param array $partidaActual
 * @param boolean $selectora
 * @return string
 */
function primeraPartidaGanada($partidaActual)
{
                //int $gano
                //string $datosPrimeraPartida
                    $i=0;
                    $gano = -1;
                    while($i < count($partidaActual) )
                    {
                        $puntaje = $partidaActual[$i]["puntaje"];
              
                        if( $puntaje > $gano )
                        {
                            $gano = $puntaje;
                        }
                        $i++;

                        
                    }
                    return $i;

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
 * Una funcion que ejecuta una partida de wordix con la palabra elegida
 * Recibe como parametro formal una lista de palabras y otra lista de las palabras que ya fueron usadas
 * @param array $jugarConPalabra
 * @param array $palabraProhibida
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
 *  solicita al usuario una palabra de 5 letras
 * @return STRING 
 */
function leerPalabraCincoLetras(){
    // STRING $palabraNueva BOLEANO $palabraValida ENTERO $posicion
    do{
        echo "ingrese una palabra de 5 letras: ";
        $palabraNueva = trim(fgets(STDIN));
        $posicion = 0;
        $palabraValida=false;
        if(strlen($palabraNueva) == 5) {
            $palabraValida = true;
            $palabraNueva = strtoupper($palabraNueva);
        }
        while($palabraValida && $posicion < 5) {
            if($palabraNueva[$posicion]>='A' && $palabraNueva[$posicion]<='Z') {  //orden lexico
                $posicion++; 
            } else {
                $palabraValida = false;
            }
        }
    }while($palabraValida==false); 
    return $palabraNueva;
}

/**
 * Esta funcion muestra la lista de partidas jugadas ordenadas alfabéticamente por nombre o por palabra en ese orden de prioridad
 * Contiene dos parámetros de entrada, a pesar de que su parámetro actual es uno solo ya que su parámetro actual es un arreglo multidimensional
 * Donde indicamos que vamos a usar dos elementos de este, en este caso los elementos son los arreglos asociativos que contienen la información.
 * @param array $primerJugador
 * @param array $segundoJugador
 * @return int
 */
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

/**
 * muestra una partida
 * @param array $partidasJugadas
 * @return array
 */
function mostrarUnaPartida($partidasJugadas){
    //ENTERO $indice
    $maximo=count($partidasJugadas);
    $minimo=0;
    echo "que partida quiere ver? \n";
    echo solicitarNumeroEntre($minimo,$maximo);
    $indice= solicitarNumeroEntre($minimo,$maximo);
echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
    "Partida WORDIX " . $indice . ": palabra " . $partidasJugadas[$indice]["palabraWordix"] . "\n" .
    "Jugador: " . $partidasJugadas[$indice]["jugador"] . "\n" .
    "Puntaje: " . $partidasJugadas[$indice]["puntaje"] . "\n" .
    "Intentos: " . $partidasJugadas[$indice]["intentos"] . "\n" .
    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
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
            echo mostrarUnaPartida($partidasJugadas);

            break;

        case 4:
            //  ERROR -------------- solo guarda la partida previa a elegir la opcion 4
               /**  POSIBLE SOLUCION----> lograr meterla en una funcion que NO retorne el resultado e invocarla
                *   en case1 y case2, y poder retornarla en el case4*/


           echo primeraPartidaGanada($partidasJugadas);

                         
            break;
        case 5:
            //-----------------------
            break;
        case 6:
            /* La funcion uasort sirve para ordenar un arreglo de tipo asociativo
            Donde el programador puede usar una funcion personalizada para indicar el orden que desea en este caso ordenarLista
            Se podria decir que su syntaxis es uasort($arrayAsociativo , "$funcion de comparacion")
            https://www.php.net/manual/es/function.uasort.php
            */
            uasort($partidasJugadas, "ordenarLista");
            // print_r(Arreglo) imprime por pantalla el contenido de un arreglo
            print_r($partidasJugadas);
            break;
        case 7:
            cargarColeccionPalabras();
            echo $coleccionPalabras= leerPalabraCincoLetras();
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

