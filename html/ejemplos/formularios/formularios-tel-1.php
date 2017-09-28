<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>tel. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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

$dato = recoge("dato");

if ($dato == "") {
    print "    <p>No ha indicado ningún número de teléfono.</p>\n";
} else {
    print "    <p>El número de teléfono indicado es <strong>$dato</strong>.</p>\n";
}
?>

    <p><a href="formularios-tel-1.html">Volver al formulario.</a></p>
  </body>
</html>
