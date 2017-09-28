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

$radio = recoge("radio");
$cx = recoge("cx");
$cy = recoge("cy");
$datoX = recoge("dato_x");
$datoY = recoge("dato_y");

if (($datoX - $cx) * ($datoX -$cx) + ($datoY - $cy) * ($datoY -$cy) > $radio * $radio) {
    print "    <p>No ha hecho clic en el círculo negro.</p>\n";
} else {
    print "    <p>Ha hecho clic en el círculo negro.</p>\n";
}
?>

    <p><a href="formularios-image-1.php">Volver al formulario.</a></p>
  </body>
</html>
