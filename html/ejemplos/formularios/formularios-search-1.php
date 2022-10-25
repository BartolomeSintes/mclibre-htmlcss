<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>search. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
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

$busqueda = recoge("busqueda");

if ($busqueda == "") {
    print "  <p>No ha indicado ninguna cadena de búsqueda.</p>\n";
} else {
    print "  <p>La cadena de búsqueda indicada es <strong>$busqueda</strong>.</p>\n";
}
print "\n";
?>
  <p><a href="formularios-search-1.html">Volver al formulario.</a></p>
</body>
</html>
