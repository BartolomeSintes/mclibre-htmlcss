<?php
// 2022-01-06 Barto
// Hay que llamar este programa enviando el valor de h (hue)
//
header("Content-type: image/svg+xml");
// FUNCIÓN DE RECOGIDA DE DATOS
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$h = recoge("h");
$paso = 5;

print "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
print "    width=\"160\" height=\"170\" viewBox=\"-50 -40 160 170\" style=\"background-color: white;\" font-family=\"sans-serif\">\n";
print "\n";

for ($w = 0; $w <= 100; $w = $w + $paso) {
    for ($b = 0; $b <= 100; $b = $b + $paso) {
        print "  <rect x=\"$w\" y=\"$b\" width=\"" . $paso + 1 . "\" height=\"" . $paso + 1 . "\" stroke=\"none\" fill=\"hwb($h $w% $b%)\" />\n";
        // Hago el cuadrado un poco más grande, 6 x 6 en vez de 5 x 5, porque si no se ven líneas blancas entre cuadro y cuadro
        // Así se nota el salto de cuadro a cuadro, pero no una línea blanca
    }
}

print "\n";
print "  <rect x=\"0\" y=\"0\" width=\"105\" height=\"105\" stroke=\"black\" fill=\"none\" />\n";
print "  <text x=\"50\" y=\"125\" font-size=\"18\" text-anchor=\"middle\">H = $h</text>\n";
print "  <line x1=\"0\" y1=\"-10\" x2=\"95\" y2=\"-10\" stroke-width=\"2\" stroke=\"black\" />\n";
print "  <polygon points=\"103,-10 93,-5 93,-15\" fill=\"black\" stroke-width=\"1\" stroke=\"black\" />\n";
print "  <text x=\"45\" y=\"-20\" font-size=\"18\" text-anchor=\"middle\">W</text>\n";
print "  <text x=\"0\" y=\"-20\" font-size=\"18\" text-anchor=\"start\">0</text>\n";
print "  <text x=\"105\" y=\"-20\" font-size=\"18\" text-anchor=\"end\">100</text>\n";
print "  <line x1=\"-10\" y1=\"0\" x2=\"-10\" y2=\"95\" stroke-width=\"2\" stroke=\"black\" />\n";
print "  <polygon points=\"-10,103 -15,93 -5,93\" fill=\"black\" stroke-width=\"1\" stroke=\"black\" />\n";
print "  <text x=\"-30\" y=\"50\" font-size=\"18\" text-anchor=\"middle\">B</text>\n";
print "  <text x=\"-30\" y=\"10\" font-size=\"18\" text-anchor=\"middle\">0</text>\n";
print "  <text x=\"-32\" y=\"105\" font-size=\"18\" text-anchor=\"middle\">100</text>\n";
print "</svg>\n";
?>
