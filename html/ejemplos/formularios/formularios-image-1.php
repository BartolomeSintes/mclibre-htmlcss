<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>image. Formularios. HTML. Páginas web HTML y hojas de estilo CSS. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <form action="formularios-image-2.php" method="get">
<?php
$radio = rand(10, 20);
$cx = rand(20, 80);
$cy = rand(20, 80);
print "      <p>Haga clic en el círculo negro o fuera de él:\n";
print "        <input type=\"image\" name=\"dato\" src=\"formularios-image.php?radio=$radio&amp;cx=$cx&amp;cy=$cy\" style=\"vertical-align: top;\" />\n";
print "        <input type=\"hidden\" name=\"radio\" value=\"$radio\" />\n";
print "        <input type=\"hidden\" name=\"cx\" value=\"$cx\" />\n";
print "        <input type=\"hidden\" name=\"cy\" value=\"$cy\" />\n";
print "      </p>\n";
?>
    </form>
  </body>
</html>
