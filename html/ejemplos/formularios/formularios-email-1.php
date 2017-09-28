<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>email. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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
    print "    <p>No ha indicado ninguna dirección de correo.</p>\n";
} else {
    print "    <p>La dirección de correo indicada es <strong>$dato</strong>.</p>\n";
}
?>

    <p><a href="formularios-email-1.html">Volver al formulario.</a></p>
  </body>
</html>
