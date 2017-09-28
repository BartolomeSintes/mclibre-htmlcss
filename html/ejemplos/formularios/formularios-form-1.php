<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>date. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
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
$nacido = recoge("nacido");
$hm = recoge("hm");

if ($nombre == "") {
    print "    <p>No ha indicado su nombre.</p>\n";
}   else {
  print "    <p>Su nombre es <strong>$nombre</strong>.</p>\n";
}

if (!ctype_digit($nacido) || $nacido == "") {
    print "    <p>No ha indicado su año de nacimiento.</p>\n";
} else {
    print "    <p>Nació en <strong>$nacido</strong>.</p>\n";
}

if ($hm == "h") {
    print "    <p>Es usted un <strong>hombre</strong>.</p>\n";
} elseif ($hm == "m") {
    print "    <p>Es usted una <strong>mujer</strong>.</p>\n";
} else {
    print "    <p>No ha indicado su sexo.</p>\n";
}
?>

    <p><a href="formularios-form-1.html">Volver al formulario.</a></p>
  </body>
</html>
