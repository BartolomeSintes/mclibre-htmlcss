<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>date. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
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
$hm = recoge("hm");

if ($nombre == "") {
    print "  <p>No ha indicado su nombre.</p>\n";
} else {
    print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
}
print "\n";

if ($hm == "h") {
    print "  <p>Es usted un <strong>hombre</strong>.</p>\n";
} elseif ($hm == "m") {
    print "  <p>Es usted una <strong>mujer</strong>.</p>\n";
} else {
    print "  <p>No ha indicado su sexo.</p>\n";
}
print "\n";
?>
  <p><a href="formularios-required-1.html">Volver al formulario.</a></p>
</body>
</html>
