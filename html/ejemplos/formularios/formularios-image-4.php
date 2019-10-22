<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>image. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        $tmp = "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$diana = recoge("diana");
$dianaX = recoge("diana_x");
$dianaY = recoge("diana_y");

if ($diana == "") {
    print "  <p>No se ha recibido el nombre del control.</p>\n";
} else {
    print "  <p>Se ha recibido el nombre del control con el valor <strong>$diana</strong>.</p>\n";
}
print "\n";

if ($dianaX == "") {
    print "  <p>No se ha recibido la coordenada X.</p>\n";
} elseif ($dianaY == "") {
    print "  <p>No se ha recibido la coordenada Y.</p>\n";
} else {
    print "  <p>Ha hecho clic en el punto (<strong>$dianaX</strong>, <strong>$dianaY</strong>).</p>\n";
}
print "\n";
?>
  <p><a href="formularios-image-4.html">Volver al formulario.</a></p>
</body>
</html>
