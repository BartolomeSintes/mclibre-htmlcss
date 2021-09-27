<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Genera fichas Pictogramas. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../varios/htmlcss.css" title="Color">
    <link rel="icon" href="../varios/favicon.svg">
    <script src="https://twemoji.maxcdn.com/v/latest/twemoji.min.js" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: "Symbola";
            src: url("unicode/Symbola.otf");
        }

        @font-face {
            font-family: "Twemoji";
            src: url("unicode/TwitterColorEmoji-SVGinOT.ttf");
        }

        div.u-l {
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
        }

        div.u {
            display: flex;
            flex-direction: column;
            flex: 0 1 210px;
            margin: 5px;
            border: black 1px solid;
            text-align: center;
        }

        div.u2 {
            display: flex;
            flex-direction: column;
            flex: 0 1 280px;
            margin: 5px;
            border: black 1px solid;
            text-align: center;
        }

        div.u p:nth-child(odd), div.u2 p:nth-child(odd)  {
            background-color: #eee;
        }

        div.u p, div.u2 p  {
            margin: 0;
            padding: 5px 10px;
        }

        div.u p.uc, div.u2 p.uc {
            font-weight: bold;
        }

        div.u p.si, div.u2 p.si {
            font-family: sans-serif;
            font-size: 80px;
            line-height: 100px;
            text-align: center;
        }

        div.u span.ss, div.u2 span.ss {
            font-family: sans-serif;
            padding-right: 20px;
        }

        p.si span:not(:last-child)  { border-right: 2px solid black;}

        div.u span.sy, div.u2 span.sy {
            font-family: "Symbola";
        }

        div.u span.te, div.u2 span.te {
            font-family: "Twemoji";
            font-size: 90px;
        }

        div.u .twe, div.u2 .twe {
            height: 90px;
            vertical-align: text-bottom;
        }

        div.u p.en, div.u2 p.en {}

        div.u p.no, div.u2 p.no {
            flex: 1 0 auto;
            text-transform: uppercase;
        }

        div.u a, div.u2 a {
            border: none;
            text-decoration: none;
            color: black;
        }

        table.u {
            border-spacing: 20px 0;
            border-collapse: collapse;
        }

        table.u colgroup {
            border-right: black 1px solid;
            border-left: black 1px solid;
        }

        table.u tr.fila-estrecha {
            height: auto;
            border-bottom: black 1px solid;
        }

        table.u tr { height: 90px; }

        table.u .ss {
            font-family: sans-serif;
            font-size: 80px;
        }

        table.u .te {
            font-family: "Twemoji";
            font-size: 80px;
        }

        table.u .twe {
            font-size: 80px;
        }

        table.u a {
            border: none;
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
<?php
// 1 de septiembre de 2018
include("unicode-array.php");
include("unicode-array-combinaciones.php");

// CAMPOS
define("UCO", 0);   // Código(s) Unicode
define("UNV", 1);   // Versión Unicode en que se incluyó
define("VS", 2);   // Si el código tiene versión emoji / texto: VST / VSE
define("WIN", 3);   // Si se ve en windows: VACIO / WIN
define("VSW", 4);   // Si Windows distingue entre emoji / texto: VACIO / VSW
define("SHO", 5);   // Si se enseña o no
define("TWE", 6);   // Si está en Twemoji
define("TWV", 7);   // En qué versión se incluyó en Twemoji
define("TWO", 8);   // Si está en la fuente Twemoji Color Font o en GitHub: TCF / TGH
define("DESC", 9);   // Descripción
define("PAG_SIMBOLOS", "Símbolos");
define("PAG_EMOJIS", "Emojis");
// $rutaSVG = "https://github.com/emojione/emojione/blob/2.2.7/assets/svg";
// $rutaSVG = "https://github.com/twitter/twemoji/blob/gh-pages/2/svg"; // cambiado en 2019-10-27
define("RUTAS_SVG", "https://github.com/twitter/twemoji/blob/master/assets/svg");

// genera_enlace_tg($c)
// * le llegan sólo los códigos unicode para poder enlazar al repositorio de Twemoji
// * no analiza nada, lo que le llega lo pone en el enlace
//
// genera_caracter($c, $fuente)
// * le llegan los códigos unicode y la fuente en que debe verse la entidad numérica
// * sólo analiza qué fuente se ha pedido para poner la clase corespondiente en el span y en su caso, el enlace al repositorio de Twemoji
//
// funcion genera_ficha($simbolos)
// * le llegan una matriz de parejas [$c, $fuente]
// * no analiza nada, sólo crea la ficha. El texto lo saca de la primera pareja $simbolos[0]
//
// funcion genera_fichas($c, $fuentes)
// * le llegan los caracteres unicode y una matriz de fuentes
// * tiene que analizar

function aVer($dato)
{
    if (gettype($dato)=="array") {
        print "\n<pre>";
        print_r($dato);
        print "</pre>\n";
    } else {
        print "\n<span style=\"red\">*** $dato ***</span>\n";
    }
}

function genera_enlace_tgh($c)
{
    $resp = "<a href=\"" . RUTAS_SVG. "/";
    for ($i = 0; $i < count($c) - 1; $i++) {
        $tmp0 = strtolower($c[$i]);
        while ($tmp0[0] == "0") {
            $tmp0 = substr($tmp0, 1);
        }
        $resp .= "$tmp0-";
    }
    $tmp0 = strtolower($c[$i]);
    while ($tmp0[0] == "0") {
        $tmp0 = substr($tmp0, 1);
    }
    $resp .= "$tmp0";
    $resp .= ".svg\">";
    return $resp;
}

function genera_caracter($c, $fuente)
{
    // $fuente puede ser vacío, SS, TCF, TGH, SYM,
    $span = $enlace = false;
    if ($fuente == "SS") {
        $resp = "\n          <span class=\"ss\">";
        $span = true;
    } elseif ($fuente == "SYM") {
        $resp = "\n          <span class=\"sy\">";
        $span = true;
    } elseif ($fuente == "TGH") {
        $resp = "\n          <span class=\"twe\">";
        if ($c[TWE] != "") {
            $resp .= genera_enlace_tgh($c[UCO]);
            $enlace = true;
        }
        $span = true;
    } elseif ($fuente == "TCF") {
        $resp = "\n          <span class=\"te\">";
        if ($c[TWE] != "") {
            $resp .= genera_enlace_tgh($c[UCO]);
            $enlace = true;
        }
        $span = true;
    } else {
        aVer("Error: Sin fuente en genera_caracter()");
    }
    foreach ($c[UCO] as $tmp) {
        $resp .= "&#x" . strtoupper(dechex(hexdec($tmp))) . ";";
    }
    if ($enlace) {
        $resp .= "</a>";
    }
    if ($span) {
        $resp .= "</span>\n";
    }
    return $resp;
}

function genera_ficha($simbolos)
{
    // $simbolos es una matriz de parejas [$c, $fuente]
    // $c ya incluye VS o Fitzpatrick
    // $fuente puede ser SS, TCF, TGH, SYM,
    if (count($simbolos) == 1) {
        print "      <div class=\"u\">\n";
    } else {
        print "      <div class=\"u2\">\n";
    }
    print "        <p class=\"uc\">";
    // Código Unicode
    foreach ($simbolos[0][0][UCO] as $tmp) {
        print "U+" . strtoupper(dechex(hexdec($tmp))) . " ";
    }
    print "</p>\n";
    // Dibujo(s)
    print "        <p class=\"si\">";
    if (count($simbolos) == 1 && $simbolos[0][1] == "SS") {
        $simbolos[0][1] == "";
    }
    foreach ($simbolos as $simbolo) {
        $c = $simbolo[0];
        $f = $simbolo[1];
        print genera_caracter($c, $f);
    }
    print "        </p>\n";
    // Entidad numérica hexadecimal
    print "        <p class=\"en\">Hex: <strong>";
    foreach ($simbolos[0][0][UCO] as $tmp) {
        print "&amp;#x" . dechex(hexdec($tmp)) . ";";
    }
    print "</strong></p>\n";
    // Entidad numérica adecimal
    print "        <p class=\"en\">Dec: <strong>";
    foreach ($simbolos[0][0][UCO] as $tmp) {
        print "&amp;#" . hexdec($tmp) . ";";
    }
    print "</strong></p>\n";
    // Descripción
    print "        <p class=\"no\">{$c[DESC]}</p>\n";
    print "      </div>\n";
    print "\n";
}

function prepara_ficha($c, $fuentes, $pagina)
{
    // $simbolos es una matriz de [$c, $vs, $fp, $fuente]
    // $c es el código Unicode con toda la información
    // $vste es qué se hace con VS: Vacío / VSE / VST
    // $fp es qué hace con FP: Vacío / pone uno en concreto o pone todos
    // $fuente puede ser SS, SYM, TGH, TCF o mixto SS-TCF-TGH-SYM, SS-TGH, SS-SYM, SS-TGH-
    $datos = [];
    foreach ($fuentes as $fuente) {
        $tmp = [];
        if ($fuente == "") {
            print "<h1>Error: No se ha indicado fuente en genera_fichas()</h1>\n";
        } elseif ($fuente == "SS") {
            $tmp = [$c, "SS"];
        } elseif ($fuente == "SS-VST") {
            $c2 = $c;
            if ($c2[VS] == "VSE") {
                $c2[UCO][] = "FE0E";
            }
            $tmp = [$c2, "SS"];
        } elseif ($fuente == "SS-VSE") {
            $c2 = $c;
            // Este if es para el caso especial de las keycap sequences en las que FE0F va en segundo lugar
            // tendré que cambiarlo cuando llegue a las secuencias seguro
            if (count($c2[UCO]) == 2 && $c2[UCO][1] == "0020E3") {
                $c2[UCO] = [$c2[UCO][0], "FE0F", $c2[UCO][1]];
            } elseif ($c2[VS] == "VST") {
                $c2[UCO][] = "FE0F";
            }
            $tmp = [$c2, "SS"];
        } elseif ($fuente == "TGH") {
            $tmp = [$c, "TGH"];
        } elseif ($fuente == "TCF") {
            $tmp = [$c, "TCF"];
        } elseif ($fuente == "SYM") {
            $tmp = [$c, "SYM"];
        } elseif ($fuente == "TCF-TGH") {
            if ($c[TWO] == "TCF") {
                $tmp = [$c, "TCF"];
            } elseif ($c[TWO] == "TGH") {
                $tmp = [$c, "TGH"];
            }
        }
        if ($pagina == PAG_SIMBOLOS) {
            if ($fuente == "SYM" && $c[WIN] != "") {
            } else {
                $datos[] = $tmp;
            }
        } elseif ($pagina == PAG_EMOJIS) {
            if ($fuente == "SS-VSE") {
                $datos[] = $tmp;
            } elseif ($fuente == "TCF-TGH" && $c[TWE] != "") {
                $datos[] = $tmp;
            }
        };
    }
    genera_ficha($datos);
    // if ($segundo == "TGH" || $c[WIN] == "" && $c[TWO] == "TGH" && $c[VS] != "VST") {
    //     print genera_caracter($c[UCO], "TGH");
    // } elseif ($segundo == "TCF"  || $segundo = "" && $c[WIN] == "" && $c[TWO] == "TCF" && $c[VS] != "VST") {
    //     print genera_caracter($c[UCO], "TCF");
}

function genera_grupo($matriz, $grupo, $id, $pdf, $cuenta, $inicial, $final, $fuentes, $pagina)
{
    global $muestra;
    if ($cuenta) {
        $contador = count($matriz);
    }

    if (!$cuenta || $cuenta && $contador > 0) {
        print "  <section id=\"$id\">\n";
        print "    <h2>$grupo</h2>\n";
        print "\n";

        if ($cuenta) {
            if ($contador == 1) {
                print "    <p>Se muestra aquí $contador carácter ";
            } else {
                print "    <p>Se muestran aquí $contador caracteres ";
            }
            print "Unicode del grupo que se extiende desde el carácter U+$inicial hasta el carácter U+$final. Puede descargar la <a href=\"unicode/$pdf\">tabla de códigos de caracteres Unicode 13.0</a> en formato PDF.</p>\n";
            print "\n";
        }

        print "    <div class=\"u-l\">\n";
        foreach ($matriz as $c) {
            prepara_ficha($c, $fuentes, $pagina);
        }
        print "    </div>\n";
        print "  </section>\n";
        print "\n";
    }
}

function genera_grupos($pagina, $fuentes)
{
    global $grupos;
    print "  <ul>\n";
    foreach ($grupos[$pagina] as $g) {
        print "    <li><a href=\"#$g[2]\">$g[1]</a></li>\n";
    }
    print "  </ul>\n";
    print "\n";

    foreach ($grupos[$pagina] as $g) {
        genera_grupo($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $fuentes, $pagina);
    }
}

// foreach ($caracteres_unicode as $c) {
//     // foreach ($caracteres_unicode_seleccion as $c) {
//         print "<div class=\"u-l\">\n";
//         prepara_ficha($c, ["SS-VST"]);
//         prepara_ficha($c, ["SS-VSE"]);
//         prepara_ficha($c, ["TGH"]);
//         print "</div>\n";
//     }

function filtra_grupo($caracteres, $inicial, $final, $pagina){
    $resultado = [];
    foreach ($caracteres as $c) {
        if (hexdec($c[UCO][0]) >= hexdec($inicial) && hexdec($c[UCO][0]) <= hexdec($final)) {
            $resultado[] = $c;
        }
    }
    $resultado2 = [];
    foreach ($resultado as $c) {
        // Esto filtra los caracteres que simplemente no quiero ver en ningún caso
        if ($pagina == PAG_SIMBOLOS) {
            if ($c[VS] != "" || $c[TWE] == "") {
                $resultado2[] = $c;
            }
        } elseif ($pagina == PAG_EMOJIS) {
            if ($c[VS] != "" || $c[TWE] == "TWE") {
                $resultado2[] = $c;
            }
        }
    }
    return $resultado2;
}

$grupos = [
    PAG_SIMBOLOS => [
        [filtra_grupo($caracteres_unicode,  "0000",  "007F", PAG_SIMBOLOS), "Controles y Latin básico",                          "controles-latin",         "U00000-c0-controls-and-basic-latin.pdf",           1, "0000",  "007F" ],
        [filtra_grupo($caracteres_unicode,  "0080",  "00FF", PAG_SIMBOLOS), "Suplemento controles y Latin-1",                    "controles-sup",           "U00080-c1-controls-and-latin-1-supplement.pdf",    1, "0080",  "00FF" ],
        [filtra_grupo($caracteres_unicode,  "2000",  "206F", PAG_SIMBOLOS), "Puntuación",                                        "puntuacion",              "U02000-general-punctuation.pdf",                   1, "2000",  "206F" ],
        [filtra_grupo($caracteres_unicode,  "20A0",  "20C0", PAG_SIMBOLOS), "Símbolos de monedas",                               "monedas",                 "U020A0-currency-symbols.pdf",                      1, "20A0",  "20C0" ],
        [filtra_grupo($caracteres_unicode,  "2100",  "214F", PAG_SIMBOLOS), "Símbolos con letras",                               "simbolos-letras",         "U02100-letterlike-symbols.pdf",                    1, "2100",  "214F" ],
        [filtra_grupo($caracteres_unicode,  "2190",  "21FF", PAG_SIMBOLOS), "Flechas",                                           "flechas",                 "U02190-arrows.pdf",                                1, "2190",  "21FF" ],
        [filtra_grupo($caracteres_unicode,  "2300",  "23FE", PAG_SIMBOLOS), "Símbolos técnicos misceláneos",                     "tecnicos-misc",           "U02300-miscellaneous-technical.pdf",               1, "2300",  "23FE" ],
        [filtra_grupo($caracteres_unicode,  "2460",  "24FF", PAG_SIMBOLOS), "Símbolos alfanuméricos con círculo alrededor",      "alfanum-circulo",         "U02460-enclosed-alphanumerics.pdf",                1, "2460",  "24FF" ],
        [filtra_grupo($caracteres_unicode,  "2500",  "257F", PAG_SIMBOLOS), "Cajas",                                             "cajas",                   "U02500-box-drawing.pdf",                           1, "2500",  "257F" ],
        [filtra_grupo($caracteres_unicode,  "25A0",  "25FF", PAG_SIMBOLOS), "Formas geométricas",                                "formas-geometricas",      "U025A0-geometric-shapes.pdf",                      1, "25A0",  "25FF" ],
        [filtra_grupo($caracteres_unicode,  "2600",  "26FF", PAG_SIMBOLOS), "Símbolos misceláneos",                              "simbolos-misc",           "U02600-miscellaneous-symbols.pdf",                 1, "2600",  "26FF" ],
        [filtra_grupo($caracteres_unicode,  "2700",  "27BF", PAG_SIMBOLOS), "Dingbats",                                          "dingbats",                "U02700-dingbats.pdf",                              1, "2700",  "27BF" ],
        [filtra_grupo($caracteres_unicode,  "2900",  "297F", PAG_SIMBOLOS), "Flechas suplementarias B",                          "flechas-suplementarias",  "U02900-supplemental-arrows-b.pdf",                 1, "2900",  "297F" ],
        [filtra_grupo($caracteres_unicode,  "2B00",  "2BFF", PAG_SIMBOLOS), "Símbolos y flechas misceláneos",                    "simbolos-flechas",        "U02B00-miscellaneous-symbols-and-arrows.pdf",      1, "2B00",  "2BFF" ],
        [filtra_grupo($caracteres_unicode,  "3000",  "303F", PAG_SIMBOLOS), "Símbolos y puntuación CJK",                         "cjk",                     "U03000-cjk-symbols-and-punctuation.pdf",           1, "3000",  "303F" ],
        [filtra_grupo($caracteres_unicode,  "3200",  "32FF", PAG_SIMBOLOS), "Símbolos CJK con círculo alrededor",                "cjk-circulo",             "U03200-enclosed-cjk-letters-and-months.pdf",       1, "3200",  "32FF" ],
        [filtra_grupo($caracteres_unicode, "1D100", "1D1EA", PAG_SIMBOLOS), "Símbolos musicales",                                "musica",                  "U1D100-musical-symbols.pdf",                       1, "1D100", "1D1EA"],
        [filtra_grupo($caracteres_unicode, "1F000", "1F02B", PAG_SIMBOLOS), "Fichas de Mahjong",                                 "fichas-mahjong",          "U1F000-mahjong-tiles.pdf",                         1, "1F000", "1F02B"],
        [filtra_grupo($caracteres_unicode, "1F030", "1F093", PAG_SIMBOLOS), "Fichas de dominó",                                  "domino",                  "U1F030-domino-tiles.pdf",                          1, "1F030", "1F093"],
        [filtra_grupo($caracteres_unicode, "1F0A0", "1F0F5", PAG_SIMBOLOS), "Cartas",                                            "cartas",                  "U1F0A0-playing-cards.pdf",                         1, "1F0A0", "1F0F5"],
        [filtra_grupo($caracteres_unicode, "1F100", "1F1FF", PAG_SIMBOLOS), "Suplemento alfanuméricos con círculo alrededor",    "alfanum-circulo-sup",     "U1F100-enclosed-alphanumeric-supplement.pdf",      1, "1F100", "1F1FF"],
        [filtra_grupo($caracteres_unicode, "1F200", "1F2FF", PAG_SIMBOLOS), "Suplemento ideográfico con círculo alrededor",      "ideografico-circulo-sup", "U1F200-enclosed-ideographic-supplement.pdf",       1, "1F200", "1F2FF"],
        [filtra_grupo($caracteres_unicode, "1F650", "1F67F", PAG_SIMBOLOS), "Dingbats decorativos",                              "dingbats-decorativos",    "U1F650-ornamental-dingbats.pdf",                   1, "1F650", "1F67F"],
        [filtra_grupo($caracteres_unicode, "1F700", "1F773", PAG_SIMBOLOS), "Símbolos alquímicos",                               "simbolos-alquimicos",     "U1F700-alchemical-symbols.pdf",                    1, "1F700", "1F773"],
        [filtra_grupo($caracteres_unicode, "1F780", "1F7F0", PAG_SIMBOLOS), "Formas geométricas extendidas",                     "geometricas-extendidas",  "U1F780-geometric-shapes-extended.pdf",             1, "1F780", "1F7F0"],
        [filtra_grupo($caracteres_unicode, "1F300", "1F5FF", PAG_SIMBOLOS), "Símbolos y pictogramas misceláneos",                "simbolos-pict-misc",      "U1F300-miscellaneous-symbols-and-pictographs.pdf", 1, "1F300", "1F5FF"],
        [filtra_grupo($caracteres_unicode, "1F600", "1F64F", PAG_SIMBOLOS), "Emoticonos",                                        "emoticonos",              "U1F600-emoticons.pdf",                             1, "1F600", "1F64F"],
        [filtra_grupo($caracteres_unicode, "1F680", "1F6FF", PAG_SIMBOLOS), "Símbolos de transporte y mapas",                    "transporte",              "U1F680-transport-and-map-symbols.pdf",             1, "1F680", "1F6FF"],
        [filtra_grupo($caracteres_unicode, "1F900", "1F9FF", PAG_SIMBOLOS), "Símbolos y pictogramas misceláneos suplementarios", "simbolos-misc-supl",      "U1F900-supplemental-symbols-and-pictographs.pdf",  1, "1F900", "1F9FF"],
        [filtra_grupo($caracteres_unicode, "1FA00", "1FA6D", PAG_SIMBOLOS), "Símbolos ajedrecísticos",                           "simbolos-ajedrez",        "U1FA00-chess-symbols.pdf",                         1, "1FA00", "1FA6D"],
        [filtra_grupo($caracteres_unicode, "1FA70", "1FAFF", PAG_SIMBOLOS), "Símbolos y pictogramas extendidos A",               "simbolos-ext-a",          "U1FA70-symbols-and-pictographs-extended-a.pdf",    1, "1FA70", "1FAFF"],
    ],

    PAG_EMOJIS => [
        [filtra_grupo($caracteres_unicode,  "0000",  "007F", PAG_EMOJIS), "Controles y Latin básico",                          "controles-latin",         "U00000-c0-controls-and-basic-latin.pdf",           1, "0000",  "007F" ],
        [filtra_grupo($caracteres_unicode,  "0080",  "00FF", PAG_EMOJIS), "Suplemento controles y Latin-1",                    "controles-sup",           "U00080-c1-controls-and-latin-1-supplement.pdf",    1, "0080",  "00FF" ],
        [filtra_grupo($caracteres_unicode,  "2000",  "206F", PAG_EMOJIS), "Puntuación",                                        "puntuacion",              "U02000-general-punctuation.pdf",                   1, "2000",  "206F" ],
        [filtra_grupo($caracteres_unicode,  "20A0",  "20C0", PAG_EMOJIS), "Símbolos de monedas",                               "monedas",                 "U020A0-currency-symbols.pdf",                      1, "20A0",  "20C0" ],
        [filtra_grupo($caracteres_unicode,  "2100",  "214F", PAG_EMOJIS), "Símbolos con letras",                               "simbolos-letras",         "U02100-letterlike-symbols.pdf",                    1, "2100",  "214F" ],
        [filtra_grupo($caracteres_unicode,  "2190",  "21FF", PAG_EMOJIS), "Flechas",                                           "flechas",                 "U02190-arrows.pdf",                                1, "2190",  "21FF" ],
        [filtra_grupo($caracteres_unicode,  "2300",  "23FE", PAG_EMOJIS), "Símbolos técnicos misceláneos",                     "tecnicos-misc",           "U02300-miscellaneous-technical.pdf",               1, "2300",  "23FE" ],
        [filtra_grupo($caracteres_unicode,  "2460",  "24FF", PAG_EMOJIS), "Símbolos alfanuméricos con círculo alrededor",      "alfanum-circulo",         "U02460-enclosed-alphanumerics.pdf",                1, "2460",  "24FF" ],
        [filtra_grupo($caracteres_unicode,  "2500",  "257F", PAG_EMOJIS), "Cajas",                                             "cajas",                   "U02500-box-drawing.pdf",                           1, "2500",  "257F" ],
        [filtra_grupo($caracteres_unicode,  "25A0",  "25FF", PAG_EMOJIS), "Formas geométricas",                                "formas-geometricas",      "U025A0-geometric-shapes.pdf",                      1, "25A0",  "25FF" ],
        [filtra_grupo($caracteres_unicode,  "2600",  "26FF", PAG_EMOJIS), "Símbolos misceláneos",                              "simbolos-misc",           "U02600-miscellaneous-symbols.pdf",                 1, "2600",  "26FF" ],
        [filtra_grupo($caracteres_unicode,  "2700",  "27BF", PAG_EMOJIS), "Dingbats",                                          "dingbats",                "U02700-dingbats.pdf",                              1, "2700",  "27BF" ],
        [filtra_grupo($caracteres_unicode,  "2900",  "297F", PAG_EMOJIS), "Flechas suplementarias B",                          "flechas-suplementarias",  "U02900-supplemental-arrows-b.pdf",                 1, "2900",  "297F" ],
        [filtra_grupo($caracteres_unicode,  "2B00",  "2BFF", PAG_EMOJIS), "Símbolos y flechas misceláneos",                    "simbolos-flechas",        "U02B00-miscellaneous-symbols-and-arrows.pdf",      1, "2B00",  "2BFF" ],
        [filtra_grupo($caracteres_unicode,  "3000",  "303F", PAG_EMOJIS), "Símbolos y puntuación CJK",                         "cjk",                     "U03000-cjk-symbols-and-punctuation.pdf",           1, "3000",  "303F" ],
        [filtra_grupo($caracteres_unicode,  "3200",  "32FF", PAG_EMOJIS), "Símbolos CJK con círculo alrededor",                "cjk-circulo",             "U03200-enclosed-cjk-letters-and-months.pdf",       1, "3200",  "32FF" ],
        [filtra_grupo($caracteres_unicode, "1D100", "1D1EA", PAG_EMOJIS), "Símbolos musicales",                                "musica",                  "U1D100-musical-symbols.pdf",                       1, "1D100", "1D1EA"],
        [filtra_grupo($caracteres_unicode, "1F000", "1F02B", PAG_EMOJIS), "Fichas de Mahjong",                                 "fichas-mahjong",          "U1F000-mahjong-tiles.pdf",                         1, "1F000", "1F02B"],
        [filtra_grupo($caracteres_unicode, "1F030", "1F093", PAG_EMOJIS), "Fichas de dominó",                                  "domino",                  "U1F030-domino-tiles.pdf",                          1, "1F030", "1F093"],
        [filtra_grupo($caracteres_unicode, "1F0A0", "1F0F5", PAG_EMOJIS), "Cartas",                                            "cartas",                  "U1F0A0-playing-cards.pdf",                         1, "1F0A0", "1F0F5"],
        [filtra_grupo($caracteres_unicode, "1F100", "1F1FF", PAG_EMOJIS), "Suplemento alfanuméricos con círculo alrededor",    "alfanum-circulo-sup",     "U1F100-enclosed-alphanumeric-supplement.pdf",      1, "1F100", "1F1FF"],
        [filtra_grupo($caracteres_unicode, "1F200", "1F2FF", PAG_EMOJIS), "Suplemento ideográfico con círculo alrededor",      "ideografico-circulo-sup", "U1F200-enclosed-ideographic-supplement.pdf",       1, "1F200", "1F2FF"],
        [filtra_grupo($caracteres_unicode, "1F650", "1F67F", PAG_EMOJIS), "Dingbats decorativos",                              "dingbats-decorativos",    "U1F650-ornamental-dingbats.pdf",                   1, "1F650", "1F67F"],
        [filtra_grupo($caracteres_unicode, "1F700", "1F773", PAG_EMOJIS), "Símbolos alquímicos",                               "simbolos-alquimicos",     "U1F700-alchemical-symbols.pdf",                    1, "1F700", "1F773"],
        [filtra_grupo($caracteres_unicode, "1F780", "1F7F0", PAG_EMOJIS), "Formas geométricas extendidas",                     "geometricas-extendidas",  "U1F780-geometric-shapes-extended.pdf",             1, "1F780", "1F7F0"],
        [filtra_grupo($caracteres_unicode, "1F300", "1F5FF", PAG_EMOJIS), "Símbolos y pictogramas misceláneos",                "simbolos-pict-misc",      "U1F300-miscellaneous-symbols-and-pictographs.pdf", 1, "1F300", "1F5FF"],
        [filtra_grupo($caracteres_unicode, "1F600", "1F64F", PAG_EMOJIS), "Emoticonos",                                        "emoticonos",              "U1F600-emoticons.pdf",                             1, "1F600", "1F64F"],
        [filtra_grupo($caracteres_unicode, "1F680", "1F6FF", PAG_EMOJIS), "Símbolos de transporte y mapas",                    "transporte",              "U1F680-transport-and-map-symbols.pdf",             1, "1F680", "1F6FF"],
        [filtra_grupo($caracteres_unicode, "1F900", "1F9FF", PAG_EMOJIS), "Símbolos y pictogramas misceláneos suplementarios", "simbolos-misc-supl",      "U1F900-supplemental-symbols-and-pictographs.pdf",  1, "1F900", "1F9FF"],
        [filtra_grupo($caracteres_unicode, "1FA70", "1FAFF", PAG_EMOJIS), "Símbolos y pictogramas extendidos A",               "simbolos-ext-a",          "U1FA70-symbols-and-pictographs-extended-a.pdf",    1, "1FA70", "1FAFF"],
    ],

    // Secuencias de Variación
    "Variación" => [
        [$variacion, "Secuencias de variación",     "variacion",         "",           1, "00000",  "1FAFF" ],
    ],

    // Banderas
    "Secuencias_1" => [
        [$cu_banderas,     "Banderas",                  "banderas",     "", 0, "", ""],
        [$cu_banderas_sub, "Banderas (subdivisiones)",  "banderas-2",   "", 0, "", ""],
    ],

    // Géneros que funcionan en Windows y en Twemoji
    "Secuencias_2" => [
        [$genero_1, "Género (1)",    "genero-1",     "", 0, "", "", ["ss", "te"]],
        [$genero_2, "Género (2)",    "genero-2",     "", 0, "", "", ["ss", "te"]],
        // CUIDADO $problematicas_piel_1 están separados de $genero_3 porque al poner colores de piel no salen bien en Windows
        // Lo que me faltaría es ordenar los elementos, porque ahora se añaden al final
        // pero no tengo claro cómo ordenar matrices multidimensionales https://www.php.net/manual/es/function.array-multisort.php
        [array_merge($genero_3, $problematicas_piel_1), "Género (3)",    "genero-3",     "", 0, "", "", ["ss", "te"]],
        [array_merge($genero_4), "Género (4)",    "genero-4",     "", 0, "", "", ["ss", "te"]],

        //  ["Colores de piel",                                     "colores-piel",    "", 0, "0261D", "1F9FF"],
        //  ["Otros",                                               "otros",           "", 4, "0002A", "1F4FF"],
    ],

    // Colores de piel que funcionan en Windows y en Twemoji
    "Secuencias_3" => [
        [$piel_1,    "Colores de piel (1)",     "colores-piel-1",  "", 0, "", "", ["ss", "te"]],
        [$genero_1,  "Colores de piel (2)",     "colores-piel-2",  "", 0, "", "", ["ss", "te"]],
        [$genero_2,  "Colores de piel (3)",     "colores-piel-3",  "", 0, "", "", ["ss", "te"]],
        [$genero_3,  "Colores de piel (4)",     "colores-piel-4",  "", 0, "", "", ["ss", "te"]],
    ],

    // Parejas y familias
    "Secuencias_4" => [
        [$cu_familias,       "Familias",                              "familias",          "", 0, "", ""],
        [$cu_parejas_1,      "Parejas de enamorados",                 "parejas-1",         "", 0, "", ""],
        [$cu_parejas_2,      "Parejas de enamorados besándose",       "parejas-2",         "", 0, "", ""],
        [$cu_parejas_piel_1, "Parejas neutras y colores de piel",     "parejas-piel-1",    "", 0, "", ""],
        [$cu_parejas_piel_2, "Parejas con género y colores de piel",  "parejas-piel-2",    "", 0, "", ""],
    ],

    "Secuencias_problematicas_1" => [
        [$problematicas_otros,  "Varios", "varios-problemas", "", 0, "", "", ["ss", "te"]],
    ],

    // Géneros que NO funcionan en Windows o en Twemoji
    "Secuencias_problematicas_2" => [
        [$problematicas_genero_1, "Género (1)",  "genero-1-problemas",    "", 0, "", "", ["ss", "te"]],
        [$problematicas_genero_2, "Género (2)",  "genero-2-problemas",    "", 0, "", "", ["ss", "te"]],
        [$problematicas_genero_3, "Género (3)",  "genero-3-problemas",    "", 0, "", "", ["ss", "te"]],
        [$problematicas_genero_4, "Género (4)",  "genero-4-problemas",    "", 0, "", "", ["ss", "te"]],
    ],

    // Colores de piel que NO funcionan en Windows o en Twemoji
    "Secuencias_problematicas_3" => [
        [$problematicas_piel_1,  "Colores de piel (1)",   "colores-piel-1-problemas", "", 0, "", "", ["ss", "te"]],
        [$problematicas_piel_2,  "Colores de piel (2)",   "colores-piel-2-problemas",  "", 0, "", "", ["ss", "te"]],
        [$problematicas_piel_3,  "Colores de piel (3)",   "colores-piel-3-problemas",  "", 0, "", "", ["ss", "te"]],
        [$problematicas_piel_4,  "Colores de piel (4)",   "colores-piel-4-problemas",  "", 0, "", "", ["ss", "te"]],
    ],
];

function genera_pagina($pagina)
{
    if ($pagina == PAG_SIMBOLOS) {
        // HAY QUE CAMBIAR VARIABLE $MUESTRA EN LINEA 6 A SIMBOLOS O EMOJIS
        genera_grupos(PAG_SIMBOLOS, ["SS-VST", "SYM"]);
    } elseif ($pagina == PAG_EMOJIS) {
        // HAY QUE CAMBIAR VARIABLE $MUESTRA EN LINEA 6 A SIMBOLOS O EMOJIS
        genera_grupos(PAG_EMOJIS, ["SS-VSE", "TCF-TGH"]);
    }
    // genera_variantes($variacion, "Secuencias de variación", "variacion");

// HAY CAMBIAR VARIABLE $MUESTRA EN LINEA 6 A EMOJIS
// genera_grupos($grupos_secuencias_1, ["ss", "te"]);      // Banderas
// genera_grupos($grupos_secuencias_2, ["ss", "te"]);      // Géneros OK
// genera_tablas($grupos_secuencias_3, ["ss", "te"]);      // Colores de piel: OK
// genera_grupos($grupos_secuencias_4, ["ss", "te"]);      // Familias y parejas
// genera_grupos($grupos_secuencias_problematicas_1, ["ss", "te"]);     // Animales y otros: No Windows
// genera_grupos($grupos_secuencias_problematicas_2, ["ss", "te"]);     // Géneros: No Windows o No Twemoji
// genera_tablas($grupos_secuencias_problematicas_3, ["ss", "te"]);     // Colores de piel: No Windows o No Twemoji
}

//aVer(filtra_grupo($caracteres_unicode, "0000", "007F", PAG_SIMBOLOS));
// genera_pagina(PAG_SIMBOLOS);
genera_pagina(PAG_EMOJIS);

// Puñetitas varias
// * No he tenido en cuenta si hay un carácter simple que no se ve en Windows pero sí está en twemoji
// * Parece que en temoji todo los caracteres simples se llaman solamente con el código, pero si son VST no se añade
// * Los caracteres 0023, 002A, etc. para que se vean se tiene que escribir con 20E3 al final, así que los he puesto en secuencias,
//   pero se supone que tiene versión texto y emoji, pero en Windows no se ven
// * El carácter 2122 (trade mark) está en TCF, pero si pongo TGH no sale bien, no sé por qué
// * El carácter  25FC no se ve igual si está en párrafo clase .si (sin span), que si tiene un span clase .ss. No lo entiendo.
// * El carácter 25FD y 25 FE son VST, pero para que enlace al respositorio tengo que poner VSE Creo que es un error de Twitter

/*

    function genera_variantes($matriz, $grupo, $id)
    {
        global $rutaSVG, $muestra;

        $contador = count($matriz);

        if ($contador > 0) {
            print "  <section id=\"$id\">\n";
            print "    <h2>$grupo</h2>\n";
            print "\n";

            if ($contador == 1) {
                print "    <p>Se muestra aquí $contador carácter de variación</p>\n";
            } else {
                print "    <p>Se muestran aquí $contador caracteres de variación</p>\n";
            }
            print "\n";
            foreach ($matriz as $origen) {
                print "    <div class=\"u-l\">\n";
                $triplete = [$origen, $origen, $origen];
                $triplete[1][0][] = "0FE0E";
                $triplete[2][0][] = "0FE0F";
                foreach ($triplete as $c) {
                    print "      <div class=\"u\">\n";
                    print "        <p class=\"uc\">";
                    foreach ($c[0] as $tmp) {
                        print "U+" . strtoupper(dechex(hexdec($tmp))) . " ";
                    }
                    print "</p>\n";
                    print "        <p class=\"si\">";
                    foreach ($c[0] as $tmp) {
                        print "&#x" . strtoupper(dechex(hexdec($tmp))) . ";";
                    }
                    print "</p>\n";
                    print "        <p class=\"en\"><strong>";
                    foreach ($c[0] as $tmp) {
                        print "&amp;#x" . dechex(hexdec($tmp)) . ";";
                    }
                    print "</strong></p>\n";
                    print "        <p class=\"en\"><strong>";
                    foreach ($c[0] as $tmp) {
                        print "&amp;#" . hexdec($tmp) . ";";
                    }
                    print "</strong></p>\n";
                    print "        <p class=\"no\">$c[7]</p>\n";
                    print "      </div>\n";
                    print "\n";
                }
                print "    </div>\n";
            }
            print "  </section>\n";
            print "\n";
        }
    }

    function genera_tabla_colores_piel($matriz, $grupo, $id, $pdf, $cuenta, $inicial, $final, $fuentes)
    {
        global $rutaSVG;

        print "  <section id=\"$id\">\n";
        print "    <h2>$grupo</h2>\n";
        print "\n";

        if ($cuenta) {
            $contador = 0;
            foreach ($matriz as $c) {
                $contador++;
            }
            if ($contador == 1) {
                print "    <p>Se muestra aquí $contador carácter ";
            } else {
                print "    <p>Se muestran aquí $contador caracteres ";
            }
            print "Unicode que al secuenciarse con los cinco modificadores Fitzpatrick (U+1F3FB a U+1F3FF) dan lugar cada uno a cinco nuevos emojis con distintos colores de piel.</p>\n";
            print "\n";
            print "    <p>Los caracteres se muestran únicamente con la fuente Twemoji y el resultado depende del sistema operativo y del navegador empleado.</p>\n";
            print "\n";
        }

        print "    <table class=\"u\">\n";
        print "      <col>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <colgroup span=\"2\" class=\"borde-lateral\"></colgroup>\n";
        print "      <col>\n";
        print "      <tr class=\"fila-estrecha\">\n";
        print "        <th rowspan=\"2\">Códigos</th>\n";
        print "        <th colspan=\"2\" rowspan=\"2\">Sin color de piel</th>\n";
        print "        <th colspan=\"10\">Con color de piel</th>\n";
        print "        <th rowspan=\"2\">Nombres</th>\n";
        print "      </tr>\n";
        print "      <tr class=\"fila-estrecha\">\n";
        print "        <th colspan=\"2\">&amp;#x1F3FB;</th>\n";
        print "        <th colspan=\"2\">&amp;#x1F3FC;</th>\n";
        print "        <th colspan=\"2\">&amp;#x1F3FD;</th>\n";
        print "        <th colspan=\"2\">&amp;#x1F3FE;</th>\n";
        print "        <th colspan=\"2\">&amp;#x1F3FF;</th>\n";
        print "      </tr>\n";
        foreach ($matriz as $c) {
            print "      <tr>\n";
            print "        <th>";
            $cad1 = $cad2 = $cad3 = "";
            foreach ($c[0] as $c2) {
                $tmp = strtolower($c2);
                while ($tmp[0] == "0") {
                    $tmp = substr($tmp, 1);
                }
                $cad1 .= "U+" . $c2 . " ";
                $cad2 .= $tmp . "-";
                $cad3 .=  "&#x" . strtoupper(dechex(hexdec($c2))) . ";";
                print "&amp;#x" . strtoupper(dechex(hexdec($c2))) . ";<wbr>";
            }
            print "</th>\n";
            $cad2 = substr($cad2, 0, strlen($cad2) - 1); // quito el guion final que sobra
            print "        <td class=\"ss\">$cad3</td>\n";
            if ($c[6] == "TW") {
                print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
            } else {
                print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
            }
            // CUIDADO: Hay varios casos especiales en los que el Fitzpatrick sustituye al segundo carácter de la secuencia
            $cad2 = str_replace("26f9-fe0f-", "26f9-", $cad2);
            $cad2 = str_replace("1f3cb-fe0f-", "1f3cb-", $cad2);
            $cad2 = str_replace("1f3cc-fe0f-", "1f3cc-", $cad2);
            $cad2 = str_replace("1f46e-fe0f-", "1f46e-", $cad2);
            $cad2 = str_replace("1f574-fe0f-", "1f574-", $cad2);
            $cad2 = str_replace("1f575-fe0f-", "1f575-", $cad2);
            $pos = strpos($cad2, "-", 2);
            if ($pos == 0) {
                $cad2 .= "-1f3fb";
            } else {
                $cad2 = substr_replace($cad2, "1f3fb-", $pos + 1, 0);
            }
            $pos = strpos($cad3, ";", 4);
            $cad3 = substr_replace($cad3, "&#x1F3FB;", $pos + 1, 0);
            print "        <td class=\"ss\">$cad3</td>\n";
            if (in_array("te", $fuentes)) {
                if ($c[6] == "TW") {
                    print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                } else {
                    print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                }
            }
            $cad2 = str_replace("1f3fb", "1f3fc", $cad2);
            $cad3 = str_replace("&#x1F3FB;", "&#x1F3FC;", $cad3);
            print "        <td class=\"ss\">$cad3</td>\n";
            if (in_array("te", $fuentes)) {
                if ($c[6] == "TW") {
                    print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                } else {
                    print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                }
            }
            $cad2 = str_replace("1f3fc", "1f3fd", $cad2);
            $cad3 = str_replace("&#x1F3FC;", "&#x1F3FD;", $cad3);
            print "        <td class=\"ss\">$cad3</td>\n";
            if (in_array("te", $fuentes)) {
                if ($c[6] == "TW") {
                    print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                } else {
                    print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                }
            }
            $cad2 = str_replace("1f3fd", "1f3fe", $cad2);
            $cad3 = str_replace("&#x1F3FD;", "&#x1F3FE;", $cad3);
            print "        <td class=\"ss\">$cad3</td>\n";
            if (in_array("te", $fuentes)) {
                if ($c[6] == "TW") {
                    print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                } else {
                    print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                }
            }
            $cad2 = str_replace("1f3fe", "1f3ff", $cad2);
            $cad3 = str_replace("&#x1F3FE;", "&#x1F3FF;", $cad3);
            print "        <td class=\"ss\">$cad3</td>\n";
            if (in_array("te", $fuentes)) {
                if ($c[6] == "TW") {
                    print "        <td class=\"twe\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                } else {
                    print "        <td class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></td>\n";
                }
            }
            print "        <td class=\"no\">$c[7]</td>\n";

            // print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // $cad2 = str_replace("1f3fb", "1f3fc", $cad2);
            // $cad3 = str_replace("&#x1F3FB;", "&#x1F3FC;", $cad3);
            // print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // $cad2 = str_replace("1f3fc", "1f3fd", $cad2);
            // $cad3 = str_replace("&#x1F3FC;", "&#x1F3FD;", $cad3);
            // print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // $cad2 = str_replace("1f3fd", "1f3fe", $cad2);
            // $cad3 = str_replace("&#x1F3FD;", "&#x1F3FE;", $cad3);
            // print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // $cad2 = str_replace("1f3fe", "1f3ff", $cad2);
            // $cad3 = str_replace("&#x1F3FE;", "&#x1F3FF;", $cad3);
            // print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // print "        <td>" . strtoupper($c[7]) . " </td>\n";

            print "      </tr>\n";
        }
        print "    </table>\n";
        print "  </section>\n";
        print "\n";
    }

    function genera_tablas($grupos)
    {
        print "  <ul>\n";
        foreach ($grupos as $g) {
            print "    <li><a href=\"#$g[2]\">$g[1]</a></li>\n";
        }
        print "  </ul>\n";
        print "\n";

        foreach ($grupos as $g) {
            genera_tabla_colores_piel($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[7], $g[7]);
        }
    }


*/
    ?>

  <script>
    var twemojis = document.getElementsByClassName('twe');
    var i;
    for (i = 0; i < twemojis.length; i++) {
      twemoji.parse(twemojis[i], {
        className: "twe",
        folder: "svg",
        ext: ".svg"
      });
    }
  </script>
</body>

</html>
