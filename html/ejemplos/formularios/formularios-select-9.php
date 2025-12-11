<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>hr en select. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
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

$menu = recoge("menu");

if ($menu == "") {
    print "  <p>No ha seleccionado ninguna opción.</p>\n";
} else {
    print "  <p>La opción elegida es <strong>$menu</strong>.</p>\n";
}
print "\n";

print "  <p><a href=\"formularios-select-9.html\">Volver al formulario.</a></p>\n";
?>
</body>
</html>
