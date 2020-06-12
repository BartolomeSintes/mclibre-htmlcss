<?php
// 20202-06-11

include("unicode-array-0.php");
include("unicode-array-combinaciones.php");

// 2020-06-11
// FUNCIONES _V1
// Estas funciones las hice para convertir del formato que utilizaba hasta el 2020-06-11
// al formato que utilizaré a parti del 2020-06-11
// en el fichero de caracteres unicode simples (no secuencias)

function busca_v1($valor, $matriz) {
    $i = 0;
    $lon = count($matriz);
    while ($i < $lon) {
        if ($matriz[$i][0][0] == $valor) {
            return true;
        }
        $i++;
    }
    return False;
}


function convierte_matriz_caracteres_unicode_v1($matriz, $v)
{
    print "\$caracteres_unicode = [\n";
    foreach ($matriz as $c) {
        // CODIGO UNICODE
        print "  [";
        print "[\"{$c[0][0]}\"";
        for ($i = 1; $i < count($c[0]); $i++) {
            print ", \"{$c[0][$i]}\"";
        }
        print "]";

        // VERSIÓN UNICODE
        print ", \"{$c[1]}\"";

        // VARIACION
        print ", \"";
        if (busca_v1($c[0][0], $v)) {
            print "VSE\", \"VSW";
        } else {
            print "\", \"";
        }
        print "\"";

        // MOSTRAR O NO
        print ", \"SHOW-YES\"";

        // ESTA EN TWEMOJI
        print ", \"";
        if ($c[5] == "T") {
            print "TWE";
        }
        print "\"";

        // VERSIÓN TWEMOJI
        print ", \"";
        print "\"";

        // SACAR IMAGEN DEL REPOSITORIO TWEMOJI
        print ", \"";
        if ($c[6] == "TW") {
            print "TGH";
        } else {
            print "TCF";
        }
        print "\"";

        // DESCRIPCIÓN
        print ", \"{$c[7]}\"";

        print "],\n";
    }
    print "];\n";
}

// FIN FUNCIONES _V1

convierte_matriz_caracteres_unicode_v1($caracteres_unicode, $variacion);

