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

$radio = recoge("radio");
$cx = recoge("cx");
$cy = recoge("cy");
$puntoX = recoge("punto_x");
$puntoY = recoge("punto_y");

if (($puntoX - $cx) * ($puntoX -$cx) + ($puntoY - $cy) * ($puntoY -$cy) > $radio * $radio) {
    print "  <p>No ha hecho clic en el círculo negro.</p>\n";
} else {
    print "  <p>Ha hecho clic en el círculo negro.</p>\n";
}
print "\n";
?>
  <p><a href="formularios-image-1.php">Volver al formulario.</a></p>
</body>
</html>
