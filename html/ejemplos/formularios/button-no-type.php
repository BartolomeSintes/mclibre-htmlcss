<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>&lt;button&gt; sin type. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    print "  <p>No ha escrito ningún texto.</p>\n";
} else {
    print "  <p>El texto escrito es <strong>$dato</strong>.</p>\n";
}
print "\n";
?>
  <p><a href="button-no-type.html">Volver al formulario.</a></p>
</body>
</html>
