<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>select. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$origen = recoge("origen");

if (!ctype_digit($origen)) {
    $origen = 1;
}

$dato = recoge("dato");

if ($dato == "") {
    print "    <p>No ha seleccionado ninguna opción.</p>\n";
} else {
    print "    <p>La opción elegida es <strong>$dato</strong>.</p>\n";
}

print "\n";
print "    <p><a href=\"formularios-select-$origen.html\">Volver al formulario.</a></p>\n";
?>
  </body>
</html>
