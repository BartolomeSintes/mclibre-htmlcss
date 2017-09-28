<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>hidden. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <form action="formularios-hidden-3.php" method="get">
      <p>Escriba su edad: <input type="number" name="dato" /></p>

      <p>
        <input type="submit" value="Enviar" />
<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$dato = recoge("dato");

print "        <input type=\"hidden\" name=\"nombre\" value=\"$dato\" />\n";
?>
      </p>
    </form>
    <p><a href="formularios-hidden-2.html">Volver al formulario inicial.</a></p>
  </body>
</html>
