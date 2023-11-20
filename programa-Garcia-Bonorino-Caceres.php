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
 * @param array $partidasJugadas
 * @return array
 */
function elegirPalabra($listaPalabrasElegir, $partidasJugadas, $nombreJugador)
{
    // int $indicePalabraElegida

    do {
        echo "Puedes seleccionar entre: " . count($listaPalabrasElegir) . " palabras \n" . "Escriba el numero de la palabra que quiere usar en su partida: ";
        $indicePalabraElegida = trim(fgets(STDIN));
        if (is_numeric($indicePalabraElegida)) {
            $indicePalabraElegida = $indicePalabraElegida - 1;
            if ($indicePalabraElegida < 0 || $indicePalabraElegida >= count($listaPalabrasElegir)) {
                //ctype_digit comprueba caracteres numéricos
                echo "Numero elegido incorrecto, ingrese uno valido \n";
                $indicePalabraElegida = -1;
            } elseif (jugoLaPalabra($partidasJugadas , $nombreJugador ,$listaPalabrasElegir[$indicePalabraElegida])) {
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
function palabraAlazar($listaPalabras, $partidasJugadas ,$nombreJugador)
{
    // int $numAleatoreoIndiceAleatorio boolean $repetir
    $repetir=false;
    do{
        $numIndiceAleatorio = random_int(0, count($listaPalabras) - 1);
        if(jugoLaPalabra($partidasJugadas , $nombreJugador , $listaPalabras[$numIndiceAleatorio])){
            $repetir=true;
        }
    }while($repetir);
    //echo $listaPalabras[$numIndiceAleatorio];
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

/*function comprobarPalabra($listaUsadas, $palabra)
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
}*/
/**
 * comprueba si una palabra ya se encuentra en una lista
 * @param array $lista
 * @param string $palabra
 * @return boolean
 */
function comprobarPalabra($lista,$palabra){
    //boolean $seEncuentra int $i
    $seEncuentra=false;
    $i=0;
    do{
        if($lista[$i]==$palabra){
            $seEncuentra=true;
        }else{
            $i++;
        }
    }while($seEncuentra==false && $i<count($lista));
    return $seEncuentra;
}
/**
 * revisa si el jugador ya jugo una palabra
 * @param array $partidasJugadas
 * @param string $nombreJugador
 * @param array $palabraElegida
 * @return boolean
 */
function jugoLaPalabra($partidasJugadas , $nombreJugador , $palabraElegida){
    //boolean $palabraJugada, $mismaPalabra, $mismoNombre int $i 
    $palabraJugada=false;
    $i=0;
    do{
        if($partidasJugadas[$i]["palabraWordix"]==$palabraElegida && $partidasJugadas[$i]["jugador"]==$nombreJugador ){
            $palabraJugada=true;
        }else{
            $i++;
        }
    }while($palabraJugada==false && $i<count($partidasJugadas));
    return $palabraJugada;
}
/**
 * verifica que el jugador haya jugado todas las partidas
 * @param array $partidasJugadas
 * @param string $nombreJugador
 * @param array $listaPalabras
 * @return boolean
 */
function todasJugadas($partidasJugadas,$nombreJugador, $listaPalabras){
    //boolean $jugoTodas int $i , $cantPartidas , $cantPalabras
    $jugoTodas=false;
    $i=0;
    $cantPartidas=0;
    $cantPalabras=count($listaPalabras);
    do{
        if($partidasJugadas[$i]["jugador"]==$nombreJugador){
            $cantPartidas=$cantPartidas+1;
        }
        $i++;
    }while($i<count($partidasJugadas));
    if($cantPartidas==$cantPalabras){
        $jugoTodas=true;
    }
    return $jugoTodas;
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
/*function encontrarJugador($jugador, $partidasJugadas)
{
    //int $i
    //boolean $seEncontro
    $jugadorEncontrado =  false;
    $numPartidas = count($partidasJugadas);

    for ($i = 0; $i < $numPartidas; $i++) {
        if ($partidasJugadas[$i]['jugador'] == $jugador) {
            $jugadorEncontrado = true;
        }
    }
    if(empty($partidasJugadas)) {
        $jugadorEncontrado=false;
    }

    return $jugadorEncontrado;
}*/
/**
 * retorna si existe o no un jugador
 * @param string $jugador
 * @param array $jugadores
 * @return boolean
 */
function encontrarJugador($jugador, $jugadores){
//boolean $jugadorEncontrado int $i
$jugadorEncontrado=false;
$i=0;
do{
    if($jugadores[$i]==$jugador){
        $jugadorEncontrado=true;
    }else{
        $i++;
    }
}while(!$jugadorEncontrado && $i<count($jugadores));
return $jugadorEncontrado;

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
    $gano = 0;
    foreach ($historialPartidas as $partida) {
        if (strtolower($partida["jugador"]) == strtolower($nombreBuscar)) {


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
        $porcentajeVictorias = round((($victorias / $partidas) * 100),0);
        $resumen = [
            "partidas" => $partidas,
            "puntajeTotal" => $puntajeTotal,
            "victorias" => $victorias,
            "porcentaje" => $porcentajeVictorias,
            "intentosResumen" => $intentosRealizados,
            "nombre" => $partida["jugador"]
        ];
    }
    return $resumen;
}
/**
 * Muestra informacion sobre la partida de un jugador
 * @param array $partidasJugadas
 * @param array $resumen
 */

function mostrarPartidasJugador($partidasJugadas, $nombreResumen)
{
    // string $separador, int $j, $i, $array $partida
    $resumen = resumenJugador($partidasJugadas, $nombreResumen);

    echo
    "Partidas : " . $resumen["partidas"] . "\n" .
        "Puntaje total: " . $resumen["puntajeTotal"] . "\n" .
        "Victorias: " . $resumen["victorias"] . "\n" .
        "Porcentaje de Victorias: " . $resumen["porcentaje"] . " %" . "\n" .
        "Adivinadas: ";
    $tablaInentos = ganoEnIntento($partidasJugadas, $resumen["nombre"]);
    for ($i = 0; $i < 6; $i++) {

        echo " \n   Intento " . $i + 1 . ": " . $tablaInentos[$i];
    }
}
/**
 * muestra en que intento se ganu una partida 
 * @param array $partidasJugadas
 * @return array
 */
function ganoEnIntento($partidasJugadas, $jugador)
{
    $numIntento = " ";
    $arrayIntentos = [0, 0, 0, 0, 0, 0];

    for ($i = 0; $i < count($partidasJugadas); $i++) {
        if (strtolower($partidasJugadas[$i]["jugador"]) == strtolower($jugador)) {
            $numIntento = $partidasJugadas[$i]["intentos"];

            switch ($numIntento) {
                case 1:
                    $arrayIntentos[0] += 1;
                    break;
                case 2:
                    $arrayIntentos[1] += 1;
                    break;
                case 3:
                    $arrayIntentos[2] += 1;
                    break;
                case 4:
                    $arrayIntentos[3] += 1;
                    break;
                case 5:
                    $arrayIntentos[4] += 1;
                    break;
                case 6:
                    $arrayIntentos[5] += 1;
                    break;
            }
        }
    }

    return $arrayIntentos;
}



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
function listaJugadores($jugadores)
{
    //array $jugadoresLista
    $jugadoresLista = array_unique($jugadores); //array_column te permite extraer los valores de una columna específica en un array y array_unique elimina los elementos duplicados
    if (count($jugadores) == 0) {
        echo "no hay jugadores \n";
    } else {
        echo "Lista de jugadores: \n";
        foreach ($jugadoresLista as $elemento) {
            echo $elemento . "\n";
        }
    }
}
/**
 * Función para ordenar la lista de partidas y  que muestra el arreglo con los índices ordenados
 * @param array $partidasOrdenar
 * @return array
 */
function ordenar($partidasOrdenar)
{
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
        if (strtolower($partida["jugador"]) == strtolower($nombreJugador) && count($partida) > 1) {
            
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
$palabraNueva = "";
$partidasJugadas = cargarPartidas(); //carga una coleccion de partidas
$jugadores=array_unique(array_column($partidasJugadas, "jugador"));
//Proceso:
$nombreJugador = solicitarJugador();
$jugadores[]=$nombreJugador;
//$partidasJugadas[] = ["jugador" => $nombreJugador];
$coleccionModificable = cargarColeccionPalabras();
do {
    $opcionElegida = seleccionarOpcion();
    switch ($opcionElegida) {
        case 1:

            if(todasJugadas($partidasJugadas,$nombreJugador, $coleccionModificable)){
                echo "\n hola ". $nombreJugador. ", ya jugaste todas las palabras \n";
            }else{
                $palabraElegida = elegirPalabra($coleccionModificable, $partidasJugadas, $nombreJugador);
                $listaPalabrasUsadas[] = $palabraElegida;
                $partidaActual = jugarWordix($palabraElegida, $nombreJugador);
                $partidasJugadas[] = $partidaActual;
            }
            break;
        case 2:
            if(todasJugadas($partidasJugadas,$nombreJugador, $coleccionModificable)){
                echo "\n hola ". $nombreJugador. ", ya jugaste todas las palabras \n";
            }else{
                $palabraAleatoria = palabraAlazar($coleccionModificable, $partidasJugadas ,$nombreJugador);
                $partidaActual = jugarWordix($palabraAleatoria, $nombreJugador);
                $partidasJugadas[] = $partidaActual;
                //$coleccionModificable = eliminarElemento($coleccionModificable, $palabraAleatoria);
            }
            break;
        case 3:
            echo mostrarUnaPartida($partidasJugadas);

            break;

        case 4:
            listaJugadores($jugadores);
            $jugador = solicitarJugador();
            $existe = encontrarJugador($jugador, $jugadores);
            if ($existe == true) {
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
            } else {
                echo " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n" .
                    "\n             El Jugador no existe\n\n" .
                    " ➖➖➖➖➖➖➖➖➖🔷🔶➖➖➖➖➖➖➖➖➖" . "\n";
            }
            break;
        case 5:
            
            listaJugadores($jugadores);
            echo "¿De qué jugador quiere el resumen? Ingrese su nombre\n";
            $nombreJugadorResumen = solicitarJugador();
            $jugadorRegistrado = encontrarJugador($nombreJugadorResumen, $jugadores);
            $partidasDelJugador = buscarPartidasPorJugador($partidasJugadas, $nombreJugadorResumen);
            
            if ($jugadorRegistrado <> false) {
                if (!empty($partidasDelJugador)) {
                    echo "〰️〰️〰️〰️〰️ Resumen del jugador: " . $nombreJugadorResumen . " 〰️〰️〰️〰️〰️" . "\n";
                    mostrarPartidasJugador($partidasDelJugador, $nombreJugadorResumen);
                    echo "\n〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️〰️";
                } else {
                    echo "El jugador aún no ha jugado ninguna partida.\n";
                }
            } else {
                echo "El jugador no está registrado.\n";
            }

            break;
        case 6:
            print_r(ordenar($partidasJugadas));
            break;
        case 7:
            do {
                $palabraNueva = leerPalabra5Letras();
                if (comprobarPalabra($coleccionModificable, $palabraNueva)) {
                    echo "esta palabra ya se encuentra en la colección \n";
                }
            } while (comprobarPalabra($coleccionModificable, $palabraNueva));
            $coleccionModificable[] = $palabraNueva;
            break;
        case 8:
            //Opcion agregada para cambiar de jugador
            $nombreJugador = solicitarJugador();
            $jugadores[]=$nombreJugador;
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
NECESITAMOS VER LA FORMA DE MOSTRAR JUGADORES QUE NO HAYAN JUGADO NINGUNA PARTIDA PERO QUE ESTEN REGISTRADOS /(crear un arreglo con los nombres ?)
GRAFICAR ARREGLO QUE CUENTA LOS INTENTOS
*/