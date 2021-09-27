<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Genera tabla Colores SVG. CSS. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../varios/htmlcss.css" title="mclibre">
<link rel="icon" href="../varios/favicon.svg">
<style>
div.c-l { /* colores-lista */
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;
}

div.c { /* color */
  display: flex;
  flex-direction: column;
  flex: 0 1 190px;
  margin: 0 10px 10px 0;
  padding-left: 75px;
  border: 2px black outset;
}

div.c p {
  background-color: white;
  margin: 0;
  padding: 0 0 0 5px;
  border-left: black 1px solid;
}

div.c p.c-n { /* nombre color */
  font-weight: bold;
}

div.e p.c-c { /* entidad-descripcion */
  flex: 1 0 auto;
}
</style>
</head>

<body>
<?php

function rgb_a_hsl($r, $g, $b)
{
    if ($r < 0) {
        $r = 0;
    } elseif ($r > 255) {
        $r = 255;
    }
    if ($g < 0) {
        $g = 0;
    } elseif ($g > 255) {
        $g = 255;
    }
    if ($b < 0) {
        $b = 0;
    } elseif ($b > 255) {
        $b = 255;
    }
    $r = $r / 255;
    $g = $g / 255;
    $b = $b / 255;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $c = $max - $min;

    if ($c == 0) {
        $h = 0;
    } elseif ($max == $r) {
        $h = (($g - $b) / $c);
        if ($h < 0) {
            $h += 6;
        }
    } elseif ($max == $g) {
        $h = ($b - $r) / $c + 2;
    } else {
        $h = ($r - $g) / $c + 4;
    }

    $h = round($h * 60) % 360;

    $l = ($max + $min) / 2;

    if ($max == $min) {
        $s = 0;
    } else {
        $s = $c / (1 - abs(2 * $l - 1));
    }

    return ([$h, round($s, 3)*100, round($l, 3)*100]);
}

function ordena_nombre($a, $b)
{
  return strcmp($a[0], $b[0]);
}

include ("colores-svg.php");

usort($coloresSvg, "ordena_nombre");

// foreach ($coloresSvg as $c2) {
//   print "  [\"$c2[0]\", \"$c2[1]\"],\n";
//}

print "<p>Esta lista contiene " . count($coloresSvg) . " colores.</p>";

print "    <div class=\"c-l\">\n";

foreach ($coloresSvg as $c) {
    $r = hexdec(substr($c[1], 1, 2));
    $g = hexdec(substr($c[1], 3, 2));
    $b = hexdec(substr($c[1], 5, 2));
    $hsl = rgb_a_hsl($r, $g, $b);

    print "      <div class=\"c\" style=\"background-color: hsl($hsl[0], $hsl[1]%, $hsl[2]%)\">\n";
    print "        <p class=\"c-n\">$c[0]</p>\n";
    print "        <p>$c[1]</p>\n";
    print "        <p>rgb($r, $g, $b)</p>\n";
    print "        <p>hsl($hsl[0], $hsl[1]%, $hsl[2]%)</p>\n";
    print "      </div>\n";
    print "\n";
}
print "    </div>";

/*
 * print " <table class=\"mcl-listado mcl-franjas\">\n";
 * print " <thead>\n";
 * print " <tr>\n";
 * print " <th>Carácter&nbsp;&nbsp;</th>\n";
 * print " <th>Nombre&nbsp;&nbsp;</th>\n";
 * print " <th>Entidad de carácter&nbsp;&nbsp;</th>\n";
 * print " <th>Entidad numérica&nbsp;&nbsp;</th>\n";
 * print " <th>Recomendación&nbsp;&nbsp;</th>\n";
 * print " <th>Descripción</th>\n";
 * print " </tr>\n";
 * print " </thead>\n";
 *
 * print " <tbody>\n";
 * foreach ($entidades_caracter as $c) {
 * print " <tr>\n";
 * print " <td style=\"text-align: center; font-size: 150%\">$c[0]</td>\n";
 * print " <td>$c[1]</td>\n";
 * print " <td>$c[2]</td>\n";
 * print " <td>$c[3]</td>\n";
 * print " <td>$c[4]</td>\n";
 * print " <td>$c[5]</td>\n";
 * print " </tr>\n";
 * }
 * print " </tbody>\n";
 * print " </table>\n";
 */
?>
</body>
</html>
