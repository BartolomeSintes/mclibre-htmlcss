<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>color. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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
  print "    <p>No ha elegido ningún color.</p>\n";
} else {
  print "    <p>El color elegido es <strong>$dato</strong>.</p>\n";
}

print "\n";
print "    <p><a href=\"formularios-color-$origen.html\">Volver al formulario.</a></p>\n";
?>
  </body>
</html>
