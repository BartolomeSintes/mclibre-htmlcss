<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>minlength. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        $tmp = "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

$usuario = recoge("usuario");

if ($usuario == "") {
   print "  <p>No ha indicado el nombre de usuario.</p>\n";
} else {
   print "  <p>El nombre de usuario indicado es <strong>$usuario</strong>.</p>\n";
}
print "\n";

$password = recoge("password");

if ($password == "") {
   print "  <p>No ha indicado la contraseña.</p>\n";
} else {
   print "  <p>La contraseña indicada es <strong>$password</strong>.</p>\n";
}
print "\n";
?>
  <p><a href="formularios-minlength-1.html">Volver al formulario.</a></p>
</body>
</html>
