<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>radio. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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
    print "    <p>No se ha recibido nada.</p>\n";
} else {
    print "    <p>El dato recibido es <strong>$dato</strong>.</p>\n";
}

print "\n";
print "    <p><a href=\"formularios-radio-$origen.html\">Volver al formulario.</a></p>\n";
?>
  <body>
</html>
