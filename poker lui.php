<?php
$palos = ['Corazones', 'Diamantes', 'Tréboles', 'Picas'];
$cartas = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'J', 'Q', 'K'];

function mezclarMazo($palos, $cartas) {
    $mazo = [];
    foreach ($palos as $palo) {
        foreach ($cartas as $carta) {
            $mazo[] = ['palo' => $palo, 'carta' => $carta];
        }
    }
    shuffle($mazo);
    return $mazo;
}

function repartirCartas($mazo, $numJugadores, $numCartas) {
    $manos =[];
    for ($i = 0; $i < $numJugadores; $i++) {
        $manos[] = array_slice($mazo, $i * $numCartas, $numCartas);  
    }
    return $manos;
}

function evaluarMano($mano) {
    $evaluar = array_column($mano, 'carta');
    $esPoker = count(array_unique($evaluar)) === 1;
    return $esPoker ? 'Poker' : 'No es poker';
}

function evaluarMano2($mano) {
    $cartasOrdenadas = array_column($mano, 'carta');
    sort($cartasOrdenadas);
    $esEscalera = true;
    for ($i = 0; $i < count($cartasOrdenadas) - 1; $i++) {
        if ($cartasOrdenadas[$i+1] !== $cartasOrdenadas[$i] + 1) {
            $esEscalera = false;
            break;
        }
    }
    return $esEscalera ? 'Escalera' : 'No es escalera';
}

function evaluarMano3($mano){
    $valores = array_column($mano, 'carta');
    $contar = array_count_values($valores);
    $repetir = array_values($contar);
    sort($repetir);
    $esFullHouse = $repetir === [2,3];
    return $esFullHouse ? 'Full House' : 'No es Full House';
}

function evaluarMano4($mano){
    $palos = array_column($mano, 'palo');
    $esColor = count(array_unique($palos)) ===1;
    return $esColor ? 'Color' : 'No es color';
}

function evaluarMano5($mano) {
    if (evaluarMano4($mano) !== 'Color') {
        return 'No es escalera real';
    }
    $valores = array_column($mano, 'carta');
    $orden = ['10', 'J', 'Q', 'K', 'A'];
    sort($valores);
    $esEscaleraReal = $valores === $orden;
    return $esEscaleraReal ? 'Escalera Real' : 'No es escalera real';
}

function evaluarMano6($mano) {
    $valores = array_column($mano, 'carta');
    $contar2 = array_count_values($valores);
    $repetir2 = array_values($contar2);
    sort($repetir2);
    $esTrio = $repetir2 === [1, 1, 3];
    return $esTrio ? 'Trío' : 'No es trío';
}

function evaluarMano7($mano) {
    $valores = array_column($mano, 'carta');
    $contar3 = array_count_values($valores);
    $repetir3 = array_values($contar3);
    sort($repetir3);
    $esDosPares = $repetir3 === [1, 2, 2];
    return $esDosPares ? 'Dos Pares' : 'No es dos pares';
}

function evaluarMano8($mano){
    $valores = array_column($mano, 'carta');
    $contar4 = array_count_values($valores);
    $repetir4 = array_values($contar4);
    sort($repetir4);
    $esPar = $repetir4 === [1,1,1,2];
    return $esPar ? 'Es par' : 'No es par';
}

function evaluarMano9($mano){
    $valores = array_column($mano, 'carta');
    $orden = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $indices = array_map(function($valor) use ($orden) {
        return array_search($valor, $orden);
    }, $valores);
    rsort($indices);
    $cartaAlta = $orden[$indices[0]];
    $esCartaAlta = true;
    if ($esCartaAlta) {
        return "Carta Alta: $cartaAlta";
    } else {
        return 'No es carta alta';
    }
}

$mazo = mezclarMazo($palos, $cartas);
$manos = repartirCartas($mazo, 2, 5);
foreach ($manos as $mano) {
    echo "Mano: \n";
    foreach ($mano as $carta) {
        echo $carta['carta'] . " de " . $carta['palo'] . "\n";
    }
    echo evaluarMano($mano) . "\n";
    echo evaluarMano2($mano) . "\n";
    echo evaluarMano3($mano) . "\n";
    echo evaluarMano4($mano) . "\n";
    echo evaluarMano5($mano) . "\n";
    echo evaluarMano6($mano) . "\n";
    echo evaluarMano7($mano) . "\n";
    echo evaluarMano8($mano) . "\n";
    echo evaluarMano9($mano) . "\n";
}