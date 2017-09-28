<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>hidden. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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

$nombre = recoge("nombre");
$dato = recoge("dato");

if ($nombre == "") {
    print "    <p>No ha escrito su nombre.</p>\n";
} else {
    print "    <p>Su nombre es <strong>$nombre</strong>.</p>\n";
}

if ($dato == "") {
    print "    <p>No ha indicado su edad.</p>\n";
} else {
    print "    <p>Su edad es <strong>$dato</strong>.</p>\n";
}

?>
    <p><a href="formularios-hidden-2.html">Volver al formulario inicial.</a></p>
  </body>
</html>
