<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>fieldset. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        $tmp = "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

$nombre = recoge("nombre");
$edad   = recoge("edad");
$p1     = recoge("p1");
$p2     = recoge("p2");

if ($nombre == "") {
    print "  <p>No ha indicado su nombre.</p>\n";
} else {
    print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
}
print "\n";

if ($edad == "") {
    print "  <p>No ha indicado su edad.</p>\n";
} else {
    print "  <p>Su edad es <strong>$edad</strong>.</p>\n";
}
print "\n";

if ($p1 == "1") {
    print "  <p>Copenhague <strong>no</strong> es la capital de Noruega.</p>\n";
} elseif ($p1 == "2") {
    print "  <p>Helsinki <strong>no</strong> es la capital de Noruega.</p>\n";
} elseif ($p1 == "3") {
    print "  <p>Oslo <strong>sí</strong> es la capital de Noruega.</p>\n";
} else {
    print "  <p>No ha indicado la capital de Noruega.</p>\n";
}
print "\n";

if ($p2 == "1") {
    print "  <p>La Revolución francesa <strong>no</strong> ocurrió en 1492.</p>\n";
} elseif ($p2 == "2") {
    print "  <p>La Revolución francesa <strong>sí</strong> ocurrió en 1789.</p>\n";
} elseif ($p2 == "3") {
    print "  <p>La Revolución francesa <strong>no</strong> ocurrió en 1917.</p>\n";
} else {
    print "  <p>No ha indicado la fecha de la Revolución francesa.</p>\n";
}
print "\n";
?>
  <p><a href="formularios-fieldset-1.html">Volver al formulario.</a></p>
</body>
</html>
