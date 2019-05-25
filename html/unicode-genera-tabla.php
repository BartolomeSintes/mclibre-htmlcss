<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Genera fichas Pictogramas. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../varios/htmlcss.css" title="Color">
    <link rel="icon" href="../varios/favicon.ico">
    <style>
        @font-face {
            font-family: "Symbola";
            src: url("unicode/Symbola.ttf");
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
            flex: 0 1 300px;
            margin: 5px;
            border: black 1px solid;
            text-align: center;
        }

        div.u p:nth-child(odd) {
            background-color: #eee;
        }

        div.u p {
            margin: 0;
            padding: 5px 10px;
        }

        div.u p.uc {
            font-weight: bold;
        }

        div.u p.si {
            font-size: 80px;
            line-height: 100px;
            text-align: center;
        }

        div.u span.ss {
            font-family: sans-serif;
            border-right: 2px solid black;
            padding-right: 20px;
        }

        div.u span.sy {
            font-family: "Symbola";
        }

        div.u span.te {
            font-family: "Twemoji";
        }

        div.u p.en {}

        div.u p.no {
            flex: 1 0 auto;
            text-transform: uppercase;
        }

        div.u a {
            border: none;
            text-decoration: none;
            color: black;
        }

        table.u {
            border-spacing: 20px 0;
        }

        table.u span.te {
            font-family: "Twemoji";
            font-size: 80px;
        }

        table.u a {
            border: none;
            text-decoration: none;
            color: black;
        }
    </style>
    <!-- SIN FLEXBOX
<style>
    @font-face {
      font-family: "Symbola";
      src: url("unicode/Symbola.ttf");
    }
    @font-face {
      font-family: "Noto Emoji";
      src: url("unicode/NotoEmoji-Regular.ttf");
    }
    @font-face {
      font-family: "Twemoji";
      src: url("unicode/TwitterColorEmoji-SVGinOT.ttf");
    }
    div.u { float: left; width: 500px; height: 230px; margin: 10px; border: black 1px solid; text-align: center; }
    div.u p { margin: 0; padding: 5px 10px; }
    div.u p.uc { background-color: #ddd; font-weight: bold; }
    div.u p.si { font-size: 80px; line-height: 100px; text-align: center; }
    div.u span.ss { font-family: sans-serif; border-right: 2px solid black; padding-right: 20px;}
    div.u span.sy { font-family: "Symbola";}
    div.u span.ne { font-family: "Noto Emoji";}
    div.u span.te { font-family: "Twemoji"; }
    div.u p.en { background-color: #ddd; }
    div.u p.no { text-transform: uppercase; }
    div.u a { border: none; text-decoration: none; color: black; }
    table.u { border-spacing: 20px 0; }
    table.u span.te { font-family: "Twemoji"; font-size: 80px; }
    table.u a { border: none; text-decoration: none; color: black; }
  </style>
  -->
</head>

<body>
    <?php
    // 1 de septiembre de 2018
    include("unicode-array.php");
    include("unicode-array-combinaciones.php");
    // $rutaSVG = "https://github.com/emojione/emojione/blob/2.2.7/assets/svg";
    $rutaSVG = "https://github.com/twitter/twemoji/blob/gh-pages/2/svg";

    function genera_grupo($matriz, $grupo, $id, $pdf, $cuenta, $inicial, $final, $fuentes)
    {
        global $rutaSVG;

        print "  <section id=\"$id\">\n";
        print "    <h2>$grupo</h2>\n";
        print "\n";
        print "    <div class=\"u-l\">\n";

        if ($cuenta) {
            $contador = 0;
            foreach ($matriz as $c) {
                if (count($c[0]) == 1 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
                    $contador++;
                }
            }
            if ($contador == 1) {
                print "    <p>Se muestra aquí $contador carácter ";
            } else {
                print "    <p>Se muestran aquí $contador caracteres ";
            }
            print "Unicode del grupo que se extiende desde el carácter U+$inicial hasta el carácter U+$final. Se puede descargar la <a href=\"unicode/$pdf\">tabla de códigos de caracteres Unicode 12.1</a> en formato PDF.</p>\n";
            print "\n";
        }

        foreach ($matriz as $c) {
            if (count($c[0]) == 1 && hexdec($c[0][0]) >= hexdec($inicial) && hexdec($c[0][0]) <= hexdec($final)) { // no sé si es necesario convertirlo a decimal, pero por si acaso
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "        <span class=\"sy\">&#x" . $c[0][0] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp = strtolower($c[0][0]);
                        while ($tmp[0] == "0") {
                            $tmp = substr($tmp, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp.svg\">&#x" . $c[0][0] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";</span> \n";
                }
                // print "        <span class=\"te\">&#x" . $c[0][0] . ";</span> \n";
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";</strong> &nbsp; &nbsp; decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 2) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 3) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 4) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        $tmp3 = strtolower($c[0][3]);
                        while ($tmp3[0] == "0") {
                            $tmp3 = substr($tmp3, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2-$tmp3.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 5) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . " U+" . $c[0][4] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "          <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        $tmp3 = strtolower($c[0][3]);
                        while ($tmp3[0] == "0") {
                            $tmp3 = substr($tmp3, 1);
                        }
                        $tmp4 = strtolower($c[0][4]);
                        while ($tmp4[0] == "0") {
                            $tmp4 = substr($tmp4, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2-$tmp3-$tmp4.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";&amp;#x" . $c[0][4] . ";</strong><br>decimal: <strong>&amp;#x" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";&amp;#" . hexdec($c[0][4]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 6) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . " U+" . $c[0][4] . " U+" . $c[0][5] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "        <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</span>\n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        $tmp3 = strtolower($c[0][3]);
                        while ($tmp3[0] == "0") {
                            $tmp3 = substr($tmp3, 1);
                        }
                        $tmp4 = strtolower($c[0][4]);
                        while ($tmp4[0] == "0") {
                            $tmp4 = substr($tmp4, 1);
                        }
                        $tmp5 = strtolower($c[0][5]);
                        while ($tmp5[0] == "0") {
                            $tmp5 = substr($tmp5, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2-$tmp3-$tmp4-$tmp5.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";&amp;#x" . $c[0][4] . ";&amp;#x" . $c[0][5] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";&amp;#" . hexdec($c[0][4]) . ";&amp;#" . hexdec($c[0][5]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 7) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . " U+" . $c[0][4] . " U+" . $c[0][5] . " U+" . $c[0][6] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "        <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";</span>\n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        $tmp3 = strtolower($c[0][3]);
                        while ($tmp3[0] == "0") {
                            $tmp3 = substr($tmp3, 1);
                        }
                        $tmp4 = strtolower($c[0][4]);
                        while ($tmp4[0] == "0") {
                            $tmp4 = substr($tmp4, 1);
                        }
                        $tmp5 = strtolower($c[0][5]);
                        while ($tmp5[0] == "0") {
                            $tmp5 = substr($tmp5, 1);
                        }
                        $tmp6 = strtolower($c[0][6]);
                        while ($tmp6[0] == "0") {
                            $tmp6 = substr($tmp6, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2-$tmp3-$tmp4-$tmp5-$tmp6.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";&amp;#x" . $c[0][4] . ";&amp;#x" . $c[0][5] . ";&amp;#x" . $c[0][6] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";&amp;#" . hexdec($c[0][4]) . ";&amp;#" . hexdec($c[0][5]) . ";&amp;#" . hexdec($c[0][6]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            } elseif (count($c[0]) == 8) {
                print "    <div class=\"u\">\n";
                print "      <p class=\"uc\">U+" . $c[0][0] . " U+" . $c[0][1] . " U+" . $c[0][2] . " U+" . $c[0][3] . " U+" . $c[0][4] . " U+" . $c[0][5] . " U+" . $c[0][6] . " U+" . $c[0][7] . "</p>\n";
                print "      <p class=\"si\">\n";
                if (in_array("ss", $fuentes)) {
                    print "        <span class=\"ss\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</span> \n";
                }
                if (in_array("sy", $fuentes)) {
                    print "        <span class=\"sy\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</span> \n";
                }
                if (in_array("te", $fuentes)) {
                    if ($c[2] == "twemoji") {
                        $tmp0 = strtolower($c[0][0]);
                        while ($tmp0[0] == "0") {
                            $tmp0 = substr($tmp0, 1);
                        }
                        $tmp1 = strtolower($c[0][1]);
                        while ($tmp1[0] == "0") {
                            $tmp1 = substr($tmp1, 1);
                        }
                        $tmp2 = strtolower($c[0][2]);
                        while ($tmp2[0] == "0") {
                            $tmp2 = substr($tmp2, 1);
                        }
                        $tmp3 = strtolower($c[0][3]);
                        while ($tmp3[0] == "0") {
                            $tmp3 = substr($tmp3, 1);
                        }
                        $tmp4 = strtolower($c[0][4]);
                        while ($tmp4[0] == "0") {
                            $tmp4 = substr($tmp4, 1);
                        }
                        $tmp5 = strtolower($c[0][5]);
                        while ($tmp5[0] == "0") {
                            $tmp5 = substr($tmp5, 1);
                        }
                        $tmp6 = strtolower($c[0][6]);
                        while ($tmp6[0] == "0") {
                            $tmp6 = substr($tmp6, 1);
                        }
                        $tmp7 = strtolower($c[0][7]);
                        while ($tmp7[0] == "0") {
                            $tmp6 = substr($tmp7, 1);
                        }
                        print "        <span class=\"te\"><a href=\"$rutaSVG/$tmp0-$tmp1-$tmp2-$tmp3-$tmp4-$tmp5-$tmp6-$tmp7.svg\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</a></span>\n";
                    } else {
                        print "        <span class=\"te\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</span>\n";
                    }
                }
                if (in_array("ne", $fuentes)) {
                    print "        <span class=\"ne\">&#x" . $c[0][0] . ";&#x" . $c[0][1] . ";&#x" . $c[0][2] . ";&#x" . $c[0][3] . ";&#x" . $c[0][4] . ";&#x" . $c[0][5] . ";&#x" . $c[0][6] . ";&#x" . $c[0][7] . ";</span>\n";
                }
                print "      </p>\n";
                print "      <p class=\"en\">hexadecimal: <strong>&amp;#x" . $c[0][0] . ";&amp;#x" . $c[0][1] . ";&amp;#x" . $c[0][2] . ";&amp;#x" . $c[0][3] . ";&amp;#x" . $c[0][4] . ";&amp;#x" . $c[0][5] . ";&amp;#x" . $c[0][6] . ";&amp;#x" . $c[0][7] . ";</strong><br>decimal: <strong>&amp;#" . hexdec($c[0][0]) . ";&amp;#" . hexdec($c[0][1]) . ";&amp;#" . hexdec($c[0][2]) . ";&amp;#" . hexdec($c[0][3]) . ";&amp;#" . hexdec($c[0][4]) . ";&amp;#" . hexdec($c[0][5]) . ";&amp;#" . hexdec($c[0][6]) . ";&amp;#" . hexdec($c[0][7]) . ";</strong></p>\n";
                print "      <p class=\"no\">$c[1]</p>\n";
                print "    </div>\n";
                print "\n";
            }
        }
        print "    </div>\n";
        print "  </section>\n";
        print "\n";
    }

    function genera_grupos($grupos, $fuentes)
    {
        print "  <ul>\n";
        foreach ($grupos as $g) {
            print "    <li><a href=\"#$g[2]\">$g[1]</a></li>\n";
        }
        print "  </ul>\n";
        print "\n";

        foreach ($grupos as $g) {
            genera_grupo($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $fuentes);
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
        print "      <tr>\n";
        print "        <th></th>\n";
        print "        <th></th>\n";
        print "        <th>&amp;#x1F3FB;</th>\n";
        print "        <th>&amp;#x1F3FC;</th>\n";
        print "        <th>&amp;#x1F3FD;</th>\n";
        print "        <th>&amp;#x1F3FE;</th>\n";
        print "        <th>&amp;#x1F3FF;</th>\n";
        print "      </tr>\n";
        foreach ($matriz as $c) {
            print "      <tr>\n";
            $cad1 = $cad2 = $cad3 = "";
            foreach ($c[0] as $c2) {
                $tmp = strtolower($c2);
                while ($tmp[0] == "0") {
                    $tmp = substr($tmp, 1);
                }
                $cad1 .= "U+" . $c2 . " ";
                $cad2 .= $tmp . "-";
                $cad3 .=  "&#x" . $c2 . ";";
            }
            $cad2 = substr($cad2, 0, strlen($cad2) - 1); // quito el guión final que sobra
            print "        <th>$cad1</th>\n";
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            // CUIDADO: Hay varios casos especiales en los que el Fitzpatrick sustitue al segundo caracter de la secuencia
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
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            $cad2 = str_replace("1f3fb", "1f3fc", $cad2);
            $cad3 = str_replace("&#x1F3FB;", "&#x1F3FC;", $cad3);
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            $cad2 = str_replace("1f3fc", "1f3fd", $cad2);
            $cad3 = str_replace("&#x1F3FC;", "&#x1F3FD;", $cad3);
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            $cad2 = str_replace("1f3fd", "1f3fe", $cad2);
            $cad3 = str_replace("&#x1F3FD;", "&#x1F3FE;", $cad3);
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            $cad2 = str_replace("1f3fe", "1f3ff", $cad2);
            $cad3 = str_replace("&#x1F3FE;", "&#x1F3FF;", $cad3);
            print "        <td><span class=\"te\"><a href=\"$rutaSVG/$cad2.svg\">$cad3</a></span></td>\n";
            /*
        print "        <th>$cad1</th>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp.svg\">&#x" . $c[0][0] . ";</a></span></td>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp-1f3fb.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FB;</a></span></td>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp-1f3fc.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FC;</a></span></td>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp-1f3fd.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FD;</a></span></td>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp-1f3fe.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FE;</a></span></td>\n";
        print "        <td><span class=\"te\"><a href=\"$rutaSVG/$tmp-1f3ff.svg\">&#x" . $c[0][0] . ";&#x200D;&#x1F3FF;</a></span></td>\n";
*/
            print "        <td>" . strtoupper($c[1]) . " </td>\n";
            print "      </tr>\n";
        }
        print "    </table>\n";
        print "  </section>\n";
        print "\n";
    }

    function genera_tablas($grupos, $fuentes)
    {
        print "  <ul>\n";
        foreach ($grupos as $g) {
            print "    <li><a href=\"#$g[2]\">$g[1]</a></li>\n";
        }
        print "  </ul>\n";
        print "\n";

        foreach ($grupos as $g) {
            genera_tabla_colores_piel($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $fuentes);
        }
    }


    $grupos_simbolos = array(
        array($caracteres_unicode, "Controles y Latin básico",                          "controles-latin",        "U00000-c0-controls-and-basic-latin.pdf",        1, "0000",  "007F"),
        array($caracteres_unicode, "Suplemento controles y Latin-1",                    "controles-sup",          "U00080-c1-controls-and-latin-1-supplement.pdf", 1, "0080",  "00FF"),
        array($caracteres_unicode, "Puntuación",                                        "puntuacion",             "U02000-general-punctuation.pdf",                1, "2000",  "206F"),
        array($caracteres_unicode, "Símbolos de monedas",                               "monedas",                "U020A0-currency-symbols.pdf",                   1, "20A0",  "20BF"),
        array($caracteres_unicode, "Símbolos con letras",                               "simbolos-letras",        "U02100-letterlike-symbols.pdf",                 1, "2100",  "214F"),
        array($caracteres_unicode, "Flechas",                                           "flechas",                "U02190-arrows.pdf",                             1, "2190",  "21FF"),
        array($caracteres_unicode, "Símbolos técnicos misceláneos",                     "tecnicos-misc",          "U02300-miscellaneous-technical.pdf",            1, "2300",  "23FE"),
        array($caracteres_unicode, "Símbolos alfanuméricos con círculo alrededor",      "alfanum-circulo",        "U02460-enclosed-alphanumerics.pdf",             1, "2460",  "24FF"),
        array($caracteres_unicode, "Cajas",                                             "cajas",                  "U02500-box-drawing.pdf",                        1, "2500",  "257F"),
        array($caracteres_unicode, "Formas geométricas",                                "formas-geometricas",     "U025A0-geometric-shapes.pdf",                   1, "25A0",  "25FF"),
        array($caracteres_unicode, "Símbolos misceláneos",                              "simbolos-misc",          "U02600-miscellaneous-symbols.pdf",              1, "2600",  "26FF"),
        array($caracteres_unicode, "Dingbats",                                          "dingbats",               "U02700-dingbats.pdf",                           1, "2700",  "27BF"),
        array($caracteres_unicode, "Flechas suplementarias B",                          "flechas-suplementarias", "U02900-supplemental-arrows-b.pdf",              1, "2900",  "297F"),
        array($caracteres_unicode, "Símbolos y flechas misceláneos",                    "simbolos-flechas",       "U02B00-miscellaneous-symbols-and-arrows.pdf",   1, "2B00",  "2BEF"),
        array($caracteres_unicode, "Símbolos y puntuación CJK",                         "cjk",                    "U03000-cjk-symbols-and-punctuation.pdf",        1, "3000",  "303F"),
        array($caracteres_unicode, "Símbolos CJK con círculo alrededor",                "cjk-circulo",            "U03200-enclosed-cjk-letters-and-months.pdf",    1, "3200",  "32FF"),
        //  array($caracteres_unicode, "Símbolos musicales",                                "musica",                 "U1D100.pdf",                                    1, "1D100", "1D1E8"),
        array($caracteres_unicode, "Fichas de Mahjong",                                 "fichas-mahjong",         "U1F000-mahjong-tiles.pdf",                      1, "1F000", "1F02B"),
        //  array($caracteres_unicode, "Fichas de dominó",                                  "domino",                 "U1F030.pdf",                                    1, "1F030", "1F093"),
        array($caracteres_unicode, "Cartas",                                            "cartas",                 "U1F0A0-playing-cards.pdf",                      1, "1F0A0", "1F0F5"),
        array($caracteres_unicode, "Suplemento alfanuméricos con círculo alrededor",    "alfanum-circulo-sup",    "U1F100-enclosed-alphanumeric-supplement.pdf",   1, "1F100", "1F1FF"),
        array($caracteres_unicode, "Suplemento ideográfico con círculo alrededor",      "ideografico-circulo-sup", "U1F200-enclosed-ideographic-supplement.pdf",    1, "1F200", "1F2FF"),
        //  array($caracteres_unicode, "Dingbats decorativos",                              "dingbats-decorativos",   "U1F650.pdf",                                    1, "1F650", "1F67F"),
        //  array($caracteres_unicode, "Símbolos alquímicos",                               "simbolos-alquimicos",    "U1F700.pdf",                                    1, "1F700", "1F773"),
        //  array($caracteres_unicode, "Formas geométricas extendidas",                     "geometricas-extendidas", "U1F780.pdf",                                    1, "1F780", "1F7D4"),
    );

    $grupos_dibujos = array(
        array($caracteres_unicode, "Símbolos y pictogramas misceláneos",                "simbolos-misc",       "U1F300-miscellaneous-symbols-and-pictographs.pdf", 1, "1F300", "1F5FF"),
        array($caracteres_unicode, "Emoticonos",                                        "emoticonos",          "U1F600-emoticons.pdf",                             1, "1F600", "1F64F"),
        array($caracteres_unicode, "Símbolos de transporte y mapas",                    "transporte",          "U1F680-transport-and-map-symbols.pdf",             1, "1F680", "1F6FF"),
        array($caracteres_unicode, "Símbolos y pictogramas misceláneos suplementarios", "simbolos-misc-supl",  "U1F900-supplemental-symbols-and-pictographs.pdf",  1, "1F900", "1F9FF"),
        array($caracteres_unicode, "Símbolos y pictogramas extendidos A",               "simbolos-ext-a",      "U1FA70-symbols-and-pictographs-extended-a.pdf",    1, "1FA70", "1FAFF"),
    );

    $grupos_secuencias = array(
        array($cu_banderas,                "Banderas",                                  "banderas",                "",                                                0, "", ""),
        array($cu_banderas_sudivisiones,   "Banderas (subdivisiones)",                  "banderas-2",              "",                                                0, "", ""),
        array($cu_otros,                   "Otros",                                     "otros",                   "",                                                0, "", ""),
        array($cu_familias,                "Familias",                                  "familias",                "",                                                0, "", ""),
        array($cu_colores_pelos,           "Pelo",                                      "pelo",                    "",                                                0, "", ""),
        array($cu_objetos_generos_colores, "Género: Profesiones",                       "hm-profesiones",          "",                                                0, "", ""),
        array($cu_fitzpatrick_n,           "Género: Actividades",                       "hm-actividades",          "",                                                0, "", ""),
        array($cu_fitzpatrick_excepciones, "Género: Actividades",                       "hm-actividades",          "",                                                0, "", ""),
        array($cu_generos,                 "Género: Actividades",                       "hm-actividades",          "",                                                0, "", ""),

        //  array("Colores de piel",                                     "colores-piel",    "", 0, "0261D", "1F9FF"),
        //  array("Otros",                                               "otros",           "", 4, "0002A", "1F4FF"),
    );

    $grupos_secuencias_2 = array(
        array($cu_fitzpatrick_1,           "Colores de piel",                           "colores-piel",            "",                                                0, "", ""),
        array($cu_fitzpatrick_n,           "Colores de piel",                           "colores-piel",            "",                                                0, "", ""),
        array($cu_fitzpatrick_excepciones, "Colores de piel",                           "colores-piel",            "",                                                0, "", ""),
        array($cu_generos,                 "Colores de piel",                           "colores-piel",            "",                                                0, "", ""),
        array($cu_objetos_generos_colores, "Colores de piel",                           "colores-piel",            "",                                                0, "", ""),
        array($cu_colores_pelos,           "Pelo",                                      "pelo",                    "",                                                0, "", ""),
    );

    $grupos_restos = array(
        //  array("Restos",                                              "restos",          "", 1, "00000", "FFFFF"),
        array("Restos",                                              "restos",          "", 4, "1F3C3", "FFFFF"),
        array("Restos",                                              "restos",          "", 5, "1F3C3", "FFFFF"),
    );

    //  genera_grupos($grupos_simbolos,     ["ss", "sy", "te"]);
    genera_grupos($grupos_dibujos,      ["ss", "sy", "te"]);
    // genera_grupos($grupos_secuencias,   ["ss", "te"]);
    // genera_tablas($grupos_secuencias_2, ["ss", "te"]);

    //  genera_grupos($grupos_restos);

    ?>
</body>

</html>