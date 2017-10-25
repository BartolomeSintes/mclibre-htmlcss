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
      @font-face {
        font-family: "Twemoji";
        src: url("unicode/TwitterColorEmoji-SVGinOT.ttf");
      }
      div.u { float: left; width: 500px; height: 230px; margin: 10px; border: black 1px solid; text-align: center; }
      div.u p { margin: 0; padding: 5px 10px; }
      div.u p.uc { background-color: #ddd; font-weight: bold; }
      div.u p.si { font-size: 80px; line-height: 100px; text-align: center; }
      div.u span.ss { font-family: sans-serif;}
      div.u span.sy { font-family: "Symbola";}
      div.u span.ne { font-family: "Noto Emoji";}
      div.u span.eo { font-family: "EmojiOne"; }
      div.u span.te { font-family: "Twemoji"; }
      div.u p.en { background-color: #ddd; }
      div.u p.no { text-transform: uppercase; }
      div.u a { border: none; text-decoration: none; color: black; }
      table.u { border-spacing: 20px 0; }
      table.u span.eo { font-family: "EmojiOne"; font-size: 80px; }
      table.u span.te { font-family: "Twemoji"; font-size: 80px; }
      table.u a { border: none; text-decoration: none; color: black; }
    </style>
  </head>

  <body>
    <?php
    // 12 de marzo de 2017
    include("unicode-array.php");

    function genera_grupo($grupo, $id, $pdf, $numcod, $inicial, $final) {
      global $caracteres_unicode;

      print "    <section id=\"$id\">\n";
      print "      <h2>$grupo</h2>\n";
      print "\n";

      if ($numcod == 1) {
        $contador = 0;
        foreach ($caracteres_unicode as $c) {
          if (count($c[0]) == 1 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
            $contador++;
          }
        }
        if ($contador == 1) {
          print "      <p>Se muestra aquí $contador carácter ";
        } else {
          print "      <p>Se muestran aquí $contador caracteres ";
        }
        print "Unicode del grupo que se extiende desde el carácter U+$inicial hasta el carácter U+$final. Se puede descargar la <a href=\"unicode/$pdf\">tabla de códigos de caracteres Unicode 10.0</a> en formato PDF.</p>\n";
        print "\n";
      }

      foreach ($caracteres_unicode as $c) {
        if ($numcod == 1) {
          if (count($c[0]) == 1 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[0][0] . "</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[0][0] . ";</span> \n";
            print "          <span class=\"sy\">&#x" . $c[0][0] . ";</span> \n";
            if ($c[2] == "emojione") {
              $tmp = strtolower($c[0][0]);
              if ($tmp[0] == "0") {
                $tmp = substr($tmp, 1);
              }
              print "          <span class=\"eo\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp.svg\">&#x" . $c[0][0] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[0][0] . ";</span>\n";
            }
            print "          <span class=\"ne\">&#x" . $c[0][0] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";</strong> &nbsp; &nbsp; decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[1]</p>\n";
            print "      </div>\n";
            print "\n";
          }
        } elseif ($numcod == 2) {
          if (count($c[0]) == 2 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . "</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";</span> \n";
            //            print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            if ($c[2] == "emojione") {
              $tmp0 = strtolower($c[0][0]);
              if ($tmp0[0] == "0") {
                $tmp0 = substr($tmp0, 1);
              }
              $tmp1 = strtolower($c[0][1]);
              if ($tmp1[0] == "0") {
                $tmp1 = substr($tmp1, 1);
              }
              print "          <span class=\"eo\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp0-$tmp1.svg\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";</span>\n";
            }
            //            print "          <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";</strong><br />decimal: <strong>&amp;#x" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[1]</p>\n";
            print "      </div>\n";
            print "\n";
          }
        } elseif ($numcod == 3) {
          if (count($c[0]) == 3 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] ."</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</span> \n";
            //            print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            if ($c[2] == "emojione") {
              $tmp0 = strtolower($c[0][0]);
              if ($tmp0[0] == "0") {
                $tmp0 = substr($tmp0, 1);
              }
              $tmp1 = strtolower($c[0][1]);
              if ($tmp1[0] == "0") {
                $tmp1 = substr($tmp1, 1);
              }
              $tmp2 = strtolower($c[0][2]);
              if ($tmp2[0] == "0") {
                $tmp2 = substr($tmp2, 1);
              }
              print "          <span class=\"eo\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp0-$tmp1-$tmp2.svg\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x200D;&#x" . $c[0][2] . ";</span>\n";
            }
            //            print "          <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";</strong><br />decimal: <strong>&amp;#x" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";#" . hexdec($c[0][2]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[1]</p>\n";
            print "      </div>\n";
            print "\n";
          }
        } elseif ($numcod == 7) {
          if (count($c[0]) == 7 ) { // && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
            print "      <div class=\"u\">\n";
            print "        <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . " U+" . $c[0][4] . " U+" . $c[0][5] . " U+" . $c[0][6] ."</p>\n";
            print "        <p class=\"si\">\n";
            print "          <span class=\"ss\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x200D;&#x" . $c[0][3] . ";&#x200D;&#x" . $c[0][4] . ";&#x200D;&#x" . $c[0][5] . ";</span> \n";
            //            print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            if ($c[2] == "emojione") {
              $tmp0 = strtolower($c[0][0]);
              if ($tmp0[0] == "0") {
                $tmp0 = substr($tmp0, 1);
              }
              $tmp1 = strtolower($c[0][1]);
              if ($tmp1[0] == "0") {
                $tmp1 = substr($tmp1, 1);
              }
              $tmp2 = strtolower($c[0][2]);
              if ($tmp2[0] == "0") {
                $tmp2 = substr($tmp2, 1);
              }
              $tmp3 = strtolower($c[0][3]);
              if ($tmp3[0] == "0") {
                $tmp3 = substr($tmp3, 1);
              }
              $tmp4 = strtolower($c[0][4]);
              if ($tmp4[0] == "0") {
                $tmp4 = substr($tmp4, 1);
              }
              $tmp5 = strtolower($c[0][5]);
              if ($tmp5[0] == "0") {
                $tmp5 = substr($tmp5, 1);
              }
              print "          <span class=\"eo\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp0-$tmp1-$tmp2-$tmp3-$tmp4-$tmp5.svg\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</a></span>\n";
            } else {
              print "          <span class=\"eo\">&#x" . $c[0][0] . ";&#x200D;&#x" . $c[0][1] . ";&#x200D;&#x" . $c[0][2] . ";&#x200D;&#x" . $c[0][3] . ";&#x200D;&#x" . $c[0][4] . ";&#x200D;&#x" . $c[0][5] . ";</span>\n";
            }
            //            print "          <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
            print "        </p>\n";
            print "        <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";&amp;#x" . $c[0][4] . ";&amp;#x" . $c[0][5] . ";&amp;#x" . $c[0][6] . ";</strong><br />decimal: <strong>&amp;#x" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";&amp;#" . hexdec($c[0][4]) . ";&amp;#" . hexdec($c[0][5]) . ";&amp;#" . hexdec($c[0][6]) . ";</strong></p>\n";
            print "        <p class=\"no\">$c[1]</p>\n";
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
        genera_grupo($g[0], $g[1], $g[2], $g[3], $g[4], $g[5]);
      }
    }

    function genera_tabla_colores_piel($grupo, $id, $pdf, $numcod, $inicial, $final) {
      global $caracteres_colores_piel;

      print "    <section id=\"$id\">\n";
      print "      <h2>$grupo</h2>\n";
      print "\n";

      if ($numcod == 1) {
        $contador = 0;
        foreach ($caracteres_colores_piel as $c) {
            $contador++;
        }
        if ($contador == 1) {
          print "      <p>Se muestra aquí $contador carácter ";
        } else {
          print "      <p>Se muestran aquí $contador caracteres ";
        }
        print "Unicode que al secuenciarse con los cinco modificadores Fitzpatrick (U+1F3FB a U+1F3FF) dan lugar cada uno a cinco nuevos emojis con distintos colores de piel.</p>\n";
        print "\n";
        print "      <p>Los caracteres se muestran únicamente con la fuente EmojiOne y el resultado depende del sistema operativo y del navegador empleado.</p>\n";
        print "\n";
      }

      print "      <table class=\"u\">\n";
      print "        <tr>\n";
      print "          <th></th>\n";
      print "          <th></th>\n";
      print "          <th>&amp;#x1F3FB;</th>\n";
      print "          <th>&amp;#x1F3FC;</th>\n";
      print "          <th>&amp;#x1F3FD;</th>\n";
      print "          <th>&amp;#x1F3FE;</th>\n";
      print "          <th>&amp;#x1F3FF;</th>\n";
      print "        </tr>\n";
      foreach ($caracteres_colores_piel as $c) {
        print "        <tr>\n";
        print "          <th>U+" . $c[0][0] . " </th>\n";
        $tmp = strtolower($c[0][0]);
        if ($tmp[0] == "0") {
          $tmp = substr($tmp, 1);
        }
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp.svg\">&#x" . $c[0][0] . ";</a></span></td>\n";
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp-1f3fb.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FB;</a></span></td>\n";
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp-1f3fc.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FC;</a></span></td>\n";
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp-1f3fd.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FD;</a></span></td>\n";
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp-1f3fe.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FE;</a></span></td>\n";
        print "          <td><span class=\"te\"><a href=\" https://github.com/emojione/emojione/blob/2.2.7/assets/svg/$tmp-1f3ff.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FF;</a></span></td>\n";
        print "          <td>" . strtoupper($c[1]) . " </td>\n";
        print "        </tr>\n";
      }
      print "      </table>\n";
      print "    </section>\n";
      print "\n";
    }

    $grupos_simbolos = array(
      array("Controles y Latin básico",                          "controles-latin",        "U00000.pdf", 1, "0000",  "007F"),
      array("Suplemento controles y Latin-1",                    "controles-sup",          "U00080.pdf", 1, "0080",  "00FF"),
      array("Puntuación",                                        "puntuacion",             "U02000.pdf", 1, "2000",  "206F"),
      array("Símbolos de monedas",                               "monedas",                "U020A0.pdf", 1, "20A0",  "20BF"),
      array("Símbolos con letras",                               "simbolos-letras",        "U02100.pdf", 1, "2100",  "214F"),
      array("Flechas",                                           "flechas",                "U02190.pdf", 1, "2190",  "21FF"),
      array("Símbolos técnicos misceláneos",                     "tecnicos-misc",          "U02300.pdf", 1, "2300",  "23FE"),
      array("Símbolos alfanuméricos con círculo alrededor",      "alfanum-circulo",        "U02460.pdf", 1, "2460",  "24FF"),
      array("Cajas",                                             "cajas",                  "U02500.pdf", 1, "2500",  "257F"),
      array("Formas geométricas",                                "formas-geometricas",     "U025A0.pdf", 1, "25A0",  "25FF"),
      array("Símbolos misceláneos",                              "simbolos-misc",          "U02600.pdf", 1, "2600",  "26FF"),
      array("Dingbats",                                          "dingbats",               "U02700.pdf", 1, "2700",  "27BF"),
      array("Flechas suplementarias B",                          "flechas-suplementarias", "U02900.pdf", 1, "2900",  "297F"),
      array("Símbolos y flechas misceláneos",                    "simbolos-flechas",       "U02B00.pdf", 1, "2B00",  "2BEF"),
      array("Símbolos y puntuación CJK",                         "cjk",                    "U03000.pdf", 1, "3000",  "303F"),
      array("Símbolos CJK con círculo alrededor",                "cjk-circulo",            "U03200.pdf", 1, "3200",  "32FF"),
      //      array("Símbolos musicales",                                "musica",                 "U1D100.pdf", 1, "1D100", "1D1E8"),
      array("Fichas de Mahjong",                                 "fichas-mahjong",         "U1F000.pdf", 1, "1F000", "1F02B"),
      //      array("Fichas de dominó",                                  "domino",                 "U1F030.pdf", 1, "1F030", "1F093"),
      array("Cartas",                                            "cartas",                 "U1F0A0.pdf", 1, "1F0A0", "1F0F5"),
      array("Suplemento alfanuméricos con círculo alrededor",    "alfanum-circulo-sup",    "U1F100.pdf", 1, "1F100", "1F1FF"),
      array("Suplemento ideográfico con círculo alrededor",      "ideografico-circulo-sup","U1F200.pdf", 1, "1F200", "1F2FF"),
      //      array("Dingbats decorativos",                              "dingbats-decorativos",   "U1F650.pdf", 1, "1F650", "1F67F"),
      //      array("Símbolos alquímicos",                               "simbolos-alquimicos",    "U1F700.pdf", 1, "1F700", "1F773"),
      //      array("Formas geométricas extendidas",                     "geometricas-extendidas", "U1F780.pdf", 1, "1F780", "1F7D4"),
    );

    $grupos_dibujos = array(
      array("Símbolos y pictogramas misceláneos",                "simbolos-misc",      "U1F300.pdf", 1, "1F300", "1F5FF"),
      array("Emoticonos",                                        "emoticonos",         "U1F600.pdf", 1, "1F600", "1F64F"),
      array("Símbolos de transporte y mapas",                    "transporte",         "U1F680.pdf", 1, "1F680", "1F6FF"),
      array("Símbolos y pictogramas misceláneos suplementarios", "simbolos-misc-supl", "U1F900.pdf", 1, "1F900", "1F9FF"),
    );

    $grupos_modificadores = array(
      // array("Banderas",                                          "banderas",           "",          2, "1F1E6", "1F1FF"),
      // array("Banderas (subdivisiones)",                          "banderas-2",         "",          7, "1F3F4", "1F3FF"),
      array("Colores de piel",                                   "colores-piel",    "",           2, "0261D", "1F9FF"),
      // array("Otros",                                             "otros",           "",           3, "1F468", "1F469"),
      // array("Otros",                                             "otros",           "",           2, "0002A", "1F4FF"),
    );

    $grupos_restos = array(
      array("Restos",                                            "restos",             "",           1, "00000", "FFFFF"),
    );

    // genera_grupos($grupos_simbolos);
    // genera_grupos($grupos_dibujos);
    // genera_grupos($grupos_modificadores);
    genera_tabla_colores_piel("Colores de piel", "colores-piel", "", 1, "0261D", "1F9FF");
    //      genera_grupos($grupos_restos);


    ?>
  </body>
</html>
