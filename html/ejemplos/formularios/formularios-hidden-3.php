<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>hidden. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
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
$edad = recoge("edad");

if ($nombre == "") {
    print "  <p>No ha escrito su nombre.</p>\n";
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
?>
  <p><a href="formularios-hidden-2.html">Volver al formulario inicial.</a></p>
</body>
</html>
