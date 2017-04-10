<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Genera fichas Pictogramas. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../varios/htmlcss.css" rel="stylesheet" type="text/css" title="Color" />
    <link href="../varios/ejemplos.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../varios/favicon.ico" />
    <style type="text/css">
      @font-face {
        font-family: "Symbola";
        src: url("unicode/Symbola.ttf");
      }
      @font-face {
        font-family: "Noto Emoji";
        src: url("unicode/NotoEmoji-Regular.ttf");
      }
      @font-face {
        font-family: "EmojiOne";
        src: url("unicode/emojione-svg.woff2");
      }
      div.u { float: left; width: 500px; height: 230px; margin: 10px; border: black 1px solid; text-align: center; }
      div.u p { margin: 0; padding: 5px 10px; }
      div.u p.uc { background-color: #ddd; font-weight: bold; }
      div.u p.si { font-size: 80px; line-height: 100px; text-align: center; }
      div.u span.ss { font-family: sans-serif;}
      div.u span.sy { font-family: "Symbola";}
      div.u span.ne { font-family: "Noto Emoji";}
      div.u span.eo { font-family: "EmojiOne";}
      div.u p.en { background-color: #ddd; }
      div.u p.no { text-transform: uppercase; }
      div.u a { border: none; text-decoration: none; color: black; }
    </style>
  </head>

  <body>
    <?php
    // 12 de marzo de 2017
    include("unicode_array.php");

    function genera_grupo($grupo, $id, $pdf, $inicial, $final) {
      global $caracteres_unicode;

      print "    <section id=\"$id\">\n";
      print "      <h2>$grupo</h2>\n";
      print "\n";

      $contador = 0;
      foreach ($caracteres_unicode as $c) {
        if (hexdec($c[1]) >= hexdec($inicial) && hexdec($c[1]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
          $contador++;
        }
      }
      if ($c[0] == "") {
        print "      <p>Este grupo de $contador caracteres Unicode se extiende desde el carácter U+$inicial hasta el carácter U+$final. Se puede descargar la <a href=\"unicode/$pdf\">tabla de códigos de caracteres Unicode 9.0</a> en formato PDF</p>\n";
        print "\n";
      }

      foreach ($caracteres_unicode as $c) {
        if (hexdec($c[1]) >= hexdec($inicial) && hexdec($c[1]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
          if ($c[0] == "") {
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[1] . "</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[1] . ";</span> \n";
            print "          <span class=\"sy\">&#x" . $c[1] . ";</span> \n";
            if ($c[3] == "emojione") {
              print "          <span class=\"eo\"><a href=\"https://github.com/Ranks/emojione/tree/master/assets/svg/" . strtolower($c[1]) . ".svg\">&#x" . $c[1] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[1] . ";</span>\n";
            }
            print "          <span class=\"ne\">&#x" . $c[1] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[1] . ";</strong> &nbsp; &nbsp; decimal: <strong>&amp;#" . hexdec($c[1]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[2]</p>\n";
            print "      </div>\n";
            print "\n";
          } else {
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[0] . " U+" . $c[1] . "</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[0] . ";&#x200D;&#x" . $c[1] . ";</span> \n";
//            print "          <span class=\"sy\">&#x" . $c[0] . ";&#x" . $c[1] . ";</span> \n";
            if ($c[3] == "emojione") {
              print "          <span class=\"eo\"><a href=\"https://github.com/Ranks/emojione/tree/master/assets/svg/" . strtolower($c[0]) . "-" . strtolower($c[1]) . ".svg\">&#x" . $c[0] . ";&#x" . $c[1] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[0] . ";&#x" . $c[1] . ";</span>\n";
            }
//            print "          <span class=\"ne\">&#x" . $c[0] . ";&#x" . $c[1] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0] . ";&amp;#x" . $c[1] . ";</strong><br />decimal: <strong>&amp;#x" . hexdec($c[0]) . ";&amp;#" . hexdec($c[1]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[2]</p>\n";
            print "      </div>\n";
            print "\n";
          }
        }
      }
      print "    </section>\n";
      print "\n";
    }

    function genera_grupos($grupos) {
      print "<ul>\n";
      foreach ($grupos as $g) {
        print "      <li><a href=\"#$g[1]\">$g[0]</a></li>\n";
      }
      print "    </ul>\n";
      print "\n";

      foreach ($grupos as $g) {
        genera_grupo($g[0], $g[1], $g[2], $g[3], $g[4]);
      }
    }

    $grupos_simbolos = array(
      array("Controles y Latin básico",                          "controles-latin",        "U00000.pdf", "0000",  "007F"),
      array("Suplemento controles y Latin-1",                    "controles-sup",          "U00080.pdf", "0080",  "00FF"),
      array("Puntuación",                                        "puntuacion",             "U02000.pdf", "2000",  "206F"),
      array("Símbolos con letras",                               "simbolos-letras",        "U02100.pdf", "2100",  "214F"),
      array("Flechas",                                           "flechas",                "U02190.pdf", "2190",  "21FF"),
      array("Símbolos técnicos misceláneos",                     "tecnicos-misc",          "U02300.pdf", "2300",  "23FE"),
      array("Símbolos alfanuméricos con círculo alrededor",      "alfanum-circulo",        "U02460.pdf", "2460",  "24FF"),
      array("Cajas",                                             "cajas",                  "U02500.pdf", "2500",  "257F"),
      array("Cajas",                                             "cajas",                  "U02500.pdf", "2500",  "257F"),
      array("Formas geométricas",                                "formas-geometricas",     "U025A0.pdf", "25A0",  "25FF"),
      array("Dingbats",                                          "dingbats",               "U02700.pdf", "2700",  "27BF"),
      array("Flechas suplementarias B",                          "flechas-suplementarias", "U02900.pdf", "2900",  "297F"),
      array("Símbolos y flechas misceláneos",                    "simbolos-flechas",       "U02B00.pdf", "2B00",  "2BEF"),
      array("Símbolos y puntuación CJK",                         "cjk",                    "U03000.pdf", "3000",  "303F"),
      array("Símbolos CJK con círculo alrededor",                "cjk-circulo",            "U03200.pdf", "3200",  "32FF"),
//      array("Símbolos musicales",                                "musica",                 "U1D100.pdf", "1D100", "1D1E8"),
      array("Fichas de Mahjong",                                 "fichas-mahjong",         "U1F000.pdf", "1F000", "1F02B"),
//      array("Fichas de dominó",                                  "domino",                 "U1F030.pdf", "1F030", "1F093"),
      array("Cartas",                                            "cartas",                 "U1F0A0.pdf", "1F0A0", "1F0F5"),
      array("Suplemento alfanuméricos con círculo alrededor",    "alfanum-circulo-sup",    "U1F100.pdf", "1F100", "1F1FF"),
      array("Suplemento ideográfico con círculo alrededor",      "ideografico-circulo-sup","U1F200.pdf", "1F200", "1F2FF"),
//      array("Dingbats decorativos",                              "dingbats-decorativos",   "U1F650.pdf", "1F650", "1F67F"),
//      array("Símbolos alquímicos",                               "simbolos-alquimicos",    "U1F700.pdf", "1F700", "1F773"),
//      array("Formas geométricas extendidas",                     "geometricas-extendidas", "U1F780.pdf", "1F780", "1F7D4"),
    );

    $grupos_dibujos = array(
      array("Símbolos y pictogramas misceláneos",                "simbolos-misc",      "U1F300.pdf", "1F300", "1F5FF"),
      array("Emoticonos",                                        "emoticonos",         "U1F600.pdf", "1F600", "1F64F"),
      array("Símbolos de transporte y mapas",                    "transporte",         "U1F680.pdf", "1F680", "1F6FF"),
      array("Símbolos y pictogramas misceláneos suplementarios", "simbolos-misc-supl", "U1F900.pdf", "1F910", "1F9C0"),
    );

    $grupos_modificadores = array(
      array("Banderas",                                          "banderas",           "",           "1F1E6", "1F1FF"),
    );

    $grupos_restos = array(
      array("Restos",                                            "restos",             "",           "00000", "FFFFF"),
    );

      genera_grupos($grupos_simbolos);
//      genera_grupos($grupos_dibujos);
//      genera_grupos($grupos_modificadores);
//      genera_grupos($grupos_restos);


    ?>
  </body>
</html>
