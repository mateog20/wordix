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
 * Una funcion que carga 10 resumenes de partidas
 * @return array
 */
function cargarPartidas()
{
   
    
        $coleccion = [];
        $pa1 = ["palabraWordix" => "SUECO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
        $pa2 = ["palabraWordix" => "YUYOS", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
        $pa3 = ["palabraWordix" => "HUEVO", "jugador" => "zrack", "intentos" => 3, "puntaje" => 9];
        $pa4 = ["palabraWordix" => "TINTO", "jugador" => "cabrito", "intentos" => 4, "puntaje" => 8];
        $pa5 = ["palabraWordix" => "RASGO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
        $pa6 = ["palabraWordix" => "VERDE", "jugador" => "cabrito", "intentos" => 5, "puntaje" => 7];
        $pa7 = ["palabraWordix" => "CASAS", "jugador" => "kleiton", "intentos" => 5, "puntaje" => 7];
        $pa8 = ["palabraWordix" => "GOTAS", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
        $pa9 = ["palabraWordix" => "ZORRO", "jugador" => "zrack", "intentos" => 4, "puntaje" => 8];
        $pa10 = ["palabraWordix" => "GOTAS", "jugador" => "cabrito", "intentos" => 0, "puntaje" => 0];
        $pa11 = ["palabraWordix" => "FUEGO", "jugador" => "cabrito", "intentos" => 2, "puntaje" => 10];
        $pa12 = ["palabraWordix" => "TINTO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
        
        array_push($coleccion, $pa1, $pa2, $pa3, $pa4, $pa5, $pa6, $pa7, $pa8, $pa9, $pa10, $pa11, $pa12);
        
    
    return $coleccion;

}
/**
 * Una función que muestra un menu
 * @return int
 */
function mostrarMenu()
{
    // int $seleccion

    echo '
        1) Jugar wordix con una palabra elegida
        2) Jugar wordix con una palabra aleatoria
        3) Mostrar una partida
        4) Mostrar la primera partida ganadora
        5) Mostrar resumen de Jugador
        6) Mostrar listado de partidas ordenadas por jugador y por palabra
        7) Agregar una palabra de 5 letras a wordix
        8) Cambiar de jugador
        9) Salir
      ';
    echo "Seleccione una de las opciones: ";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

/**
 * Valida una opción.
 * @param int $opcion
 * @return boolean
 */
function validarOpcion($opcion)
{
    // boolean $esValida

    if (is_numeric($opcion)) {
        $esValida = true;
    }
    if ($opcion > 0 && $opcion < 10) {
        $esValida = true;
    } else {
        $esValida = false;
    }

    return $esValida;
}
/**
 * Obtiene una opción mostrando un menú y la valida.
 * @return int
 */
function seleccionarOpcion()
{
    // int $seleccion
    $seleccion = mostrarMenu();
    while (!validarOpcion($seleccion)) {
        echo "Opcion no valida, por favor ingrese una opcion valida" . "\n";
        $seleccion = mostrarMenu();
    }

    return $seleccion;
}

/**
 * Una funcion que solicita el nombre al jugador y comprueba que no comience con un numero
 * @return string
 */
function solicitarJugador()
{
    // BOOLEAN $NoContieneNumero
    // STRING $nombre
    $NoContieneNumero = true;
    do {
        echo "Ingrese su nombre: ";
        $nombre = trim(fgets(STDIN));
        if (ctype_alpha($nombre[0])) {
            $NoContieneNumero = false;
        } else {
            echo "El nombre debe comenzar con una letra" . "\n";
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
    // array $coleccionPalabras
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
function elegirPalabra($listaPalabrasElegir, $PalabrasUsadas){
    // int $indicePalabraElegida

    do {
        echo "Puedes seleccionar entre: " . count($listaPalabrasElegir) . " palabras \n" . "Escriba el numero de la palabra que quiere usar en su partida: ";
        $indicePalabraElegida = trim(fgets(STDIN));
        if(is_numeric($indicePalabraElegida)) {
            $indicePalabraElegida=$indicePalabraElegida-1;
            if ($indicePalabraElegida < 0 || $indicePalabraElegida >= count($listaPalabrasElegir)) {
                //ctype_digit comprueba caracteres numéricos
                echo "Numero elegido incorrecto, ingrese uno valido \n";
                $indicePalabraElegida = -1;
            } elseif (comprobarPalabra($PalabrasUsadas, $listaPalabrasElegir[$indicePalabraElegida])) {
                echo "La palabra que elegiste ya fue jugada, ingrese otra \n";
                $indicePalabraElegida = -1;
            }
        } else {
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
    // int $numAleatoreoIndiceAleatorio
    $numIndiceAleatorio = random_int(0, count($listaPalabras) - 1);
    echo $listaPalabras[$numIndiceAleatorio];
    return $listaPalabras[$numIndiceAleatorio];
}
/**
 * Elimina todos los elementos que coincidan con la palabra pasada
 * @param array  $coleccionPalabrasActuales
 * @param string $palabraEliminar
 * @return array
 */
function eliminarElemento($coleccionPalabrasActuales, $palabraEliminar)
{
    // array $listaPalabrasActualizada
    $listaPalabrasActualizada = [];
    foreach ($coleccionPalabrasActuales as $palabra) {
        if ($palabra != $palabraEliminar) {
            $listaPalabrasActualizada[] = $palabra;
        }
    }

    return $listaPalabrasActualizada;
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
    //boolean $seUso
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
 */
function mostrarUnaPartida($partidasJugadas)
{
    //int $indice $maximo $minimo
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

/**
 * retorna si existe o no un jugador
 * @param string $jugador
 * @param array $partidasJugadas
 * @return boolean
 */
function encontrarJugador ($jugador, $partidasJugadas){
    //int $i
    //boolean $seEncontro
    $i = 0;
    $seEncontro = false;
    while($i < count($partidasJugadas) && $seEncontro == false){
        if ($partidasJugadas[$i]["jugador"] == $jugador){
            $seEncontro = true;
        }
        $i++;
    }
    return $seEncontro;
}

/**
 * A partir de un jugador dado, determina cual fue su primer partida ganada
 * @param string $jugador
 * @param array $partidasJugadas
 * @return int
 */
function primeraPartidaGanada($jugador, $partidasJugadas)
{
    //int $gano . $i
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
 * Generar los datos del resumen de un jugador
 * @param array $partidasJugadas
 * @param string $nombreJugador
 * @return array
 */
function resumenJugador($historialPartidas, $nombreBuscar)
{
    /*
    array $resumen $letrasAdivinadas
    int $puntajeTotal, $jugaste, $victorias, $intentosRealizados
    float $porcentajeVictorias
     */
    $puntajeTotal = 0;
    $partidas = 0;
    $victorias = 0;
    $resumen = [];
    $intentosRealizados = 0;
    $gano=0;
    foreach ($historialPartidas as $partida) {
        if (strtolower($partida["jugador"]) == strtolower($nombreBuscar)) {
            $gano = 0; // Reiniciar la variable $gano por cada partida analizada
            
            if ($partida["puntaje"] >= 1) {
                $gano++;
            }
            
            $puntajeTotal += $partida["puntaje"];
            $partidas++;
            $intentosRealizados += $partida["intentos"];
            
            if ($gano > 0) {
                $victorias++;
            }
        }
    }
    if ($partidas > 0) {
        $porcentajeVictorias = ($victorias / $partidas) * 100;
        $resumen = [
            "partidas" => $partidas,
            "puntajeTotal" => $puntajeTotal,
            "victorias" => $victorias,
            "porcentaje" => $porcentajeVictorias,
            "intentosResumen" => $intentosRealizados,
            "adivino" => $gano
        ];
}
return $resumen;
}
/**
 * Muestra informacion sobre la partida de un jugador
 * @param array $partidasJugadas
 * @param array $resumen
 */

function mostrarPartidasJugador($partidasJugadas,$resumen,$nick){
// string $separador, int $j, $i, $array $partida


            echo
                "Partidas : " . $resumen["partidas"] . "\n" .
                "Puntaje total: " . $resumen["puntajeTotal"] . "\n" .
                "Victorias: " . $resumen["victorias"] . "\n" .
                "Porcentaje de Victorias: " . $resumen["porcentaje"] . " %" . "\n";
                
                foreach ($partidasJugadas as $partida) {
                    echo "*************************************\n";
            
                    for ($intentos = 1; $intentos <= 6; $intentos++) {
                        echo "* Intento " . $intentos . ": " . contarPalabrasAdivinadas($partidasJugadas, $nick, $partida["palabraWordix"], $intentos) . "\n";
                    }
            
                    echo "*                      *\n";
                }
            
                echo "*************************************\n";
            }
/**
 * 
 */
  

/**
 * Esta funcion compara dos elementos tipo string de un arreglo
 * @param array $primerPartida
 * @param array $segundaPartida
 * @return int
 */
function ordenarLista($primerPartida, $segundaPartida)
{
    //int $compararPalabra

    //La funcion strcmp() sirve para comparar dos cadenas de caracteres
    $compararPalabra = strcmp($primerPartida["jugador"], $segundaPartida["jugador"]);
    if ($compararPalabra == 0) // Caso donde el usuario es el mismo y debemos ordenar por la palabra
    {
        $compararPalabra = strcmp($primerPartida["palabraWordix"], $segundaPartida["palabraWordix"]);
    }
    return $compararPalabra;
}
/**
 * funcion que muestra una lista de los jugadores que tienen partidas jugadas
 * @param array $partidasJugadas
 */
function listaJugadores($partidasJugadas){
    //array $jugadores
    $jugadores = array_unique(array_column($partidasJugadas, "jugador")); //array_column te permite extraer los valores de una columna específica en un array y array_unique elimina los elementos duplicados
    if(count($jugadores)==0){
        echo "no hay jugadores con partidas jugadas \n";
    }else{
        echo "Lista de jugadores: \n";
        foreach ($jugadores as $elemento) {
            echo $elemento . "\n";
    }

}
}
/**
 * Función para ordenar la lista de partidas y  que muestra el arreglo con los índices ordenados
 * @param array $partidasOrdenar
 * @return array
 */
function ordenar($partidasOrdenar){
    uasort($partidasOrdenar, "ordenarLista");

    // Crear un nuevo array con índices numéricos
    $partidasOrdenadas = [];
    foreach ($partidasOrdenar as $partida) {
        $partidasOrdenadas[] = $partida;
    }

    return $partidasOrdenadas;
}

function contarPalabrasAdivinadas($historialPartidas, $nombreJugador, $palabra)
{
    $palabrasAdivinadas = 0;

    foreach ($historialPartidas as $partida) {
        if ($partida["jugador"] == $nombreJugador && $partida["puntaje"] >= 1 && $partida["palabraWordix"] == $palabra) {
            $palabrasAdivinadas++;
        }
    }

    return $palabrasAdivinadas;
}
function buscarPartidasPorJugador($partidasJugadas, $nombreJugador)
{
    $partidasJugador = [];

    foreach ($partidasJugadas as $partida) {
        if (strtolower($partida["jugador"]) == strtolower($nombreJugador)) {
            $partidasJugador[] = $partida;
        }
    }

    return $partidasJugador;
}
/**************************************/
/********* PROGRAMA PRINCIPAL *********/
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

$palabraNueva="";
$partidasJugadas = cargarPartidas(); //carga una coleccion de partidas
//Proceso:
$nombreJugador = solicitarJugador();
$coleccionModificable = cargarColeccionPalabras();
do {
    $opcionElegida = seleccionarOpcion();
    switch ($opcionElegida) {
        case 1:
            
                $palabraElegida = elegirPalabra($coleccionModificable, $listaPalabrasUsadas);
                $listaPalabrasUsadas[] = $palabraElegida;
                $partidaActual = jugarWordix($palabraElegida, $nombreJugador);
                $partidasJugadas[] = $partidaActual;  
                
            break;
        case 2:
            $palabraAleatoria = palabraAlazar($coleccionModificable);
            $partidaActual = jugarWordix($palabraAleatoria, $nombreJugador);
            $partidasJugadas[] = $partidaActual;
            $coleccionModificable = eliminarElemento($coleccionModificable, $palabraAleatoria);
            break;
        case 3:
            echo mostrarUnaPartida($partidasJugadas);

            break;

        case 4:
            listaJugadores($partidasJugadas);
            
            echo "Ingrese el nombre del jugador que desea ver: ";
            $jugador = trim(fgets(STDIN));
            $existe=encontrarJugador($jugador,$partidasJugadas);
           
            if($existe==true){
                 $i = primeraPartidaGanada($jugador, $partidasJugadas); // indice del arreglo donde guarda la primera partida ganada de X jugador
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
            }
            else{
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                "\n             El Jugador no existe\n\n" .
                " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            }
            break;
        case 5:
            do{
            listaJugadores($partidasJugadas);
            echo "¿De qué jugador quiere el resumen? Ingrese su nombre o escriba (s) para salir" . "\n";
            $nombreResumen = solicitarJugador();
            $partidasDelJugador = buscarPartidasPorJugador($partidasJugadas, $nombreResumen);
        
            if (!empty($partidasDelJugador)) {
                $resumenSolicitado = resumenJugador($partidasDelJugador, $nombreResumen);
                echo "〰️〰️〰️〰️〰️ Resumen del jugador: " . $nombreResumen . " 〰️〰️〰️〰️〰️" . "\n";
                mostrarPartidasJugador($partidasDelJugador, $resumenSolicitado,$nombreResumen);
            } else {
                echo "El jugador no tiene partidas registradas o el nombre ingresado es incorrecto. Intente nuevamente.\n";
            }
        } while ($nombreResumen != "s");
            break;
        case 6:
            print_r (ordenar($partidasJugadas));
            break;
        case 7:
            do{
                $palabraNueva=leerPalabra5Letras();
                if(comprobarPalabra($coleccionModificable,$palabraNueva)){
                    echo "esta palabra ya se encuentra en la colección \n";
                }
            }while(comprobarPalabra($coleccionModificable,$palabraNueva));
            $coleccionModificable[]=$palabraNueva;
            break;
        case 8:
            //Opcion agregada para cambiar de jugador
            $nombreJugador = solicitarJugador();
            break;
        case 9:
            echo "Saliendo....";
            break;
        default: //Esta opcion en el switch se ejecuta cuando ninguno de los case resulta verdadero
            echo "Has ingresado una opción invalida";
    }
} while ($opcionElegida != 9);
/*
opcion 4, indicar que no existe el jugador 
strtohigher en la palabra agregada
no eliminar las palabras de la coleccion
ELIMINAR TODO LO QUE HICIMOS LOS ULTIMOS 2 DIAS
eliminarElemento implementar recorrdio parcial y que no elimine la palabra
*/