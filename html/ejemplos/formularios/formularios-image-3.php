<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>image. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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

$datoX = recoge("dato_x");
$datoY = recoge("dato_y");

if ($datoX == "") {
    print "    <p>No se ha recibido la coordenada X.</p>\n";
} elseif ($datoY == "") {
    print "    <p>No se ha recibido la coordenada Y.</p>\n";
} else {
    print "    <p>Ha hecho clic en el punto (<strong>$datoX</strong>, <strong>$datoY</strong>).</p>\n";
}
?>

    <p><a href="formularios-image-3.html">Volver al formulario.</a></p>
  </body>
</html>
