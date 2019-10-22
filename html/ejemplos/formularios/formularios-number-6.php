<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>number. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
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

$dato = recoge("dato");

if ($dato == "") {
    print "  <p>No ha indicado ningún número.</p>\n";
} else {
    print "  <p>El número indicado es <strong>$dato</strong>.</p>\n";
}
print "\n";
print "  <p><a href=\"formularios-number-6.html\">Volver al formulario.</a></p>\n";
?>
</body>
</html>
